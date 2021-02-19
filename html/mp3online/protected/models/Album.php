<?php

/**
 * This is the model class for table "album".
 *
 * The followings are the available columns in table 'album':
 * @property integer $album_id
 * @property string $album_name
 * @property string $album_img
 * @property integer $category_id
 * @property integer $number_song
 * @property string $create_date
 * @property string $status
 * @property integer $order_number

 */
class Album extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $song_id;
    public $parent_cate;
    public $number_song;
    public $name_vi;
	public function tableName()
	{
		return 'album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('category_id', 'required'),
			array('status, order_number', 'numerical', 'integerOnly'=>true),
			array('album_name', 'length', 'max'=>255),
			array('album_img', 'safe'),
			array('album_img','file','allowEmpty'=>true,'types'=>'jpg,png,jpeg,gif','maxSize'=>1024*1024*1,'on'=>'insert,update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('album_id, album_name, status, order_number','safe', 'on'=>'search'),
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
			'album_id' => 'ID',
			'album_name' => 'Name',
			'album_img' => 'Image',
			//'category_id' => 'Category',
			'number_song' => 'Number Of Files',
            'order_number' => 'Order Number',
			//'create_date' => 'Create Date',
			'status' =>'Status',
            //'parent_cate'=> 'Parent Category'
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

		$criteria->compare('album_id',$this->album_id);
		$criteria->compare('album_name',$this->album_name,true);
		//$criteria->compare('album_img',$this->album_img,true);
		$criteria->compare('category_id',$this->category_id);
        //$criteria->compare('parent_cate',$this->parent_cate);
		//$criteria->compare('number_song',$this->number_song);
		//$criteria->compare("create_date LIKE '%$this->create_date%'",true);
		$criteria->compare('status',$this->status,true);
        $criteria->compare('order_number',$this->order_number,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'album_id DESC',
            )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Album the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public static function itemAlias($type,$code=NULL) {
        $_items = array(
            'status' => array(
                '0' => 'Inactive',
                '1' => 'Active',
            ),
        );
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }
}
