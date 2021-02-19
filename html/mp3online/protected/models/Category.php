 <?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $category_id
 * @property string $category_name
 * @property integer $category_img
 * @property integer $status
 * @property integer $parentId
 * @property integer $level
 * @property integer $order_number

 */
class Category extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public  $name_vi;
    public $number_song;
    public $sub_count;
    public function tableName()
    {
        return 'category';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_name', 'required'),
            array('status, level, parentId, order_number', 'numerical', 'integerOnly'=>true),
            array('category_img', 'file', 'allowEmpty' => true, 'types' => 'jpg,jpeg,gif,png', 'maxSize' => 1024 * 1024 * 1, 'on'=>'insert,update'),
            array('category_name', 'length', 'max'=>255),
            array('category_img', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('category_id, category_name, parentId, order_number, category_img, status, level', 'safe', 'on'=>'search'),
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
            'parent' => array(self::BELONGS_TO, 'Category', 'parentId'),
            'children' => array(self::HAS_MANY, 'Category', 'parentId', 'order' => 'order_number'),
            'childCount' => array(self::STAT, 'Category', 'parentId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'category_id' => 'ID',
            'category_name' => 'Name',
            'category_img' => 'Image',
            'status' => 'Status',
            'parentId'=> 'Parent Category',
            'level'=> 'Level',
            'order_number'=> 'Order Number',
			'number_song' => 'Number Of Files'
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
    public function search($parentId = false)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('category_name',$this->category_name,true);
        $criteria->compare('category_img',$this->category_img);
        $criteria->compare('parentId',$this->parentId);
        /*$criteria->compare('parentId',$parentId);*/
        $criteria->compare('level',$this->level);       
        $criteria->compare('status',$this->status);
        $criteria->compare('order_number',$this->order_number);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=> 'level ASC,category_id DESC'
            )
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Category the static model class
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

    public function getIsParent($id)
    {
        $children = Category::model()->findAll('parentId='.$id.' and status=1');
        if (count($children) > 0)
            return 1;
        else
            return 0;
    }

    public function resetIsParent(){
        $all = Category::model()->findAll('status=1');
        foreach ($all as $item)
        {
            $item->isParent = $this->getIsParent($item->category_id);
            $item->save(false);
        }
    }   

    public function updateSub($parentId)
    {
        $sub1 = Category::model()->findAll('parentId ='.$parentId);
        if(count($sub1)>0)
        {
            foreach ($sub1 as $item)
            {
                $item->level = Constants::LEVEL_PARENT;
                if($item->save())
                {
                    for ($i = 1; $i <= 2; $i++)
                    {
                        $subs = Category::model()->findAll('parentId ='.$item->parentId);
                        if (count($subs) == 0)
                        {
                            break;
                        }
                        else
                        {
                            foreach ($subs as $sub)
                            {
                                if($sub->level >= 1)
                                {
                                    $sub->level = $item->level - 1;
                                    $sub->save();
                                }                                
                            }
                        }
                    }
                }                
            }
        }
    }
	
	public function deleteTreeCategory($id)
    {
        /** @var Category $model */
        //$sub2s = $model->childrenR;
        $sub1s = Category::model()->findAll('parentId ='.$id);
        if(count($sub1s)>0)
        {
            /** @var Category $sub1 */
            foreach ($sub1s as $sub1)
            {
                //$sub3s = $sub2->childrenR;
                $sub2s = Category::model()->findAll('parentId ='.$sub1->category_id);
                if(count($sub2s)>0)
                {
                    /** @var Category $sub2 */
                    foreach ($sub2s as $sub2)
                    {
                        //$sub4s = $sub3->childrenR;
                        $sub3s = Category::model()->findAll('parentId ='.$sub2->category_id);
                        if(count($sub3s)>0)
                        {
                            /** @var Category $sub3 */
                            foreach ($sub3s as $sub3)
                            {
                                $sub4s = Category::model()->findAll('parentId ='.$sub3->category_id);
                                if(count($sub4s)>0)
                                {
                                    /** @var Category $sub4 */
                                    foreach ($sub4s as $sub4)
                                    {
                                        $oldImage = $sub4->category_img;
                                        if(strlen($oldImage)> 0)
                                        {
                                            if(file_exists(Yii::app()->basePath.'/../images/category/'. $oldImage)){
                                                unlink(Yii::app()->basePath.'/../images/category/'.$oldImage);
                                            }
                                        }
                                        $sub4->delete();
                                        Song::model()->updateAll(array('category_id'=>''),'category_id='.$sub4->category_id);
                                    }

                                    $oldImage = $sub3->category_img;
                                    if(strlen($oldImage)> 0)
                                    {
                                        if(file_exists(Yii::app()->basePath.'/../images/category/'. $oldImage)){
                                            unlink(Yii::app()->basePath.'/../images/category/'.$oldImage);
                                        }
                                    }
                                    $sub3->delete();
                                    Song::model()->updateAll(array('category_id'=>''),'category_id='.$sub3->category_id);
                                }
                                else
                                {
                                    $oldImage = $sub3->category_img;
                                    if(strlen($oldImage)> 0)
                                    {
                                        if(file_exists(Yii::app()->basePath.'/../images/category/'. $oldImage)){
                                            unlink(Yii::app()->basePath.'/../images/category/'.$oldImage);
                                        }
                                    }
                                    $sub3->delete();
                                    Song::model()->updateAll(array('category_id'=>''),'category_id='.$sub3->category_id);
                                }                                
                            }

                            $oldImage = $sub2->category_img;
                            if(strlen($oldImage)> 0)
                            {
                                if(file_exists(Yii::app()->basePath.'/../images/category/'. $oldImage)){
                                    unlink(Yii::app()->basePath.'/../images/category/'.$oldImage);
                                }
                            }
                            $sub2->delete();
                            Song::model()->updateAll(array('category_id'=>''),'category_id='.$sub2->category_id);
                        }
                        else
                        {
                            $oldImage = $sub2->category_img;
                            if(strlen($oldImage)> 0)
                            {
                                if(file_exists(Yii::app()->basePath.'/../images/category/'. $oldImage)){
                                    unlink(Yii::app()->basePath.'/../images/category/'.$oldImage);
                                }
                            }
                            $sub2->delete();
                            Song::model()->updateAll(array('category_id'=>''),'category_id='.$sub2->category_id);
                        }
                    }

                    $oldImage = $sub1->category_img;
                    if(strlen($oldImage)> 0)
                    {
                        if(file_exists(Yii::app()->basePath.'/../images/category/'. $oldImage)){
                            unlink(Yii::app()->basePath.'/../images/category/'.$oldImage);
                        }
                    }
                    $sub1->delete();
                    Song::model()->updateAll(array('category_id'=>''),'category_id='.$sub1->category_id);
                }
                else
                {
                    $oldImage = $sub1->category_img;
                    if(strlen($oldImage)> 0)
                    {
                        if(file_exists(Yii::app()->basePath.'/../images/category/'. $oldImage)){
                            unlink(Yii::app()->basePath.'/../images/category/'.$oldImage);
                        }
                    }
                    $sub1->delete();
                    Song::model()->updateAll(array('category_id'=>''),'category_id='.$sub1->category_id);
                }
            }
        }        
    }
	
	public function getIdParent($subId)
    {
        $cate = Category::model()->findByPk($subId);
        if(isset($cate))
            return $cate->parentId;
        else
            return Constants::CATE_PARENT;
    }
	
	public function getValueVisible($id)
    {
        $level = '';
        if($id != Constants::CATE_PARENT)
        {
            $cate = Category::model()->findByPk($id);
            /** @var Category $cate */
            if(isset($cate))
            {
                $level = $cate->level;
            }

        }
        else
        {
            $level = 1;
        }

        return $level;
            
    }
	
	public function generateTree($models)
    {
        //var_dump($models);exit;
        $data = array();
        /** @var Category $category */
        foreach ($models as $category) {
            $data[$category->category_id] = array(
                'id'   => $category->category_id,
                'text' => '<a href="'.Yii::app()->request->baseUrl.'/index.php/category/update/'.$category->category_id.'">'.$category->category_name.'</a>',
            );
            /** @var Category $item */
            foreach ($category->childrenR as $item) {
                $data[$category->category_id]['children'][$item->category_id] = array(
                    'id'   => $item->category_id,
                    'text' =>  '<a href="'.Yii::app()->request->baseUrl.'/index.php/category/update/'.$item->category_id.'">'.$item->category_name.'</a>',
                    'expanded' => false,
                );

                foreach ($item->childrenR as $sub2) {
                    $data[$category->category_id]['children'][$item->category_id]['children'][$sub2->category_id] = array(
                        'id'   => $sub2->category_id,
                        'text' =>  '<a href="'.Yii::app()->request->baseUrl.'/index.php/category/update/'.$sub2->category_id.'">'.$sub2->category_name.'<img width="50px" src="'.Yii::app()->request->baseUrl.'/images/category/'.$sub2->category_img.'" />'.'</a>',
                        'expanded' => false,
                    );

                    foreach ($sub2->childrenR as $sub3) {
                        $data[$category->category_id]['children'][$item->category_id]['children'][$sub2->category_id]['children'][$sub3->category_id] = array(
                            'id'   => $sub3->category_id,
                            'text' =>  '<a href="'.Yii::app()->request->baseUrl.'/index.php/category/update/'.$sub3->category_id.'">'.$sub3->category_name.'</a>',
                            'expanded' => false,
                        );

                        foreach ($sub3->childrenR as $sub4) {
                            $data[$category->category_id]['children'][$item->category_id]['children'][$sub2->category_id]['children'][$sub3->category_id]['children'][$sub4->category_id] = array(
                                'id'   => $sub4->category_id,
                                'text' =>  '<a href="'.Yii::app()->request->baseUrl.'/index.php/category/update/'.$sub4->category_id.'">'.$sub4->category_name.'</a>',
                                'expanded' => false,
                            );
                        }
                    }
                }
            }

        }
        return $data;
    }
}