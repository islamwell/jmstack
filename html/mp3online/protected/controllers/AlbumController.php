<?php

class AlbumController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->isAdmin()'
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->isCustomer()'
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','addSong','listSong','loadCategory'),
				//'users'=>array('admin'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->isAdmin()'
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Album();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Album']))
		{
			$model->attributes=$_POST['Album'];

			$uploadedFile = CUploadedFile::getInstance($model,'album_img');
		    if(is_object($uploadedFile)&& get_class($uploadedFile)=== 'CUploadedFile')
            {
                $time_string = time();
                $name_file = $time_string. '.' .$uploadedFile->getExtensionName();
                $model->album_img = $name_file;
            }
			if($model->save())
			{
                if(isset($uploadedFile)&& strlen($uploadedFile->size)>0)
                {
                    $uploadedFile->saveAs(Yii::app()->basePath.'/../images/album/'.$model->album_img);
                }

				$this->redirect(array('view','id'=>$model->album_id));
            }

		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$oldImage = $model->album_img;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);


		if(isset($_POST['Album']))
		{
			$model->attributes=$_POST['Album'];

            $_POST['Album']['album_img'] = $model->album_img;
			$uploadedFile=CUploadedFile::getInstance($model,'album_img');
            if(is_object($uploadedFile)&& get_class($uploadedFile)=== 'CUploadedFile')
            {
                $time_string = time();
				$name_file = $time_string. '.' .$uploadedFile->getExtensionName();
                $model->album_img = $name_file;
            }
            else
            {
                $model->album_img = $oldImage;
            }

			if($model->save())
			{
				if(!empty($uploadedFile))
                {
                    if(isset($uploadedFile) && strlen($uploadedFile->size)>0){
                        if($model->album_img != $oldImage && strlen($oldImage)>0){
                            if(file_exists(Yii::app()->basePath.'/../images/album/'. $oldImage)){
                                unlink(Yii::app()->basePath.'/../images/album/'. $oldImage);
                            }
                            $uploadedFile->saveAs(Yii::app()->basePath.'/../images/album/'.$model->album_img);  // image
                        }
                        $uploadedFile->saveAs(Yii::app()->basePath.'/../images/album/'.$model->album_img);  // image
                    }
                }

				$this->redirect(array('view','id'=>$model->album_id));
			}				
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $model = Album::model()->findByPk($id);
        $oldImage = $model->album_img;
        if(strlen($oldImage)> 0)
        {
            if(file_exists(Yii::app()->basePath.'/../images/album/'. $oldImage)){
                unlink(Yii::app()->basePath.'/../images/album/'.$oldImage);
            }
        }
        $model->delete();

        //Translattions::model()->deleteAll('model_id ='.$id,'and table_name = "album"');
		Song::model()->updateAll(array('album_id'=>''),'album_id='.$id);

        $this->redirect(array('admin'));
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		/*if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));*/
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Album');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Album('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Album']))
			$model->attributes=$_GET['Album'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    public function actionlistSong()
    {
        $q = $_GET['q'];
        $criteria = new CDbCriteria;
        $criteria->compare('song_name', $q, true);
        $criteria->limit = 10;
        $criteria->offset = 0;
        $rows = Song::model()->findAll($criteria);
        $result = array();
        /** @var Relishes $row */
        foreach($rows as $row){
            $item = array();
            $item['id'] = $row->song_id;
            $item['name'] = $row->song_name;
            $singers = Singer::model()->findByPk($row->singer_id);
           /* if(count($singers)>0){
                $singer_name = $singers->singer_name;
            }
            else{
                $singer_name = 'Update';
            }
            $author = Author::model()->findByPk($row->author_id);
            if(count($author)>0){
                $author_name = $author->author_name;
            }
            else{
                $author_name = 'Update';
            }
            $item['all']=$row->song_name.' || Singer: '.$singer_name.' || Author: '.$author_name.' || Listen: '.$row->listen.' || Download: '.$row->download;*/
            $result[] = $item;
        }

        echo $_GET['callback'] . "(";
        echo CJSON::encode($result);
        echo ")";
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Album the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Album::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Album $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='album-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionLoadCategory()
    {
        // echo $_POST['Album']['parent_cate'];exit;
        $data=Category::model()->findAll('parentId =:parent_id',
            array(':parent_id'=>(int) $_POST['Album'] ['parent_cate']));


        $data=CHtml::listData($data,'category_id','category_name');
        echo "<option value=''>Select Sub Category</option>";
        foreach($data as $value=>$name)
        {
            echo CHtml::tag('option',
                array('value'=>$value),CHtml::encode($name),true);
        }
    }
}
