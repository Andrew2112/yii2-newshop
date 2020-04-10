<?php

namespace app\assets;

use yii\web\AssetBundle;

class AuthAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css',
        '/adminlte/bower_components/font-awesome/css/font-awesome.min.css',
        '/adminlte/bower_components/Ionicons/css/ionicons.min.css',
        '/adminlte/dist/css/AdminLTE.min.css',
        '/adminlte/plugins/iCheck/square/blue.css',
        '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic'
    ];
    public $js = [
        '//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js',
        '//oss.maxcdn.com/respond/1.4.2/respond.min.js',
        'adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js',
        'adminlte/plugins/iCheck/icheck.min.js',
        'js/auth.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}