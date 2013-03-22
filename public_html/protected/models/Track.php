<?php

/**
 * This is the model class for table "track".
 *
 * The followings are the available columns in table 'track':
 * @property string $id
 * @property string $artist
 * @property string $name
 * @property string $text
 * @property integer $date_relize
 * @property integer $date_upload
 * @property string $cover
 * @property integer $style_id
 */
class Track extends CActiveRecord {

    public $date;    
    public $styles;    
    public $Files = array();
    public $link; //if we need to save only one link of file
    public $trackAlias;
    public $href; /// href to page of this track

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Track the static model class
     */

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'track';
    }
    
    public function getTitle(){
        return $this->artist. ' - '. $this->name;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('artist, name, style_id', 'required'),
            array('style_id, title', 'required'),
            array('date_upload, style_id, subStyle_id', 'numerical', 'integerOnly' => true),
            array('title', 'match', 'pattern' => '/^.+\s\-\s.+$/u'),            
            array('title', 'unique',),
         //   array($this->getTitle(), 'unique'),
            //  array('artist, name', 'length', 'max' => 100),
            array('cover', 'length', 'max' => 300),
            array('date_relize', 'length', 'max' => 10),         
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, date_relize, text, date_upload, cover, style_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'files' => array(self::HAS_MANY, 'File', 'track_id'),
          //  'style' => array(self::BELONGS_TO, 'Style', 'style_id'),
            'author' => array(self::BELONGS_TO, 'User', 'author_id'),            
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'date_relize' => 'Date Relize',
            'date_upload' => 'Date Upload',
            'cover' => 'Cover',
            'style_id' => 'Style',
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
        $criteria->compare('title', $this->title, true);
        //$criteria->compare('artist', $this->artist, true);
        //$criteria->compare('name', $this->name, true);
        $criteria->compare('date_relize', $this->date_relize);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('date_upload', $this->date_upload);
        $criteria->compare('cover', $this->cover, true);
        $criteria->compare('style_id', $this->style_id);
         $criteria->compare('subStyle_id', $this->subStyle_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function beforeSave() {
         /*$ar = explode(" - ", $this->title, 2);
            $this->artist = $ar[0];
            if (isset($ar[1]))
                $this->name = $ar[1];*/
        $this->title=trim($this->title);
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->date_upload = time();
                $this->author_id = Yii::app()->user->id;  
            }                                  
            return true;
        }
        else
            return false;
    }
/*
    public function afterSave() {
        //var_dump($this->files); exit();
       
            $ret = true; //for file saving and return
            foreach ($this->Files as $file) {
                $file->track_id = $this->id;
                if (!$file->save())
                    $ret = false;
            }
            //return $ret;
            //return true;
        
        return parent::afterSave();
    }
 * 
 */

    public function afterFind() {
        global $STYLES;
        $this->href = Yii::app()->createUrl('music/'.$this->id);
        $this->date = date("d-m-Y H:i", $this->date_upload);        
        $this->styles = $STYLES[$this->style_id];
        $this->trackAlias=self::getTrackAlias($this->title);
        if(!empty($this->subStyle_id))
                $this->styles .= ", ". $STYLES[$this->subStyle_id];
        if (empty($this->cover))
              $this->cover = Yii::app()->baseUrl . "/images/nocover.jpg";
    }
    
    public static function getTrackAlias($title){
        return urlencode(strtolower(preg_replace('/\s{1,}/','_', trim(preg_replace('/\W/',' ',  $title)))));
    }

}