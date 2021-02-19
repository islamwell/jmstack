<?php

class CategoryController extends Controller
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
				'actions'=>array('index','view','indexsub','viewsub'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','createsub','updatesub'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->isAdmin()'
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->isCustomer()'
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','adminsub','deletesub'),
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

    public function actionViewSub($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($parentId = false)
	{
		$model=new Category;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
            $parentId = $_REQUEST['Category']['parentId'];
            $model->parentId = $parentId;
            if($parentId == Constants::CATE_PARENT)
            {
                $model->level = Constants::LEVEL_PARENT;
            }
            else
            {
                $cate = Category::model()->findByPk($parentId);
                /** @var Category $cate */
                if(isset($cate))
                {
                    $model->level = $cate->level + 1;
                }                
            }
            
            $uploadedFile = CUploadedFile::getInstance($model,'category_img');
            if(is_object($uploadedFile)&& get_class($uploadedFile)=== 'CUploadedFile')
            {
                $time_string = time();
                $name_file = $time_string.'.'.$uploadedFile->getExtensionName();
                $model->category_img = $name_file;
            }                       
            
			if($model->save())
            {
                if(isset($uploadedFile) && $uploadedFile->size>0)
                {
                    $uploadedFile->saveAs(Yii::app()->basePath.'/../images/category/'.$model->category_img);
                }

                $this->redirect(array('view','id'=>$model->category_id));
            }

		}

		$this->render('create',array(
			'model'=>$model,
            'parentId' => $parentId
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id,$parentId = false)
	{
		$model=$this->loadModel($id);
        $oldImage= $model->category_img;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			//$parentId = $_REQUEST['Category']['parentId'];
            //$model->parentId = $parentId;

            $_POST['Category']['category_img']=$model->category_img;
            $uploadedFile = CUploadedFile::getInstance($model,'category_img');
            if(is_object($uploadedFile)&& get_class($uploadedFile)=== 'CUploadedFile')
            {
                $time_string = time();
                $name_file = $time_string.'.'.$uploadedFile->getExtensionName();
                $model->category_img = $name_file;
            }
            else
            {
                $model->category_img = $oldImage;
            }
			if($model->save())
            {
                if(!empty($uploadedFile))
                {
                    if(isset($uploadedFile)&& strlen($uploadedFile->size)>0){
                            if(($model->category_img)!= $oldImage && strlen($oldImage)>0)
                                 {
                                     if(file_exists(Yii::app()->basePath.'/../images/category/'. $oldImage)){
                                        unlink(Yii::app()->basePath.'/../images/category/'.$oldImage);
                                     }
                                     $uploadedFile->saveAs(Yii::app()->basePath.'/../images/category/'.$model->category_img);
                                 }
                                $uploadedFile->saveAs(Yii::app()->basePath.'/../images/category/'.$model->category_img);
                    }
                }
                
				$this->redirect(array('view','id'=>$model->category_id));
            }
		}      

		$this->render('update',array(
			'model'=>$model,
            'parentId' => $parentId
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id,$parentId = false)
	{
		$model = Category::model()->findByPk($id);
        $oldImage = $model->category_img;
        if(strlen($oldImage)> 0)
        {
            if(file_exists(Yii::app()->basePath.'/../images/category/'. $oldImage)){
                unlink(Yii::app()->basePath.'/../images/category/'.$oldImage);
            }
        }
        $model->delete();

        //Category::model()->updateSub($id);
		Category::model()->deleteTreeCategory($id);
		//Song::model()->updateAll(array('category_id'=>''),'category_id='.$id);
        //Translattions::model()->deleteAll('model_id ='.$id,'and table_name = "category"');

        
        $this->redirect(array('admin',/*'parentId'=>$parentId*/));

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		/*if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));*/
	}



	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Category');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function actionIndexSub()
    {
        $dataProvider=new CActiveDataProvider('Category');
        $this->render('index_sub',array(
            'dataProvider'=>$dataProvider,
        ));
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin($parentId = false)
	{
		$model=new Category('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];

		$this->render('admin',array(
			'model'=>$model,
            'parentId' => $parentId
		));
	}

    public function actionAdminSub()
    {
        $model=new Category('search_sub');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Category']))
            $model->attributes=$_GET['Category'];

        $this->render('admin_sub',array(
            'model'=>$model,
        ));
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Category the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Category $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
