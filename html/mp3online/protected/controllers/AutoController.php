<?php

class AutoController extends Controller
{
    public function actionComplete() {
        $criteria = new CDbCriteria;
        $criteria->select = array('singer_id', 'singer_name');
        $criteria->addSearchCondition('singer_name',  strtoupper( $_GET['term']) ) ;
        $criteria->limit = 15;
        $data = Singer::model()->findAll($criteria);

        $arr = array();

        foreach ($data as $item) {

            $arr[] = array(
                'singer_id' => $item->singer_id,
                'value' => $item->singer_name,
                'label' => $item->singer_name,
            );
        }

        echo CJSON::encode($arr);

    }
    public function actionComplete1() {
        $criteria = new CDbCriteria;
        $criteria->select = array('author_id', 'author_name');
        $criteria->addSearchCondition('author_name',  strtoupper( $_GET['term']) ) ;
        $criteria->limit = 15;
        $data = Author::model()->findAll($criteria);

        $arr = array();

        foreach ($data as $item) {

            $arr[] = array(
                'author_id' => $item->author_id,
                'value' => $item->author_name,
                'label' => $item->author_name,
            );
        }

        echo CJSON::encode($arr);

    }

}