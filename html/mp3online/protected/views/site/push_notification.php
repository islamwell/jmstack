<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Notification';
$this->breadcrumbs=array(
	'Notification',
);
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notification-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	
	<h1>Notification</h1>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php if(Yii::app()->user->hasFlash('success')):?>
		<div class="info" style="color: red;font-size:14px;font-weight: bold">
			<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
	<?php endif; ?>

	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows' =>  5)); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>

	<div class="row buttons" >
		<?php echo CHtml::submitButton('Send'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
