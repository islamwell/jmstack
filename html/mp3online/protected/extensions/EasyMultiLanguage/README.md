# EasyMultiLanguage

This crazy stuff helps you to implement mulitlanguage to your application almost without code modifications and pain in the ass.
Sit back, relax and enjoy. The magic begins.


## Intro

Imagine that you have a huuuuge application with a lot of logic and views. And one day you need to implement multilanguage system to your existing models. Do you wanna some candy behavior that do all magic ? Welcome my little fella, this is what you need.

## How the hell it works ?

This behavor replace all desired attributes with current language translations. (Except admin routes, where you need all languages as they are, for editing)

Let's say you have default language "ru". And you have this book:

```
$book->name = "Снег";
$book->name_en = "Snow"; // name_en automatically added by behavior

```

Now if you'll change language to "en", You book will looks like this:

```
$book->name = "Snow";
$book->name_en = "Snow"; // name_en automatically added by behavior

```

## Installation

#### 1) Put this piece of happines in your extensions folder

#### 2) Database

Import **"EasyMultiLanguage/data/translations.sql"**

#### 3) In your config

```php

        'import'=>array(
                ...
                'ext.EasyMultiLanguage.*',
                ...
        ),
        ...
        'urlManager'=>array(

                'class'=>'EMUrlManager', // <---- You need this line, but other lines might save you too

                'showScriptName'=>false,
                'urlFormat'=>'path',
                'rules'=>array(

                        '<_c:\w+>/<id:\d+>'=>'<_c>/view',
                        '<_c:\w+>/<_a:\w+>/<id:\d+>'=>'<_c>/<_a>',
                        '<_c:\w+>/<_a:\w+>'=>'<_c>/<_a>',

                        '<_m:\w+>/<_c:\w+>/<_a:\w+>'=>'<_m>/<_c>/<_a>',
                        '<_m:\w+>/<_c:\w+>/<_a:\w+>/<id:\d+>'=>'<_m>/<_c>/<_a>',
                ),
        ),
        ...
	'params'=>array(
                'languages'=>array(
                        'ru' => 'Русский',
                        'en' => 'English',
                        'de' => 'Deutsche',
                ),
                'default_language' => 'ru',
	),

```

#### 4) In your Model

Lets say you have model **Book** with attributes _name_, _author_, _description_ and _status_
And you want to have _name_ and _description_ in English and Deutsche, while your default language is Russian

```php

<?php
class Book extends CActiveRecord
{

        /**
         * __set 
         *
         * Rewrite default setter, so we can dynamically add
         * new virtual attribtues such as name_en, name_ru etc.
         * 
         * @param string $name 
         * @param string $value 
         */
        public function __set($name, $value) 
        {
                if (EMHelper::WinnieThePooh($name, $this->behaviors()))
                        $this->{$name} = $value;
                else
                        parent::__set($name, $value);
        }


        /**
         * behaviors 
         * 
         * @return array
         */
        public function behaviors()
        {
                return array(
                        'EasyMultiLanguage'=>array(
                                 'class'                 => 'ext.EasyMultiLanguage.EasyMultiLanguageBehavior',
                                 'translated_attributes' => array('name', 'description'),
                                 'languages'             => Yii::app()->params['languages'],
                                 'default_language'      => Yii::app()->params['default_language'],
                                 'admin_routes'          => array('book/admin', 'book/update', 'book/create'),
                                 'translations_table'    => 'translations',
                        ),
                );
        }

        ....
}

```

#### 5) In your base Controller ("/components/Controller.php")


```php

<?php
class Controller extends CController
{

        /**
         * init 
         * 
         * Something happening here 
         */
        public function init()
        {
                EMHelper::catchLanguage();

                parent::init();
        }

}

````

## Usage

#### 1) In your view file ("views/book/_form")

You have new virtual attributes _name_en_, _name_de_, _description_en_, _description_de_
You can treat them as normal attributes.

Also nice Html helper is provided. It will create tab switcher between different language inputs.

There are 2 options:
* You have Twitter Bootstrap
* You don't have it

---

If you **have** Twitter Bootstrap

```php

<?php echo EMHelper::megaOgogo($model, $attribute, $htmlOptions = array(), $fieldType = 'textField'); ?>

```

textField

```php

        <div class='control-group'>
                <?php echo $form->labelEx($model,'name', array('class'=>'control-label')); ?>
                <div class='controls'>
                        <?php echo EMHelper::megaOgogo($model, 'name', array('class'=>'span25')); ?>
                        <?php echo $form->error($model,'name'); ?>
                </div>
        </div>

```

textArea

```php

        <div class='control-group'>
                <?php echo $form->labelEx($model,'description', array('class'=>'control-label')); ?>
                <div class='controls'>
                        <?php echo EMHelper::megaOgogo($model, 'description', array('class'=>'span25', 'rows'=>7), 'textArea'); ?>
                        <?php echo $form->error($model,'description'); ?>
                </div>
        </div>

```

---

If you **don't have** Twitter Bootstrap

```php

<?php echo EMHelper::multiInput($model, $attribute, $htmlOptions = array(), $fieldType = 'textField'); ?>

```

Like

```php

<?php echo $form->labelEx($model,'name', array('class'=>'control-label')); ?>
<?php echo EMHelper::multiInput($model, 'name', array('class'=>'span25')); ?>
<?php echo $form->error($model,'name'); ?>

```

---

#### 2) Now put somewhere in main layout this LanguageSelectorWidget


```php

<?php $this->widget('ext.EasyMultiLanguage.widgets.LanguageSelectorWidget', array(
        'style'    => 'dropDown',  // "dropDown" or "inline". Optional. Default is "dropDown"
        'cssClass' => 'bla-bla',  // Optional. Additional css class for selector.
)); ?>

```

## Perfomance


In order to keep your perfomance bright and shiny, it's recommended to use different translation tables for different models if they have a lot of records.
And if you know, that all attributes of your model will be varchar, then change **value** type from _mediumtext_ to _varchar_ in **"translations"** table


# Congratulations ! Now you are awesome =)
