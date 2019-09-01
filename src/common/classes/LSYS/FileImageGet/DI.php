<?php
namespace LSYS\FileImageGet;
/**
 * @method \LSYS\FileImageGet fileImageGet($config)
 */
class DI extends \LSYS\DI{
    /**
     * @return static
     */
    public static function get(){
        $di=parent::get();
        !isset($di->fileImageGet)&&$di->fileImageGet(new \LSYS\DI\VirtualCallback(\LSYS\FileImageGet::class));
        return $di;
    }
}