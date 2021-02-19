<?php

class SingerController extends Controller
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
		$model=new Singer;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Singer']))
		{
			$model->attributes=$_POST['Singer'];
            $name_vi = $_POST['Singer']['name_vi'];
            //$profile_vi = $_POST['Singer']['profile_vi'];
            $uploadedFile=CUploadedFile::getInstance($model,'singer_img');
            if (is_object($uploadedFile) && get_class($uploadedFile) === 'CUploadedFile') 
			{
                $time_string = time();
                $name_file = $time_string. $uploadedFile->name;
                $model->singer_img = $name_file;
            }
			if($model->save())
            {
                if(isset($uploadedFile) && $uploadedFile->size>0){
                    $uploadedFile->saveAs(Yii::app()->basePath.'/../images/singer/'.$name_file);  // image
                }

                if(strlen($name_vi)>0)
                {
                    $trans = new Translattions();
                    $trans->table_name = 'singer';
                    $trans->model_id = $model->singer_id;
                    $trans->attribute = 'singer_name';
                    $trans->lang = 'vi';
                    $trans->value = $name_vi;
                    $trans->save(false);
                }
                /*if(strlen($profile_vi)>0)
                {
                    $trans = new Translattions();
                    $trans->table_name = 'singer';
                    $trans->model_id = $model->singer_id;
                    $trans->attribute = 'profile';
                    $trans->lang = 'vi';
                    $trans->value = $profile_vi;
                    $trans->save(false);
                }*/

                $this->redirect(array('view','id'=>$model->singer_id));
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
        $oldImage = $model->singer_img;

        $tran = Translattions::model()->find('table_name = "singer" AND attribute = "singer_name" AND model_id ='.$id);
        //$trans = Translattions::model()->find('table_name = "singer" AND attribute = "profile" AND model_id ='.$id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Singer']))
		{
			$model->attributes=$_POST['Singer'];
            $name_vi = $_POST['Singer']['name_vi'];
            //$profile_vi = $_POST['Singer']['profile_vi'];

            $_POST['Singer']['singer_img'] = $model->singer_img;
            $uploadedFile=CUploadedFile::getInstance($model,'singer_img');
            if(is_object($uploadedFile)&& get_class($uploadedFile)=== 'CUploadedFile')
            {
                $time_string = time();
                $name_file = $time_string. $uploadedFile->name;
                $model->singer_img = $name_file;
            }
            else
            {
                $model->singer_img = $oldImage;
            }
			if($model->save())
            {
                if(!empty($uploadedFile))
                {

                    if(isset($uploadedFile) && strlen($uploadedFile->size)>0){
                        if($model->singer_img != $oldImage && strlen($oldImage)>0){
                            if(file_exists(Yii::app()->basePath.'/../images/singer/'. $oldImage)){
                                unlink(Yii::app()->basePath.'/../images/singer/'. $oldImage);
                            }
                            $uploadedFile->saveAs(Yii::app()->basePath.'/../images/singer/'.$name_file);  // image
                        }
                        $uploadedFile->saveAs(Yii::app()->basePath.'/../images/singer/'.$name_file);  // image
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
                    $tran->table_name = 'singer';
                    $tran->model_id = $id;
                    $tran->attribute = 'singer_name';
                    $tran->lang = 'vi';
                    $tran->value = $name_vi;
                    $tran->save(false);
                }

                /*if(count($trans)>0)
                {
                    $trans->value = $profile_vi;
                    $trans->save(false);
                }
                else
                {
                    $trans = new Translattions();
                    $trans->table_name = 'singer';
                    $trans->model_id = $id;
                    $trans->attribute = 'profile';
                    $trans->lang = 'vi';
                    $trans->value = $profile_vi;
                    $trans->save(false);
                }*/

                $this->redirect(array('view','id'=>$model->singer_id));
            }

		}

        if(count($tran)>0)
            $model['name_vi'] = $tran->value;
        /*if(count($trans)>0)
            $model['profile_vi'] = $trans->value;*/

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
        $model = Singer::model()->findByPk($id);
        $oldImage = $model->singer_img;
        if(strlen($oldImage)> 0)
        {
            if(file_exists(Yii::app()->basePath.'/../images/singer/'. $oldImage)){
                unlink(Yii::app()->basePath.'/../images/singer/'.$oldImage);
            }
        }
        $model->delete();

        Translattions::model()->deleteAll('model_id ='.$id,'and table_name = "singer"');


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
		$dataProvider=new CActiveDataProvider('Singer');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Singer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Singer']))
			$model->attributes=$_GET['Singer'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Singer the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Singer::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Singer $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='singer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
