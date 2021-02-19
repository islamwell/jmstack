<?php

class ShowSongByDownloadAction extends CAction
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
        $criteria->order = 'download DESC';
        $criteria->limit = $rows_per_page;
        $criteria->offset = $start_index;
       // $criteria->condition = 'album_id =' . $id;
        $criteria->compare('status',1);
        $songs = Song::model()->findAll($criteria);
        $path = Yii::app()->getBaseUrl(true);
        if (count($songs) > 0) {
            foreach ($songs as $song) {
                $song = $path . '/upload/' . $song->link;
                $data1[] = array(
                    'songs' => $song
                );
            }
            $album = Album::model()->find('album_id =' . $id);
            $data = array(
                'album_id' => $id,
                'album_name' => $album->album_name,
                //'galleries' => $data1
            );
        } else {
            $album = Album::model()->find('album_id =' . $id);
            $data = array(
                'album_id' => $id,
                'album_name' => $album->album_name,
               // 'galleries' => ''
            );
        }


        ApiController::sendResponse(200, CJSON::encode(array(
            'status' => 'SUCCESS',
            'allpage' => $allpage,
            'data' => $data,
            'message' => 'OK',)));

    }
}
