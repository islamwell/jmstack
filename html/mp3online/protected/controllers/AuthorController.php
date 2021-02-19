<?php

class AuthorController extends Controller
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
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$model=new Author;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Author']))
		{
			$model->attributes=$_POST['Author'];
            $name_vi = $_POST['Author']['name_vi'];
            $profile_vi = $_POST['Author']['profile_vi'];
            $uploadedFile = CUploadedFile::getInstance($model,'author_img');
            if(is_object($uploadedFile)&& get_class($uploadedFile)=== 'CUploadedFile')
            {
                $time_string = time();
                $name_file = $time_string. $uploadedFile->name;
                $model->author_img = $name_file;
            }
			if($model->save())
            {
                if(isset($uploadedFile)&& strlen($uploadedFile->size)>0)
                {
                    $uploadedFile->saveAs(Yii::app()->basePath.'/../images/author/'.$model->author_img);
                }

                if(strlen($name_vi)>0)
                {
                    $trans = new Translattions();
                    $trans->table_name = 'author';
                    $trans->model_id = $model->author_id;
                    $trans->attribute = 'author_name';
                    $trans->lang = 'vi';
                    $trans->value = $name_vi;
                    $trans->save(false);
                }
                if(strlen($profile_vi)>0)
                {
                    $trans = new Translattions();
                    $trans->table_name = 'author';
                    $trans->model_id = $model->author_id;
                    $trans->attribute = 'profile';
                    $trans->lang = 'vi';
                    $trans->value = $profile_vi;
                    $trans->save(false);
                }


            }
				$this->redirect(array('view','id'=>$model->author_id));
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
        $oldImage = $model->author_img;

        $tran = Translattions::model()->find('table_name = "author" AND attribute = "author_name" AND model_id ='.$id);
        $trans = Translattions::model()->find('table_name = "author" AND attribute = "profile" AND model_id ='.$id);


        // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Author']))
		{
			$model->attributes=$_POST['Author'];
            $name_vi = $_POST['Author']['name_vi'];
            $profile_vi = $_POST['Author']['profile_vi'];

           // echo($name_telugu).'...++++++'.$profile_telugu; exit;
            $_POST['Author']['author_img'] = $model->author_img;
            $uploadedFile=CUploadedFile::getInstance($model,'author_img');
            if(is_object($uploadedFile)&& get_class($uploadedFile)=== 'CUploadedFile')
            {
                $time_string = time();
                $name_file = $time_string. $uploadedFile->name;
                $model->author_img = $name_file;
            }
            else
            {
                $model->author_img = $oldImage;
            }

			if($model->save())
            {
                if(!empty($uploadedFile))
                {

                    if(isset($uploadedFile) && strlen($uploadedFile->size)>0){
                        if($model->author_img != $oldImage && strlen($oldImage)>0){
							if(file_exists(Yii::app()->basePath.'/../images/author/'. $oldImage))
							{
								unlink(Yii::app()->basePath.'/../images/author/'. $oldImage);
							}
                            
                            $uploadedFile->saveAs(Yii::app()->basePath.'/../images/author/'.$name_file);  // image
                        }
                        $uploadedFile->saveAs(Yii::app()->basePath.'/../images/author/'.$name_file);  // image
                    }
                }

                if(count($tran)>0)
                {
                    $tran->value = $name_vi;
                    $tran->save(false);
                }
                else
                {
                    $tran = new Translattions();
                    $tran->table_name = 'author';
                    $tran->model_id = $id;
                    $tran->attribute = 'author_name';
                    $tran->lang = 'vi';
                    $tran->value = $name_vi;
                    $tran->save(false);
                }

                if(count($trans)>0)
                {
                    $trans->value = $profile_vi;
                    $trans->save(false);
                }
                else
                {
                    $trans = new Translattions();
                    $trans->table_name = 'author';
                    $trans->model_id = $id;
                    $trans->attribute = 'profile';
                    $trans->lang = 'vi';
                    $trans->value = $profile_vi;
                    $trans->save(false);
                }

				$this->redirect(array('view','id'=>$model->author_id));
            }
		}
        if(count($tran)>0)
            $model['name_vi'] = $tran->value;
        if(count($trans)>0)
            $model['profile_vi'] = $trans->value;
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
        $model = Author::model()->findByPk($id);
        $oldImage = $model->author_img;
        if(strlen($oldImage)> 0)
        {
			if(file_exists(Yii::app()->basePath.'/../images/author/'.$oldImage))
			{
				unlink(Yii::app()->basePath.'/../images/author/'.$oldImage);
			}            
        }
        $model->delete();

        Translattions::model()->deleteAll('model_id ='.$id,'and table_name = "author"');


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
		$dataProvider=new CActiveDataProvider('Author');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Author('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Author']))
			$model->attributes=$_GET['Author'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Author the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Author::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Author $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='author-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
