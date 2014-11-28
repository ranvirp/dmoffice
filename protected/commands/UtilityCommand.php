<?php
/**
 * RbacManager is a command-line tool (extends CConsoleCommand) for managing rbac items and assignments.
 * @author wapmorgan (wapmorgan@gmail.com)
 * @param string $modelClass AR model that represent users in db
 */
class UtilityCommand extends CConsoleCommand {
	public function actionImport()
        {
            foreach (User::model()->with('profile')->findAll() as $user)
            {
                if ($user->profile)
                {
                    $designation=  Designation::getDesignationModelByUser($user->id);
                    if ($designation)
                    {
                        $designation->officer_name=$user->profile->firstname.' '.$user->profile->lastname;
                        $designation->officer_mobile=$user->profile->mobile;
                        $designation->save();
                    }
                }
            }
                
        }
}
