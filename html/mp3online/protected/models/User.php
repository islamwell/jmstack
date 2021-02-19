<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':

 * @property string $username
 * @property string $password
 * @property integer $role

 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $currentPassword;
	public $newPassword;
	public $newPasswordRepeat;
	public function tableName()
	{
		return 'admin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('code, nome, serial, username, password, company_name, code_company, created', 'required'),
			array('role','numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>25),
			array('password', 'length', 'max'=>100),
			array('currentPassword','compareCurrentPassword'),
			array('currentPassword,newPassword,newPasswordRepeat','required'),
			array('currentPassword,newPassword','sameCheck'),
			array(
				'newPasswordRepeat', 'compare',
				'compareAttribute'=>'newPassword',

			),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('username, password', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'password' => 'Password',
			'currentPassword' => 'Current Password',
			'newPassword' => 'New password',
			'newPasswordRepeat' => 'New Password Repeat',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function compareCurrentPassword()
	{
		$user_id = Yii::app()->user->id;
		$model = User::model()->findByPk($user_id);
		$model->attributes=$_POST['User'];
		if($model->password !== md5($model->currentPassword))
			$this->addError('currentPassword', 'Current pass is invalid');
	}

	public  function sameCheck()
	{
		$user_id = Yii::app()->user->id;
		$model = User::model()->findByPk($user_id);
		$model->attributes=$_POST['User'];
		if($model->password == md5($model->newPassword,$model->password))
			$this->addError('newPassword', 'Current Password and New password are the same, you need to choose different one');
	}
}
