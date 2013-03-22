<?php

/**
 * This is the model class for table "file".
 *
 * The followings are the available columns in table 'file':
 * @property string $id
 * @property integer $track_id
 * @property string $link
 * @property string $bitrate
 * @property string $comment
 * @property integer $rate
 */
class File extends CActiveRecord
{
    public  $preview;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return File the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('link', 'required'),
			array('track_id, rate', 'numerical', 'integerOnly'=>true),
			array('link', 'length', 'max'=>255),
                        array('link', 'url', 'defaultScheme'=>'http://' ),
                        array('link', 'unique' ),
                        array('source', 'unique' ),
			array('bitrate', 'length', 'max'=>10),
			array('comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, track_id, link, bitrate, comment, rate', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'track_id' => 'Track',
			'link' => 'Link',
			'bitrate' => 'Bitrate',
			'comment' => 'Comment',
			'rate' => 'Rate',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('track_id',$this->track_id);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('bitrate',$this->bitrate,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('rate',$this->rate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}