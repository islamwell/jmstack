<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/gridview.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body class="dashboard">

<div id="wrap">
<div id="container">


<div id="header" class="header">
            <div id="branding" style="padding-top:12px;">
              <a href="#"> <img style="width:195px;margin:-18px 2px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png"></a>
            </div>
            <div class="header-content header-content-first">
              <div class="header-column icon">
                <i class="icon-time"></i>
              </div>
              <div class="header-column">
                <span class="time" id="clock"> <?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo date("D M j G:i:s"); ?><!--Check server time--> </span>
				
              </div>
            </div>

              <div id="user-tools">
                
                <span class="user-links">
                  <?php
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
			    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				//array('label'=>'Home', 'url'=>array('/site/index'), 'visible'=>Yii::app()->user->isGuest),
                //array('label'=>'User', 'url'=>array('/user/admin'),'visible'=>Yii::app()->user->isAdmin()),
				
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
              // array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout") , 'visible'=>!Yii::app()->user->isGuest),      
			),
		)); ?>
                  </span>
                
              </div>
            
          </div><!--END HEADER-->
           
<div class="suit-columns two-columns">        
<div id="suit-center" class="suit-column">

<!-- Content -->
<div id="content" class="colMS row-fluid">
  <h2 class="content-title">Site administration</h2>
              
  <div id="content-main" style="width:100%">
  
  	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
	<?php endif?>
	
    <?php echo $content; ?>
  </div>
</div>
<!-- END Content -->

</div>
               
<!--Left Navigation-->          
<div id="suit-left" class="suit-column">
              
<div class="left-nav" id="left-nav">
<?php
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				//array('label'=>'About', 'url'=>array('/site/about'), 'visible'=>Yii::app()->user->isGuest),
				//array('label'=>'Contact', 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Series', 'url'=>array('/album/admin'), 'visible'=>!Yii::app()->user->isGuest),
				//array('label'=>'Composers', 'url'=>array('/author/admin'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Categories', 'url'=>array('/category/admin',/*'parentId' => Constants::CATE_PARENT*/), 'visible'=>!Yii::app()->user->isGuest),
				//array('label'=>'Sub Categories', 'url'=>array('/subCategory/admin'), 'visible'=>!Yii::app()->user->isGuest),
                
				//array('label'=>'Singers', 'url'=>array('/singer/admin'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Lectures ', 'url'=>array('/song/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Most Favorites', 'url'=>array('/song/topSongs'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Radios', 'url'=>array('/radio/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Radio Banner', 'url'=>array('/banner/admin','type' => Constants::TYPE_BANNER_RADIO), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Banners', 'url'=>array('/banner/admin','type' => Constants::TYPE_BANNER_NORMAL), 'visible'=>!Yii::app()->user->isGuest),				
                array('label'=>'Notification', 'url'=>array('/site/notification'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Settings', 'url'=>array('/settings/index'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Change Password', 'url'=>array('/site/changePassword'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
				),
		)); ?>  
</div>

</div>       
</div> 


<div class="clear"></div>
  <div id="footer" class="footer">
    <div class="content">
      <div class="branding" style="padding-bottom:8px;">
          <!--Copyright &copy; <?php /*echo date('Y'); */?> by HiCom Solutions. | All Rights Reserved--> 
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>
