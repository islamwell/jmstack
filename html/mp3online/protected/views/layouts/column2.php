<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>


<div id="content">
<div class="inner-right-column">
<div class="box save-box">
<div class="submit-row clearfix">
<?php	$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'What would you like to do?',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
</div>
</div>
            
</div>
<?php echo $content; ?>
</div><!-- content -->

<?php $this->endContent(); ?>