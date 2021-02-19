<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
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
        if($model->category_img!=NULL)
        {
            ?>
            <?php
            echo CHtml::image(Yii::app()->request->baseUrl.'/images/category/'.$model->category_img,"image",array("width"=>150));
        }
        else  echo CHtml::image(Yii::app()->request->baseUrl.'/images/www/no_image.jpg',"image",array("width"=>100));
        ?>
    </div>
    <?php } ?>

    <div class="row">
        <?php echo $form->labelEx($model,'category_img'); ?>
        <?php echo CHtml::activeFileField($model,'category_img'); ?>
        <?php echo $form->error($model,'category_img'); ?>
    </div>

	<div class="row" style="width: 694px">
		<?php echo $form->labelEx($model,'category_name'); ?>
		<?php echo $form->textField($model,'category_name',array('size'=>60,'maxlength'=>255)); ?>
        <?php
/*        $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs' => array(
                'English' =>$form->telField($model, 'category_name', array('type' => 'text', 'class' => 'form-control span12')),
                'Vietnamese' =>$form->telField($model, 'name_vi', array('type' => 'text', 'class' => 'form-control span12')),
               // $language1 =>$form->telField($model, 'title_lang1', array('type' => 'text', 'class' => 'form-control span12')),
            ),
            'options' => array(
                'collapsible' => true,
            ),
        ));
        */?>
		<?php echo $form->error($model,'category_name'); ?>
	</div>

    <?php if($model->category_id) { ?>
    <div class="row">
        <?php echo $form->labelEx($model,'parentId'); ?>
        <?php echo $form->dropDownList($model,'parentId', CHtml::listData(Category::model()->findAll(),'category_id','category_name'),array('prompt' => 'No Parent','disabled' => 'disabled')); ?>
        <?php echo $form->error($model,'parentId'); ?>
    </div>
    <?php } else { ?>
        <div class="row">
        <?php echo $form->labelEx($model,'parentId'); ?>
        <select name="Category[parentId]" id="Category_parentId">
            <?php
            if ($model->parentId == 0)
                echo "<option value=0 selected>No Parent</option>";
            else
                echo "<option value=0>No Parent</option>";
            $parents = Category::model()->findAll('parentId =0 and status = 1');
            foreach ($parents as $item) {
                $chidlren = Category::model()->findAll('parentId =' . $item->category_id . ' and status = 1');
                if ($model->parentId == $item->category_id)
                    echo "<option value=" . $item->category_id . " selected>" . '+ ' . $item->category_name . "</option>";
                else
                    echo "<option value=" . $item->category_id . ">" . '+ ' . $item->category_name . "</option>";

                if (count($chidlren) > 0) {
                    foreach ($chidlren as $sub1) {
                        if ($model->parentId == $sub1->category_id)
                            echo "<option value=" . $sub1->category_id . " selected>" . "&nbsp&nbsp---" . $sub1->category_name . "</option>";
                        else
                            echo "<option value=" . $sub1->category_id . ">" . "&nbsp&nbsp---" . $sub1->category_name . "</option>";

                        $chidlren2 = Category::model()->findAll('parentId =' . $sub1->category_id . ' and status = 1');
                        if (count($chidlren2) > 0) {
                            foreach ($chidlren2 as $sub2) {
                                if ($model->parentId == $sub2->category_id)
                                    echo "<option value=" . $sub2->category_id . " selected>" . "&nbsp&nbsp------" . $sub2->category_name . "</option>";
                                else
                                    echo "<option value=" . $sub2->category_id . ">" . "&nbsp&nbsp------" . $sub2->category_name . "</option>";

                                $chidlren3 = Category::model()->findAll('parentId =' . $sub2->category_id . ' and status = 1');
                                if (count($chidlren3) > 0) {
                                    foreach ($chidlren3 as $sub3) {
                                        if ($model->parentId == $sub3->category_id)
                                            echo "<option value=" . $sub3->category_id . " selected>" . "&nbsp&nbsp---------" . $sub3->category_name . "</option>";
                                        else
                                            echo "<option value=" . $sub3->category_id . ">" . "&nbsp&nbsp---------" . $sub3->category_name . "</option>";

                                        /*$chidlren4 = Category::model()->findAll('parentId =' . $sub3->category_id . ' and status = 1');
                                        if (count($chidlren4) > 0) {
                                            foreach ($chidlren4 as $sub4) {
                                                if ($model->parentId == $sub4->category_id)
                                                    echo "<option value=" . $sub4->category_id . " selected>" . "&nbsp&nbsp------------" . $sub4->category_name . "</option>";
                                                else
                                                    echo "<option value=" . $sub4->category_id . ">" . "&nbsp&nbsp------------" . $sub4->category_name . "</option>";
                                            }
                                        }*/
                                    }
                                }
                            }
                        }
                    }
                }
            }
            ?>
        </select>
        <?php echo $form->error($model,'parentId'); ?>
        </div>
    <?php } ?>

    <div class="row">
        <?php echo $form->labelEx($model,'order_number'); ?>
        <?php echo $form->textField($model,'order_number'); ?>
        <?php echo $form->error($model,'order_number'); ?>
    </div>

    <div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', array(1=>'Active',0=>'Inactive')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

    <!--</div>-->
    <br>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->