<?php

/**
 * This is the model class for table "style".
 *
 * The followings are the available columns in table 'style':
 * @property string $id
 * @property string $name
 */
class Style extends CActiveRecord {
    public $alias ='';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Style the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'style';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('name', 'length', 'max' => 100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name', 'safe', 'on' => 'search'),
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
            'id' => 'ID',
            'name' => 'Name',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function getStyles() {
        global $STYLES;
        global $STYLES_ALIAS;
        if (count($STYLES)<2) {
            $M_STYLES = Style::model()->findAll();
            foreach ($M_STYLES as $M) {
                $STYLES[$M->id] = $M->name;
                $STYLES_ALIAS[$M->id] = $M->alias;
            }
        }
        return $STYLES;
    }
    
    public static function getIdByAlias($needle){
         global $STYLES_ALIAS;
         return array_search($needle, $STYLES_ALIAS);
    }
    

    public function beforeSave(){
        if(empty($this->alias)){
            $this->alias = str_makeAlias($this->name);
        }
    }
}