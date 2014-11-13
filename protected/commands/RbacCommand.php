<?php
/**
 * RbacManager is a command-line tool (extends CConsoleCommand) for managing rbac items and assignments.
 * @author wapmorgan (wapmorgan@gmail.com)
 * @param string $modelClass AR model that represent users in db
 */
class RbacCommand extends CConsoleCommand {
	public $modelClass = 'User';
	private $auth;

	/**
	 * Inits extension
	 */
	public function init() {
		parent::init();
		$this->auth = Yii::app()->authManager;
		Yii::import($this->modelClass);
	}

	/**
	 * Shows roles list and associated users
	 */
	public function actionIndex() {
		$command = $this->auth->dbConnection->createCommand()
			->select()
			->from($this->auth->assignmentTable)
			->where('itemname = :itemname');

		foreach ($this->auth->getAuthItems(CAuthItem::TYPE_ROLE) as $authItem) {
			echo '['.$authItem->name.']'.PHP_EOL;
			$command->params = array(':itemname' => $authItem->name);
			foreach ($command->queryAll() as $assignment) {
				$user = $this->getUser($assignment['userid'], null);
                                if ($user)
				echo "\t".($user->hasAttribute('username') ? $user->username : 'id:'.$user->id).PHP_EOL;
			}
		}
	}

	/**
	 * Creates an auth item
	 * @param array $args First element is a type (e.g. role, task or operation) and second one is a name
	 * @param string $description
	 * @param string $bizRule
	 * @param string $data
	 */
	public function actionCreate(array $args, $description = null, $bizRule = null, $data = null) {
		if (!isset($args[0]) || !isset($args[1]) || ($type = array_search($args[0], self::typesToStrings())) === false)
			return -1;

		if ($this->auth->getAuthItem($args[1]) !== null)
			echo 'Already exists.'.PHP_EOL;
		else if ($this->auth->createAuthItem($args[1], $type, $description, $bizRule, $data))
			echo 'Created '.$args[0].' '.$args[1].PHP_EOL;
	}

	/**
	 * Deletes an auth item
	 * @param array $args First element is an auth item
	 */
	public function actionDelete(array $args) {
		if (!isset($args[0]))
			return -1;

		if ($this->auth->removeAuthItem($args[0]))
			echo 'Removed '.$args[0].PHP_EOL;
	}

	/**
	 * Assigns an auth item(s) to a user
	 * @param array $args Auth items
	 * @param int $id User id. You can pass `id` or `username` param, `id` is prior.
	 * @param int $username User username
	 */
	public function actionGrantUser(array $args, $id = null, $username = null) {
		$user = $this->getUser($id, $username);

		foreach ($args as $itemName) {
			if (($item = $this->auth->getAuthItem($itemName)) === null)
				echo $itemName.' is invalid'.PHP_EOL;
			else if (!$this->auth->isAssigned($itemName, $user->id)) {
				$this->auth->assign($itemName, $user->id);
				echo ($user->hasAttribute('username') ? $user->username : 'id:'.$user->id).' += '.$itemName.PHP_EOL;
			}
		}
	}

	/**
	 * Refuses an auth item(s) from a user
	 * @param array $args Auth items
	 * @param int $id User id. You can pass `id` or `username` param, `id` is prior.
	 * @param int $username User username
	 * @param bool $all If set to true, all assignments to a user will be deleted.
	 */
	public function actionClearUser(array $args, $id = null, $username = null, $all = false) {
		$user = $this->getUser($id, $username);

		$assignments = $this->auth->getAuthAssignments($user->id);
		if ($all && !empty($args))
			throw new Exception('You should pass items to delete OR pass --all option!');
		if ($all)
			$args = array_keys($assignments);

		$items = array_keys($this->auth->getAuthItems());

		foreach ($args as $arg) {
			if (!in_array($arg, $items))
				echo $arg.' is invalid!'.PHP_EOL;
			else if (!isset($assignments[$arg]))
				echo $arg.' isn\'t assigned to user.'.PHP_EOL;
			else {
				echo 'Revoked '.$arg.PHP_EOL;
				$this->auth->revoke($arg, $user->id);
			}
		}
	}

	/**
	 * Shows all assignments of a user
	 * @param int $id User id. You can pass `id` or `username` param, `id` is prior.
	 * @param int $username User username
	 */
	public function actionDescribeUser($id = null, $username = null) {
		$user = $this->getUser($id, $username);

		foreach ($this->auth->getAuthAssignments($user->id) as $authAssignment) {
			echo $authAssignment->itemName.PHP_EOL;
		}
	}

	/**
	 * Returns types-to-string map
	 * @return array
	 */
	static private function typesToStrings() {
		return array(
			CAuthItem::TYPE_ROLE => 'role',
			CAuthItem::TYPE_TASK => 'task',
			CAuthItem::TYPE_OPERATION => 'operation',
		);
	}

	/**
	 * Returns user model by its id or username.
	 * @return mixed User or null
	 */
	private function getUser($id, $username) {
		if ($id === null && $username === null)
			throw new Exception('You didn\'t pass id or username!');
		$modelClass = ($modelClass = strrchr($this->modelClass, '.')) !== false ? substr($modelClass, 1) : $this->modelClass;
		$user = $id === null
			? $modelClass::model()->findByAttributes(array('username' => $username))
			: $modelClass::model()->findByPk($id);
		if ($user === null)
                {
			//throw new Exception('Invalid user!');
                    print "user $id:$username not found\n";
                    return null;
                }
		return $user;
	}
}
