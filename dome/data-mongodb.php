<?php
use LSYS\FileGet\GridFS;
use LSYS\DI\SingletonCallback;
use LSYS\FileImageGet;
use LSYS\FileImageGet\Data\MongoDB;
include_once __DIR__."/../vendor/autoload.php";
LSYS\Config\File::dirs(array(
    __DIR__."/config",
));
LSYS\FileGet\DI::set(function (){
    return (new LSYS\FileGet\DI)->fileget(new SingletonCallback(function () {
        return new GridFS(\LSYS\Config\DI::get()->config("fileget.gridfs"));
    }));
});
$img=new FileImageGet(\LSYS\Config\DI::get()->config("fileimageget.default"), new MongoDB());

//var_dump($img->resizeUrl("default/5b8ca1068198ed33a4000d90", "pic_10"));
var_dump($img->resizeUrl("test/5b8caf2e8198ed33a4000da7", "pic_10"));

    