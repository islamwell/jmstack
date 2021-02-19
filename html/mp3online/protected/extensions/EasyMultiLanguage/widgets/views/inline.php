<div class='language-selector-inline <?php echo $cssClass; ?>'>
        <?php foreach($languages as $lang => $langName): ?>
                <?php if($lang == Yii::app()->language): ?>

                        <span class='language-selector-active'><?php echo $langName; ?></span>

                <?php else: ?>

                        <span class='language-selector-notactive'>
                                <?php echo CHtml::link(
                                        $langName, 
                                        EMHelper::createMultilanguageReturnUrl($lang),
                                        array('class'=>'')
                                ); ?>
                        </span>

                <?php endif ?>
        <?php endforeach ?>
</div>
