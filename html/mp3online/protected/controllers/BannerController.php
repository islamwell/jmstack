<?php

class BannerController extends Controller
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
				'actions'=>array('admin','delete'),
				//'users'=>array('admin'),
				'users' => array('@'),
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
	public function actionView($id,$type)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'type' => $type
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($type)
	{
		$model=new Banner;
		$model->type = $type;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Banner']))
		{
			$model->attributes=$_POST['Banner'];
			$uploadedFile = CUploadedFile::getInstance($model,'image');
			if(is_object($uploadedFile)&& get_class($uploadedFile)=== 'CUploadedFile')
			{
				$time_string = time();
				$name_file = $time_string.'.'.$uploadedFile->getExtensionName();
				$model->image = $name_file;
			}

			if($model->save())
			{
				if(isset($uploadedFile) && $uploadedFile->size>0)
				{
					$uploadedFile->saveAs(Yii::app()->basePath.'/../images/banner/'.$model->image);
				}

				$this->redirect(array('view','id'=>$model->id,'type' => $type));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'type' => $type
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id,$type)
	{
		$model=$this->loadModel($id);
		$oldImage = $model->image;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Banner']))
		{
			$model->attributes=$_POST['Banner'];
			$uploadedFile = CUploadedFile::getInstance($model,'image');
			if(is_object($uploadedFile)&& get_class($uploadedFile)=== 'CUploadedFile')
			{
				$time_string = time();
				$name_file = $time_string.'.'.$uploadedFile->getExtensionName();
				$model->image = $name_file;
			}
			else
				$model->image = $oldImage;

			if($model->save())
			{
				if(isset($uploadedFile)&& strlen($uploadedFile->size)>0){
					if(($model->image)!= $oldImage && strlen($oldImage)>0)
					{
						if(file_exists(Yii::app()->basePath.'/../images/banner/'. $oldImage)){
							unlink(Yii::app()->basePath.'/../images/banner/'.$oldImage);
						}
						$uploadedFile->saveAs(Yii::app()->basePath.'/../images/banner/'.$model->image);
					}
					$uploadedFile->saveAs(Yii::app()->basePath.'/../images/banner/'.$model->image);
				}

				$this->redirect(array('view','id'=>$model->id,'type' => $type));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'type' => $type
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id,$type)
	{
		$model = $this->loadModel($id);
		$oldImage = $model->image;
		if(strlen($oldImage)>0)
		{
			if(file_exists(Yii::app()->basePath.'/../images/banner/'. $oldImage)){
				unlink(Yii::app()->basePath.'/../images/banner/'.$oldImage);
			}
		}
			
		$model->delete();
		
		$this->redirect(array('view','id'=>$model->id,'type' => $type));

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
			//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Banner');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($type)
	{
		$model=new Banner('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Banner']))
			$model->attributes=$_GET['Banner'];

		$this->render('admin',array(
			'model'=>$model,
			'type' => $type
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Banner the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Banner::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Banner $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='banner-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
