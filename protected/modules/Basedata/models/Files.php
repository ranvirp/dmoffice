<?php

/**
 * This is the model class for table "files".
 *
 * The followings are the available columns in table 'files':
 * @property integer $id
 * @property string $title
 * @property string $desc
 * @property string $mimetype
 * @property integer $size
 * @property string $path
 * @property string $deleteAccess
 * @property string $updateAccess
 * @property string $viewAccess
 * @property string $originalname
 * @property string $md5
 * @property string $objecttype
 * @property integer $objectid
 * @property string $uploadedby
 * @property string $fieldname
 */
class Files extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'files';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //	array('title, desc, mimetype, size, path, deleteAccess, updateAccess, viewAccess, originalname, md5, objecttype, uploadedby, fieldname', 'required'),
            array('size, objectid', 'numerical', 'integerOnly' => true),
            array('mimetype, deleteAccess, updateAccess, viewAccess, md5, fieldname', 'length', 'max' => 255),
            array('objecttype, uploadedby', 'length', 'max' => 20),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, desc, mimetype, size, path, deleteAccess, updateAccess, viewAccess, originalname, md5, objecttype, objectid, uploadedby, fieldname', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'desc' => Yii::t('app', 'Desc'),
            'mimetype' => Yii::t('app', 'Mimetype'),
            'size' => Yii::t('app', 'Size'),
            'path' => Yii::t('app', 'Path'),
            'deleteAccess' => Yii::t('app', 'Delete Access'),
            'updateAccess' => Yii::t('app', 'Update Access'),
            'viewAccess' => Yii::t('app', 'View Access'),
            'originalname' => Yii::t('app', 'Originalname'),
            'md5' => Yii::t('app', 'Md5'),
            'objecttype' => Yii::t('app', 'object to which files are attached'),
            'objectid' => Yii::t('app', 'id of the object to which attached'),
            'uploadedby' => Yii::t('app', 'Uploadedby'),
            'fieldname' => Yii::t('app', 'Fieldname'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('desc', $this->desc, true);
        $criteria->compare('mimetype', $this->mimetype, true);
        $criteria->compare('size', $this->size);
        $criteria->compare('path', $this->path, true);
        $criteria->compare('deleteAccess', $this->deleteAccess, true);
        $criteria->compare('updateAccess', $this->updateAccess, true);
        $criteria->compare('viewAccess', $this->viewAccess, true);
        $criteria->compare('originalname', $this->originalname, true);
        $criteria->compare('md5', $this->md5, true);
        $criteria->compare('objecttype', $this->objecttype, true);
        $criteria->compare('objectid', $this->objectid);
        $criteria->compare('uploadedby', $this->uploadedby, true);
        $criteria->compare('fieldname', $this->fieldname, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Files the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Returns all models in List of primary key,name format
     */
    public static function listAll($className = __CLASS__) {
        $lang = Yii::app()->language;
        $models = $className::model()->findAll();
        $pk = $className::model()->tableSchema->primaryKey;
        // format models resulting using listData     
        $list = CHtml::listData($models, $pk, 'name_' . $lang);
        return $list;
    }

    /**
     * Returns all models in List of primary key,name format
     */
    public static function listAllJson($className = __CLASS__) {
        $lang = Yii::app()->language;
        $models = $className::model()->findAll();
        $pk = $className::model()->tableSchema->primaryKey;
        // format models resulting using listData     
        $list = CHtml::listData($models, $pk, 'name_' . $lang);
        return json_encode($list);
    }

    public function fileLink() {
        return CHtml::link($this->filename, CHtml::normalizeUrl(array('file', 'id' => $this->id)));
    }

    public function deleteFile() {
        if (strlen($this->filename) > 0 && file_exists($this->fileWithPath()) && !is_dir($this->fileWithPath())) {
            unlink($this->fileWithPath());
        }
    }

    protected function afterDelete() {
        parent::afterDelete();
        $this->deleteFile();
    }

    public static function cleanName($name, $maxLength = 0) {
        $name = preg_replace("/[^.A-Za-z0-9_-]/", "", $name);
        if ($maxLength > 0 && strlen($name) > $maxLength) {
            $name = substr($name, 0, $maxLength / 2 - 2) . ".." . substr($name, strlen($name) - $maxLength / 2 + 1);
        }
        return $name;
    }

    public static function generateUniqueFilename($path) {
        $pathinfo = pathinfo($path);
        return $pathinfo['filename'] . uniqid('-') . '.' . $pathinfo['extension'];
    }

    public function fileWithPath() {
        return Yii::getPathOfAlias(Yii::app()->params['filesAlias']) . DIRECTORY_SEPARATOR . $this->id . DIRECTORY_SEPARATOR . $this->originalname;
    }

    public static function showAttachments($model,$attribute) {
        $x = $model->$attribute;
//echo $x;
        if ($x) {
            $y = explode(",", $x);

            $str = "<table class='table'>";
            for ($i = 0; $i < sizeof($y); $i++) {
                $files = Files::model()->findByPk($y[$i]);
                $str.='<tr>';
                $str.='<td>'.$files->title.'</td>';
                $str.= "<td>" . CHtml::link($files->originalname, Yii::app()->createUrl('/Basedata/files/file/id/' . $y[$i])).'</td>';
                $str.='</tr>';

                
            }
            $str.= "</table>";
            $str1='<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Attachments</h3>
  </div>
  <div class="panel-body">'.
   $str.
  '</div>
</div>';
            return $str1;
        } else
            return null;
    }
     public static function showAttachmentsInline($model,$attribute) {
        $x = $model->$attribute;
//echo $x;
        if ($x) {
            $str="<div class='hidden-print'>";
            $y = explode(",", $x);

            $str .= "<table class='table table-striped table-bordered'>";
            for ($i = 0; $i < sizeof($y); $i++) {
                $files = Files::model()->findByPk($y[$i]);
                $str.='<tr>';
                $str.='<td>'.$files->title.'</td>';
                $str.= "<td>" . CHtml::link($files->originalname, Yii::app()->createUrl('/Basedata/files/file/id/' . $y[$i])).'</td>';
                $str.='</tr>';

                
            }
            $str.= "</table>";
            $str.="</div>";
         
            return $str;
        } else
            return null;
    }

}
