<?php
/**
 * lsys storage
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\FileImageGet\Data;
use LSYS\FileImageGet\Data;
use LSYS\Cache;
class DB implements Data{
    /**
     * @var \LSYS\Database
     */
    private $_db;
    private $_cache;
    private $_cache_prefix="image_get";
    private $_cache_time;
    public function __construct(\LSYS\Database $database=null,Cache $cache=null,int $cache_time=3600){
        $this->_db=$database?$database:\LSYS\Database\DI::get()->db();
        $this->_cache=$cache;
        $this->_cache_time=$cache_time;
    }
    public function resizeGet(string $file_get_config,string $file,string $resize):?string{
        $cache=$this->_cache_prefix.$file_get_config.$file.$resize;
        if($this->_cache&&$this->_cache->exist($cache)){
            return $this->_cache->get($cache);
        }
        $table=$this->_tableName($file_get_config);
        if(empty($table))return null;
        $file=$this->_db->getConnect()->quote($file);
        $resize=$this->_db->getConnect()->quote($resize);
        $sql="SELECT `resize_file` FROM `{$table}` WHERE `file`={$file} AND `resize`={$resize}";
        $res=$this->_db->getSlaveConnect()->query($sql);
        $file=$res->get("resize_file");
        if($this->_cache)$this->_cache->set($cache,$file,$this->_cache_time);
        return $file;
    }
    protected function _tableName(string $file_get_config){
        $tp=$this->_db->tablePrefix();
        $file_get_config=str_replace(".", "_", $file_get_config);
        return "{$tp}imgresize_{$file_get_config}";
    }
}