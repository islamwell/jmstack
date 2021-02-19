<?php

class ShowSongByListenAction extends CAction
{
    public function run()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';

        $songs = Song::model()->findAll('status = 1');
        $rows_per_page = 5;
        $numSong = count($songs);
        $allpage = ceil($numSong / $rows_per_page);
        $start_index = ($page - 1) * $rows_per_page;
        $criteria = new CDbCriteria();
        $criteria->order = 'listen DESC';
        $criteria->limit = $rows_per_page;
        $criteria->offset = $start_index;
        $criteria->compare('status',1);
        $songs = Song::model()->findAll($criteria);
        $path = Yii::app()->getBaseUrl(true);
        if (count($songs) > 0) {
            foreach ($songs as $song) {
                $song = $path . '/images/images/' . $song->link;
                $data1[] = array(
                    'images' => $song
                );
            }
            $album = Album::model()->find('album_id =' . $id);
            $data = array(
                'id' => $id,
                'name' => $album->album_name,
                //'galleries' => $data1
            );
        } else {
            $album = Album::model()->find('album_id =' . $id);
            $data = array(
                'id' => $id,
                'name' => $album->album_name,
                //'galleries' => ''
            );
        }


        ApiController::sendResponse(200, CJSON::encode(array(
            'status' => 'SUCCESS',
            'allpage' => $allpage,
            'data' => $data,
            'message' => 'OK',)));

    }
}
