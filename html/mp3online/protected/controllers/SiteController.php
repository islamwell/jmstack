<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
		
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	public function actionNotification()
	{
		//ini_set('display_errors', 1);
		
		$model=new NotificationForm();

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='notification-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['NotificationForm']))
		{
			$model->attributes=$_POST['NotificationForm'];
			$message = $_POST['NotificationForm']['message'];

			Constants::adminNotification($message);
			// validate user input and redirect to the previous page if valid
			Yii::app()->user->setFlash('success', "Send notification successful!");
			$this->redirect(array('notification'));
		}
		// display the login form
		$this->render('push_notification',array('model'=>$model));
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
    public function actionUpload() {

        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $folder = Yii::getPathOfAlias('webroot') . '/upload/'; // folder for uploaded files
        $allowedExtensions = array("mp3", "jpg", "jpeg", "gif", "exe", "mov", "mp4"); //array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 1024 *1024 * 1024 * 1024; // maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

        $fileSize = filesize($folder . $result['filename']); //GETTING FILE SIZE
        $fileName = $result['filename']; //GETTING FILE NAME
        //$img = CUploadedFile::getInstance($model,'image');

        echo $return; // it's array
    }

    public function actionChangePassword()
    {
        $model=new User;

        if(isset($_POST['User']))
        {
            $user_id = Yii::app()->user->id;
            $model = User::model()->findByPk(intval($user_id));
            //echo $user_id;die();
            //var_dump($model);exit;
            $model->attributes=$_POST['User'];

            if($model->validate())
            {
                $model->password = md5($model->newPassword);
                $model->save();
                Yii::app()->user->logout();
                $this->redirect(array('login'));
            }

        }
        $this->render('changePassword',array('model'=>$model));
    }
}