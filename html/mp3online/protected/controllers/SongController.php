<?php

class SongController extends Controller
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
                'actions'=>array('admin','topSongs'),
                'users'=>array('@'),
                'expression'=>'Yii::app()->user->isCustomer()'
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete','DownloadMusic', 'topSongs','topSongsIndex','listSong','addToAlbum','loadCategory',
                'listen','checkLink','listSong'),
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
		$model= Song::model()->findByPk($id);
        $model->listen= $model->listen +1;
        $model->save(false);
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    public function actionListen()
    {
        $id = $_POST['id'];
        //  echo $id;exit;
        $model= Song::model()->findByPk($id);
        $model->listen= $model->listen +1;
        $model->save(false);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Song;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Song']))
        {
            $model->attributes=$_POST['Song'];
            $linksong= $_POST['Song']['link_song'];
            //$lyrics_vi = $_POST['Song']['lyrics_vi'];

            $uploadedFile = CUploadedFile::getInstance($model,'link');

            if(strlen($linksong) == 0)
            {
                if(is_object($uploadedFile)&& get_class($uploadedFile)=== 'CUploadedFile')
                {
                    $name_file =  strtotime('now').rand(0,99).'.'.$uploadedFile->getExtensionName();
                    $model->link = $name_file;
                }
            }
            else
            {
                if(is_object($uploadedFile)&& get_class($uploadedFile)=== 'CUploadedFile')
                {                    
                    $name_file =  strtotime('now').rand(0,99).'.'.$uploadedFile->getExtensionName();
                    $model->link = $name_file;
                }
                else
                    $model->link = $linksong;
            }

            $uploadedFile1 = CUploadedFile::getInstance($model,'image');
            if(is_object($uploadedFile1)&& get_class($uploadedFile1)=== 'CUploadedFile')
            {                
                $name_file =  strtotime('now').rand(0,99).'.'.$uploadedFile1->getExtensionName();
                $model->image = $name_file;
            }

            if($model->save())
            {
                /*if(strlen($linksong) == 0)
                {*/
                    if(isset($uploadedFile) && strlen($uploadedFile->size)>0)
                    {
                        $uploadedFile->saveAs(Yii::app()->basePath.'/../upload/'.$model->link);
                    }
                //}

                if(isset($uploadedFile1) && strlen($uploadedFile1->size)>0)
                {
                    $url = str_replace('protected','',Yii::app()->basePath);
                    $uploadedFile1->saveAs($url.'/images/song/'.$model->image);
                }

                if($model->status == Constants::STATUS_ACTIVE)
                {
                    Constants::pushNotification($model->song_id);
                }

                $this->redirect(array('admin'));
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
        $oldImage = $model->image;
        $oldLink = $model->link;
        //echo $oldLink;exit;
        $oldCate = $model->category_id;

        $tran = Translattions::model()->find('table_name = "song" AND attribute = "song_name" AND model_id ='.$id);
       // $trans = Translattions::model()->find('table_name = "song" AND attribute = "lyrics" AND model_id ='.$id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Song']))
        {
            $model->attributes=$_POST['Song'];
            $linksong= $_POST['Song']['link_song'];
            //$name_vi = $_POST['Song']['name_vi'];
            //$lyrics_vi = $_POST['Song']['lyrics_vi'];
            $uploadedFile = CUploadedFile::getInstance($model,'link');
            if(strlen($linksong) == 0)
            {
                if(is_object($uploadedFile)&& get_class($uploadedFile)=== 'CUploadedFile')
                {                    
                    $name_file =  strtotime('now').rand(0,99).'.'.$uploadedFile->getExtensionName();
                    $model->link = $name_file;
                }
                else
                {
                    $model->link = $oldLink;
                }
            }
            else
            {
                if(count($uploadedFile) > 0)
                {
                    if(is_object($uploadedFile)&& get_class($uploadedFile)=== 'CUploadedFile')
                    {                        
                        $name_file =  strtotime('now').rand(0,99).'.'.$uploadedFile->getExtensionName();
                        $model->link = $name_file;
                    }
                    else
                    {
                        $model->link = $oldLink;
                    }
                }
                else
                    $model->link = $linksong;
            }

            $uploadedFile1 = CUploadedFile::getInstance($model,'image');


            if(is_object($uploadedFile1)&& get_class($uploadedFile1)=== 'CUploadedFile')
            {                
                $name_file =  strtotime('now').rand(0,99).'.'.$uploadedFile1->getExtensionName();
                $model->image = $name_file;
            }
            else
            {
                $model->image = $oldImage;
            }

            if($model->save())
            {
                //echo str_replace('protected','',Yii::app()->basePath);exit;
                if(strlen($linksong) > 0)
                {
                    if(substr_count($oldLink,'http') == 0)
                    {
                        if(file_exists(Yii::app()->basePath.'/../upload/'.$oldLink))
                        {
                            unlink(Yii::app()->basePath.'/../upload/'.$oldLink);
                        }                        
                    }

                }
                else
                {
                    if(!empty($uploadedFile))
                    {
                        //  echo 123;exit;
                        if(isset($uploadedFile)&& strlen($uploadedFile->size)>0){
                            if(($model->link)!= $oldLink && strlen($oldLink)>0)
                            {
                                if(substr_count($oldLink,'http') == 0)
                                {
                                    if(file_exists(Yii::app()->basePath.'/../upload/'.$oldLink)){
                                    unlink(Yii::app()->basePath.'/../upload/'.$oldLink);
                                    }
                                }

                                $uploadedFile->saveAs(Yii::app()->basePath.'/../upload/'.$model->link);
                            }
                            $uploadedFile->saveAs(Yii::app()->basePath.'/../upload/'.$model->link);
                        }
                    }
                }

                //}

                if(!empty($uploadedFile1))
                {
                    if(isset($uploadedFile1)&& strlen($uploadedFile1->size)>0){
                        if(($model->image)!= $oldImage && strlen($oldImage)>0)
                        {
                            if(file_exists(Yii::app()->basePath.'/../images/song/'.$oldImage))
                            {
                                unlink(Yii::app()->basePath.'/../images/song/'.$oldImage);
                            }
                            $uploadedFile1->saveAs(Yii::app()->basePath.'/../images/song/'.$name_file);
                        }
                        $uploadedFile1->saveAs(Yii::app()->basePath.'/../images/song/'.$name_file);
                    }
                }

                $this->redirect(array('admin'));

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
        $model = Song::model()->findByPk($id);
        $oldImage = $model->image;
        $oldLink = $model->link;
        if(strlen($oldLink)> 0)
        {
            if(substr_count($oldLink,'http') == 0)
            {
                if(file_exists(Yii::app()->basePath.'/../upload/'.$oldLink)){
                    unlink(Yii::app()->basePath.'/../upload/'.$oldLink);
                }
            }
        }
        if(strlen($oldImage)> 0)
        {
            if(file_exists(Yii::app()->basePath.'/../images/song/'. $oldImage))
            unlink(Yii::app()->basePath.'/../images/song/'. $oldImage);
        }
        $model->delete();

        //Translattions::model()->deleteAll('model_id ='.$id,'and table_name = "song"');

        $this->redirect(array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Song');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Song('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Song']))
            $model->attributes=$_GET['Song'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }
	
	public function actiontopSongs()
    {
        $model=new Song();
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Song']))
            $model->attributes=$_GET['Song'];

        $this->render('top',array(
            'model'=>$model,
        ));
    }

    public function actiontopSongsIndex()
    {
        $dataProvider=Song::model()->topSong();
        $this->render('topIndex',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    public function actionDownloadMusic($id)
    {
        //echo $id;exit;
        $model = Song::model()->findByPk($id);
        $model->download= $model->download +1;
        $model->save();

        $fileDir= Yii::app()->request->baseUrl.'/upload/';

        //echo $_SERVER['HTTP_HOST'].($fileDir.$model->image); exit;
        Yii::app()->request->sendFile(
            $model->link,
            file_get_contents('http://'.$_SERVER['HTTP_HOST'].($fileDir.$model->link)),$model->link
        );
    }

    public function actionCheckLink($id)
    {
        //$id = $_POST['id'];
        // echo $id;exit;
        $model = Song::model()->findByPk($id);
        if(substr_count($model->link,'http')>0)
            echo 1;
        else
            echo 0;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Song the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Song::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Song $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='song-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionLoadCategory()
    {
        // echo $_POST['Album']['parent_cate'];exit;
        $data=Category::model()->findAll('parentId =:parent_id',
            array(':parent_id'=>(int) $_POST['Song'] ['parent_cate']));


        $data=CHtml::listData($data,'category_id','category_name');
        echo "<option value=''>Select Sub Category</option>";
        foreach($data as $value=>$name)
        {
            echo CHtml::tag('option',
                array('value'=>$value),CHtml::encode($name),true);
        }
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
}
