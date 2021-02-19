<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>


<div style="clear:both;"></div>

<?php
if(!Yii::app()->user->isGuest)
{
?>

<div id="piecemaker-container" class="span-22 prepend-1 append-1">
</div>
    
   

<?php } ?>

