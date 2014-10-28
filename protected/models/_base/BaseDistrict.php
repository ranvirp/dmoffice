<?php

/**
 * This is the model base class for the table "district".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "District".
 *
 * Columns in table "district" available as properties of the model,
 * followed by relations of table "district" available as properties of the model.
 *
 * @property string $state_code
 * @property string $code
 * @property string $name_en
 * @property string $name_hi
 *
 * @property Block[] $blocks
 * @property Corporation[] $corporations
 * @property State $stateCode
 * @property Municipality[] $municipalities
 * @property Tehsil[] $tehsils
 * @property Town[] $towns
 */
abstract class BaseDistrict extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'district';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'District|Districts', $n);
	}

	public static function representingColumn() {
		return 'code';
	}

	public function rules() {
		return array(
			array('code', 'required'),
			array('state_code', 'length', 'max'=>2),
			array('code', 'length', 'max'=>5),
			array('name_en, name_hi', 'length', 'max'=>45),
			array('state_code, name_en, name_hi', 'default', 'setOnEmpty' => true, 'value' => null),
			array('state_code, code, name_en, name_hi', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'blocks' => array(self::HAS_MANY, 'Block', 'district_code'),
			'corporations' => array(self::HAS_MANY, 'Corporation', 'district_code'),
			'stateCode' => array(self::BELONGS_TO, 'State', 'state_code'),
			'municipalities' => array(self::HAS_MANY, 'Municipality', 'district_code'),
			'tehsils' => array(self::HAS_MANY, 'Tehsil', 'district_code'),
			'towns' => array(self::HAS_MANY, 'Town', 'district_code'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'state_code' => null,
			'code' => Yii::t('app', 'Code'),
			'name_en' => Yii::t('app', 'Name En'),
			'name_hi' => Yii::t('app', 'Name Hi'),
			'blocks' => null,
			'corporations' => null,
			'stateCode' => null,
			'municipalities' => null,
			'tehsils' => null,
			'towns' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('state_code', $this->state_code);
		$criteria->compare('code', $this->code, true);
		$criteria->compare('name_en', $this->name_en, true);
		$criteria->compare('name_hi', $this->name_hi, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}