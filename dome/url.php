<?php
use LSYS\FileImageGet;
include_once __DIR__."/../vendor/autoload.php";
LSYS\Config\File::dirs(array(
    __DIR__."/config",
));
LSYS\FileImageGet\DI::set(function (){
    $db=new LSYS\FileImageGet\Data\DB;
    return (new LSYS\FileImageGet\DI)->fileimageget(new LSYS\DI\ShareCallback(function ($config) {
        return $config;
    },function ($config)use($db){
        $configs=array(
            "test"=>"fileget.local_disk"
        );
        if (!isset($configs[$config])){
            throw new Exception("bad config");
        }
        return new FileImageGet($configs[$config],\LSYS\Config\DI::get()->config("fileimageget.default"), $db);
    }));
});
$fileimageget=LSYS\FileImageGet\DI::get()->fileimageget("test");
$string="file/2018-09-03/5b8ce22f10c3c.png";//文件标识,存放到你的数据库
var_dump($img->resizeUrl($string, "pic_10"));
var_dump($img->url($string));
var_dump($img->urls($string));

    