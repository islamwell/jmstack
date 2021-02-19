<?php

/**
 * This is the model class for table "song".
 *
 * The followings are the available columns in table 'song':
 * @property integer $song_id
 * @property integer $stt
 * @property string $song_name
 * @property string $lyrics
 * @property string $link
 * @property integer $singer_id
 * @property integer $listen
 * @property integer $album_id
 * @property string $create_date
 * @property integer $download
 * @property integer $hot
 * @property integer $new
 * @property integer $status
 * @property string $link_app
 * @property string $image
 * @property integer $isTopsong
 * @property integer $author_id
 * @property integer $category_id
 * @property integer $order_number
 * @property string $description
 */
class Song extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    public $link_song;
    public $singer_name;
    public $author_name;
    public $parent_cate;
    public $name_vi;
    public $lyrics_vi;
	public function tableName()
	{
		return 'song';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('song_name', 'required'),
			array('stt, singer_id, listen, album_id, download, hot,order_number, new, status, isTopsong, author_id, category_id', 'numerical', 'integerOnly'=>true),
			array('song_name, link_app, image', 'length', 'max'=>255),
			array('lyrics, create_date, description', 'safe'),
			array('image','file','allowEmpty'=>true,'types'=>'jpg,png,jpeg,gif','maxSize'=>1024*1024*1,'on'=>'insert,update'),
			array('link','file','allowEmpty'=>true,'types'=>'mp3','maxSize'=>1024*1024*500,'on'=>'insert,update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('song_id, stt, song_name, lyrics, link, singer_id, listen, album_id, create_date, download, order_number, hot, new, status, link_app, image, isTopsong, author_id, category_id, description', 'safe', 'on'=>'search'),
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
			'song_id' => 'Lecture',
			'stt' => 'Stt',
			'song_name' => 'Lecture Name',
			'lyrics' => 'Lyrics',
			'link' => 'Upload File',
			'singer_id' => 'Singer',
			'listen' => 'Listen',
			'album_id' => 'Series',
			'create_date' => 'Create Date',
			'download' => 'Download',
			'hot' => 'Hot',
			'new' => 'New',
			'status' => 'Status',
			'link_app' => 'Link App',
            'link_song' => 'Url',
			'image' => 'Image',
			'isTopsong' => 'Most Favorites',
			'author_id' => 'Author',
			'category_id' => 'Category',
            'order_number'=> 'Order Number',
			'description' => 'Description'
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

		$criteria->compare('song_id',$this->song_id);
		$criteria->compare('stt',$this->stt);
		$criteria->compare('song_name',$this->song_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('lyrics',$this->lyrics,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('singer_id',$this->singer_id);
		$criteria->compare('listen',$this->listen);
		$criteria->compare('album_id',$this->album_id);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('download',$this->download);
		$criteria->compare('hot',$this->hot);
		$criteria->compare('new',$this->new);
		$criteria->compare('status',$this->status);
		$criteria->compare('link_app',$this->link_app,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('isTopsong',$this->isTopsong);
		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('category_id',$this->category_id);
        $criteria->compare('order_number',$this->order_number);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                //'defaultOrder'=>'order_number ASC,song_id DESC',
				'defaultOrder'=>'song_id DESC',
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Song the static model class
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
    public static function isTopSong($type,$code=NULL) {
        $_items = array(
            'isTopsong' => array(
                '0' => 'No',
                '1' => 'Yes',
            ),
        );
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }
	public function topSong()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('song_id',$this->song_id);
        $criteria->compare('stt',$this->stt);
        $criteria->compare('song_name',$this->song_name,true);
		$criteria->compare('description',$this->description,true);
        $criteria->compare('lyrics',$this->lyrics,true);
        $criteria->compare('link',$this->link,true);
        $criteria->compare('singer_id',$this->singer_id);
        $criteria->compare('listen',$this->listen);
        $criteria->compare('album_id',$this->album_id);
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('download',$this->download);
        $criteria->compare('hot',$this->hot);
        $criteria->compare('new',$this->new);
        $criteria->compare('status',$this->status);
        $criteria->compare('link_app',$this->link_app,true);
        $criteria->compare('image',$this->image,true);
        $criteria->compare('isTopsong',1);
        $criteria->compare('author_id',$this->author_id);
        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('order_number',$this->order_number);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'listen DESC'
            )
        ));
    }
	public function findIn($val){
        $criteria=new CDbCriteria;
        $criteria->addInCondition('song_id', explode(',', $val));
        $arr = $this->findAll($criteria);
        $result = array();
        foreach($arr as $item){
            $result[] = array(
                'id' => $item->song_id,
                'name' => $item->song_name,
            );
        }
        return $result;
    }
}
