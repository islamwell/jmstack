<?php

/**
 * This is the model class for table "document".
 *
 * The followings are the available columns in table 'document':
 * @property integer $idbinarios
 * @property string $filename
 * @property string $content
 *
 * The followings are the available model relations:
 * @property Ritmo[] $ritmos
 * @property Ritmo[] $ritmos1
 */
class Document extends CActiveRecord
{
        /**
         * Returns the static model of the specified AR class.
         * @param string $className active record class name.
         * @return Document the static model class
         */
        public static function model($className=__CLASS__)
        {
                return parent::model($className);
        }

        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
                return 'document';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
                // NOTE: you should only define rules for those attributes that
                // will receive user inputs.
                return array(
                        array('idbinarios, filename, content', 'required'),
                        array('idbinarios', 'numerical', 'integerOnly'=>true),
                        array('filename', 'length', 'max'=>345),
                        array('content', 'file'),
                        // The following rule is used by search().
                        // Please remove those attributes that should not be searched.
                        array('idbinarios, filename, content', 'safe', 'on'=>'search'),
                );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
                return array(
                        'idbinarios' => 'Idbinarios',
                        'filename' => 'Filename',
                        'content' => 'Content',
                );
        }

        /**
         * Retrieves a list of models based on the current search/filter conditions.
         * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
         */
        public function search()
        {
                // Warning: Please modify the following code to remove attributes that
                // should not be searched.

                $criteria=new CDbCriteria;

                $criteria->compare('idbinarios',$this->idbinarios);
                $criteria->compare('filename',$this->filename,true);
                $criteria->compare('content',$this->content,true);

                return new CActiveDataProvider($this, array(
                        'criteria'=>$criteria,
                ));
        }
}
