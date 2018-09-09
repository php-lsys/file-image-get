<?php
namespace LSYS\FileImageGet;
/**
 * @method \LSYS\FileImageGet fileimageget($config)
 */
class DI extends \LSYS\DI{
    /**
     * @return static
     */
    public static function get(){
        $di=parent::get();
        !isset($di->fileimageget)&&$di->fileimageget(new \LSYS\DI\VirtualCallback(\LSYS\FileImageGet::class));
        return $di;
    }
}