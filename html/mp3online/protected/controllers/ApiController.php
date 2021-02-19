<?php

class ApiController extends Controller{
    public function filters(){}

    public function actions(){
        return array(
            'album'=>'application.controllers.api.ShowAlbumAction',
            'author'=>'application.controllers.api.ShowAuthorAction',
            'category'=>'application.controllers.api.ShowCategoryAction',
            'singer'=>'application.controllers.api.ShowSingerAction',
            'searchAlbum'=>'application.controllers.api.SearchAlbumAction',
            'searchSong'=>'application.controllers.api.SearchSongAction',
            'findSong'=>'application.controllers.api.FindSongAction',
            'songView'=>'application.controllers.api.SongShowAction',
            'songCreate'=>'application.controllers.api.SongCreateAction',
			'songAlbum'=>'application.controllers.api.SongAlbumAction',
            'songCategory'=>'application.controllers.api.SongCategoryAction',
			'nameSong'=>'application.controllers.api.SearchNameSongAction',
			'page'=>'application.controllers.api.PageAction',
            'topSong'=>'application.controllers.api.TopSongAction',
            'downloadSong'=>'application.controllers.api.DownloadSongAction',
            'showDownloadSong'=>'application.controllers.api.ShowSongByDownloadAction',
            'listenSong'=>'application.controllers.api.ListenSongAction',
            'showListenSong'=>'application.controllers.api.ShowSongByListenAction',
            'getAlbumByCategory'=>'application.controllers.api.GetAlbumByCategoryAction',
            'getSubs'=>'application.controllers.api.GetSubsAction',
            'pushTest'=>'application.controllers.api.PushAction',
            'deviceRegister'=>'application.controllers.api.DeviceRegisterAction',
			'banner'=>'application.controllers.api.BannerAction',
			'radio'=>'application.controllers.api.RadioAction',
            'pushNotification'=>'application.controllers.api.PushNotificationAction',
        );
    }

    public static function checkAuth() {}

    public static function getStatusCodeMessage($status) {
        $codes = array(
            200 => 'OK',
            500 => 'ERROR: Bad request. API doesn\'t exist OR request failed due to some reason.',
        );
        return (isset($codes[$status])) ? $codes[$status] : null;
    }

    public static function sendResponse($status = 200, $body = '', $content_type = 'application/json') {
        header('HTTP/1.1 ' . $status . ' ' . self::getStatusCodeMessage($status));
        header('Content-type: ' . $content_type);
        if(trim($body) != '') echo $body;
        Yii::app()->end();
    }
}