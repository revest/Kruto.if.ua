<?php

/**
 * This is the model class for table "profile".
 *
 * The followings are the available columns in table 'profile':
 * @property string $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $dob
 * @property integer $gender
 * @property integer $country
 * @property string $photo
 * @property string $info
 */
class Profile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profile the static model class
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
		return 'profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('gender', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>10),
			array('first_name, last_name', 'length', 'max'=>30),			
			array('dob, info, marital, status', 'safe'),
                        array('photo', 'url'),
                        array('dob','match','pattern'=>'/^(19|20)\d\d-[01]\d-([012]\d|31|30)$/'), 
                       // array('dob', 'date', 'timestampAttribute'=>'yyyy-mm-dd'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, first_name, marital, last_name, dob, gender, country, city, photo, info', 'safe', 'on'=>'search'),
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
			'user_id' => 'ID',
			'first_name' => 'Ім`я',
			'last_name' => 'Прізвище',
			'dob' => 'Дата народження',
                        'marital'=>'Сімейний стан',
			'gender' => 'Стать',
			'country' => 'Країна',
                        'city' => 'Місто',
			'photo' => 'Фото',
			'info' => 'Про себе',
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

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('country',$this->country);
                $criteria->compare('city',$this->city);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('info',$this->info,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}