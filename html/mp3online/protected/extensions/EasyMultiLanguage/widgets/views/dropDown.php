<div class='language-selector-dropdown <?php echo $cssClass; ?>'>
        <?php echo CHtml::beginForm(); ?>

                <?php foreach($languages as $lang => $langName): ?>
                        <?php echo CHtml::hiddenField($lang, EMHelper::createMultilanguageReturnUrl($lang)); ?>
                <?php endforeach ?>

                <?php echo CHtml::dropDownList(
                        '_language_selector', 
                        Yii::app()->language,
                        $languages,
                        array('submit'=>'')
                ); ?>

        <?php echo CHtml::endForm(); ?>
</div>
