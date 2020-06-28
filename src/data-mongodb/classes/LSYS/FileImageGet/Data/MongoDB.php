<?php
/**
 * lsys storage
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\FileImageGet\Data;
use LSYS\FileImageGet\Data;
class MongoDB implements Data{
    /**
     * @var \LSYS\MongoDB
     */
    private $_db;
    public function __construct(\LSYS\MongoDB $monggodb=null){
        $monggodb=$monggodb?$monggodb:\LSYS\MongoDB\DI::get()->mongodb();
        $this->_db = $monggodb->getDatabase();
    }
    public function resizeGet(string $file_get_config,string $file,string $resize):?string{
        $space=str_replace(".", '_',$file_get_config);
        $conn=$this->_db->selectCollection($space);
        $result = $conn->find([
            'file' => $file,
            'resize' => $resize,
        ]);
        $data=current($result->toArray());
        if (!$data)return NULL;
        RETURN $data->resize_item;
    }
}