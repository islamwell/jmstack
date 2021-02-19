<?php
/* @var $this BannerController */
/* @var $model Banner */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'banner-form',
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
	),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php if ($model->isNewRecord != '1'){ ?>
		<div class="row">
			<?php
			if($model->image!=NULL)
			{
				?>
				<?php
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/banner/'.$model->image,"image",array("width"=>150));
			}
			else  echo CHtml::image(Yii::app()->request->baseUrl.'/images/www/no_image.jpg',"image",array("width"=>100));
			?>
		</div>
	<?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo CHtml::activeFileField($model,'image'); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>
	
	<div class="row">
		<?php
		if($_REQUEST['type'] == Constants::TYPE_BANNER_NORMAL)
			echo '<p style="color: red">'.'Image size should is 720x120'.'</p>';
		else  // radio banner
			echo '<p style="color: red">'.'Image size should is 720x1080'.'</p>';
		?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<!--<div class="row">
		<?php /*echo $form->labelEx($model, 'content'); */?>
		<?php
/*		//echo $form->textArea($model, 'content', array('rows' => 6, 'cols' => 50));
		$this->widget('ext.editMe.widgets.ExtEditMe', array(
			'model'=>$model,
			'attribute'=>'content',
			//        'optionName'=>'optionValue',
		));
		*/?>
		<?php /*echo $form->error($model, 'content'); */?>
	</div>-->

	<!--<div class="row">
		<?php /*echo $form->labelEx($model,'image'); */?>
		<?php /*echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255)); */?>
		<?php /*echo $form->error($model,'image'); */?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', array(1=>'Active',0=>'Inactive')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->