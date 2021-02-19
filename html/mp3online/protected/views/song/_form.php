<?php
/* @var $this SongController */
/* @var $model Song */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'song-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'song_name'); ?>
        <?php echo $form->textField($model, 'song_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php
        /*        $this->widget('zii.widgets.jui.CJuiTabs', array(
                    'tabs' => array(
                        'English' =>$form->telField($model, 'song_name', array('type' => 'text', 'class' => 'form-control span12')),
                        'Vietnamese' =>$form->telField($model, 'name_vi', array('type' => 'text', 'class' => 'form-control span12')),
                    ),
                    'options' => array(
                        'collapsible' => true,
                    ),
                ));
                */ ?>
        <?php echo $form->error($model, 'song_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php
        //echo $form->textArea($model, 'include', array('rows' => 6, 'cols' => 50));
        $this->widget('ext.editMe.widgets.ExtEditMe', array(
            'model' => $model,
            'attribute' => 'description',
            //        'optionName'=>'optionValue',
        ));
        ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <!--<div class="row">
        <?php /*echo $form->labelEx($model,'lyrics'); */ ?>
        <?php /*/*echo $form->textField($model,'lyrics',array('size'=>60,'maxlength'=>255)); */ ?>
        <?php
    /*        $this->widget('zii.widgets.jui.CJuiTabs', array(
                'tabs' => array(
                    'English' =>$form->textArea($model, 'lyrics', array('type' => 'text', 'rows'=>5, 'class' => 'form-control span12')),
                    'Vietnamese' =>$form->textArea($model, 'lyrics_vi', array('type' => 'text', 'rows'=>5, 'class' => 'form-control span12')),
                ),
                'options' => array(
                    'collapsible' => true,
                ),
            ));
            */ ?>
        <?php /*echo $form->error($model,'lyrics'); */ ?>
    </div>-->


    <?php if ($model->isNewRecord != '1') { ?>
        <div class="row">
            <?php
            if ($model->link != NULL) {
                ?>
                <?php

                if (substr_count($model->link, 'http') > 0) {
                    $url = '<a href="' . $model->link . '" onclick="listen(' . $model->song_id . ');" >' . $model->link . '</a>';
                    echo $url;
                } else
                    echo $url = '<a href="' . Yii::app()->request->baseUrl . '/upload/' . $model->link . '" onclick="listen(' . $model->song_id . ');" >' . $model->link . '</a>';
            } else  echo 'File is not uploaded yet.';
            ?>
        </div>
    <?php } ?>

    <div class="row">
        <div class="span4">
            <?php echo $form->labelEx($model, 'link'); ?>
            <?php echo CHtml::activeFileField($model, 'link'); ?>
            <?php echo $form->error($model, 'link'); ?>
        </div>

        <div class="span4">
            <?php echo $form->labelEx($model, 'link_song'); ?>
            <?php echo $form->textField($model, 'link_song', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'link_song'); ?>
        </div>

        <!--<div style="float: right;margin-top: -50px">
            <?php /*echo $form->labelEx($model,'singer_id'); */ ?>
            <?php
        /*            echo $form->hiddenField($model, 'singer_id');
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                        'name' => 'singer_id',
                        'sourceUrl' => array('auto/Complete'),
                        'value' =>  ($model->singer_name) ? $model->singer_name : (Singer::model()->findByPk($model->singer_id)) ? Singer::model()->findByPk($model->singer_id)->singer_name : '' ,//if $model->name != '', != Null , get data after "?", else get data after ":"
                        'options' => array(
                            'showAnim' => 'fold',
                            'select' => 'js:function(event, ui){ jQuery("#Song_singer_id").val(ui.item["singer_id"]); }'
                            //'select' => 'js:function(event, ui){ jQuery("'.CHtml::activeId($model,'hostagentId').'").val(ui.item["id"]); }'
                        ),
                        'htmlOptions' => array(
                            //'style'=>'height: 16px; width: 300px;',
                            'class'=>'form-control',
                            'placeholder'=>'Singer name'
                        ),
                    ));
                    //echo(input Host / Agent name);
                    */ ?>
            <?php /*echo $form->error($model,'singer_id'); */ ?>
        </div>-->

    </div>



    <?php if ($model->isNewRecord != '1') { ?>

        <div class="row">
            <?php
            if ($model->image != NULL) {
                ?>
                <?php
                echo CHtml::image(Yii::app()->request->baseUrl . '/images/song/' . $model->image, "image", array("width" => 160));
            } else  echo CHtml::image(Yii::app()->request->baseUrl . '/images/www/no_image.jpg', "image", array("width" => 100));
            ?>
        </div>
    <?php } ?>
    
    <div class="row">
        <div class="span4">
            <?php echo $form->labelEx($model, 'image'); ?>
            <?php echo CHtml::activeFileField($model, 'image'); ?>
            <?php echo $form->error($model, 'image'); ?>
        </div>

        <div class="span4">
            <?php echo $form->labelEx($model, 'category_id'); ?>
            <select name="Song[category_id]" id="Song_category_id">
                <?php
                if ($model->category_id == 0)
                    echo "<option value=0 selected>No Parent</option>";
                else
                    echo "<option value=0>No Parent</option>";
                $parents = Category::model()->findAll('parentId =0 and status = 1');
                foreach ($parents as $item) {
                    $chidlren = Category::model()->findAll('parentId =' . $item->category_id . ' and status = 1');
                    if ($model->category_id == $item->category_id)
                        echo "<option value=" . $item->category_id . " selected>" . '+ ' . $item->category_name . "</option>";
                    else
                        echo "<option value=" . $item->category_id . ">" . '+ ' . $item->category_name . "</option>";

                    if (count($chidlren) > 0) {
                        foreach ($chidlren as $sub1) {
                            if ($model->category_id == $sub1->category_id)
                                echo "<option value=" . $sub1->category_id . " selected>" . "&nbsp&nbsp---" . $sub1->category_name . "</option>";
                            else
                                echo "<option value=" . $sub1->category_id . ">" . "&nbsp&nbsp---" . $sub1->category_name . "</option>";

                            $chidlren2 = Category::model()->findAll('parentId =' . $sub1->category_id . ' and status = 1');
                            if (count($chidlren2) > 0) {
                                foreach ($chidlren2 as $sub2) {
                                    if ($model->category_id == $sub2->category_id)
                                        echo "<option value=" . $sub2->category_id . " selected>" . "&nbsp&nbsp------" . $sub2->category_name . "</option>";
                                    else
                                        echo "<option value=" . $sub2->category_id . ">" . "&nbsp&nbsp------" . $sub2->category_name . "</option>";

                                    $chidlren3 = Category::model()->findAll('parentId =' . $sub2->category_id . ' and status = 1');
                                    if (count($chidlren3) > 0) {
                                        foreach ($chidlren3 as $sub3) {
                                            if ($model->category_id == $sub3->category_id)
                                                echo "<option value=" . $sub3->category_id . " selected>" . "&nbsp&nbsp---------" . $sub3->category_name . "</option>";
                                            else
                                                echo "<option value=" . $sub3->category_id . ">" . "&nbsp&nbsp---------" . $sub3->category_name . "</option>";

                                            $chidlren4 = Category::model()->findAll('parentId =' . $sub3->category_id . ' and status = 1');
                                            if (count($chidlren4) > 0) {
                                                foreach ($chidlren4 as $sub4) {
                                                    if ($model->category_id == $sub4->category_id)
                                                        echo "<option value=" . $sub4->category_id . " selected>" . "&nbsp&nbsp------------" . $sub4->category_name . "</option>";
                                                    else
                                                        echo "<option value=" . $sub4->category_id . ">" . "&nbsp&nbsp------------" . $sub4->category_name . "</option>";
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                        }
                    }
                }
                ?>
            </select>
            <?php echo $form->error($model, 'category_id'); ?>
        </div>

        <div class="span4">
            <?php echo $form->labelEx($model, 'order_number'); ?>
            <?php echo $form->textField($model, 'order_number'); ?>
            <?php echo $form->error($model, 'order_number'); ?>
        </div>

        <!--<div>
        <?php /*echo $form->labelEx($model,'link_app'); */ ?>
        <?php /*echo $form->textField($model,'link_app',array('size'=>60,'maxlength'=>255));   */ ?>
        <?php /*echo $form->error($model,'link_app'); */ ?>
        </div>-->

        <!--<div style="float: right;margin-top: -53px">
            <?php /*echo $form->labelEx($model,'author_id'); */ ?>
            <?php
        /*            echo $form->hiddenField($model, 'author_id');
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                        'name' => 'author_id',
                        'sourceUrl' => array('auto/Complete1'),
                        'value' =>  ($model->author_name) ? $model->author_name: (Author::model()->findByPk($model->author_id)) ? Author::model()->findByPk($model->author_id)->author_name : '',
                        'options' => array(
                            'showAnim' => 'fold',
                            'select' => 'js:function(event, ui){ jQuery("#Song_author_id").val(ui.item["author_id"]); }'
                            //'select' => 'js:function(event, ui){ jQuery("'.CHtml::activeId($model,'hostagentId').'").val(ui.item["id"]); }'
                        ),
                        'htmlOptions' => array(
                            'class'=>'form-control',
                            'placeholder'=>'Author name'
                        ),
                    ));
                    */ ?>
            <?php /*echo $form->error($model,'author_id'); */ ?>
        </div>-->

    </div>


    <div class="row">
        <!--<div style="float: left;margin-right: 20px">-->
        <div class="span4">
            <?php echo $form->labelEx($model, 'album_id'); ?>
            <?php echo $form->dropDownList($model, 'album_id', CHtml::listData(Album::model()->findAll(), 'album_id', 'album_name'), array('prompt' => 'Select Album')); ?>
            <?php echo $form->error($model, 'album_id'); ?>
        </div>

        <div class="span4">
            <?php echo $form->labelEx($model, 'isTopsong'); ?>
            <?php echo $form->dropDownList($model, 'isTopsong', array(1 => 'Yes', 0 => 'No')); ?>
            <?php echo $form->error($model, 'isTopsong'); ?>
        </div>

        <!--<div style="float: right;margin-top: -60px">-->
        <div class="span4">
            <?php echo $form->labelEx($model, 'status'); ?>
            <?php echo $form->dropDownList($model, 'status', array(1 => 'Active', 0 => 'Inactive')); ?>
            <?php echo $form->error($model, 'status'); ?>
        </div>
    </div>
    <br>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script>

</script>