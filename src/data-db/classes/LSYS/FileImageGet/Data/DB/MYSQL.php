<?php
/**
 * lsys storage
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\FileImageGet\Data\DB;
class MYSQL extends \LSYS\FileImageGet\Data\DB{
    private $_check_cache=array();
    protected function _tableName($file_get_config){
        if (!array_key_exists($file_get_config, $this->_check_cache)){
            $table=parent::_tableName($file_get_config);
            $table=$this->_db->quote($table);
            $row=$this->_db->query("SHOW TABLES LIKE {$table};");
            if (!$row->count()){
                $this->_check_cache[$file_get_config]=null;
            }else{
                $this->_check_cache[$file_get_config]=$table;
            }
        }
        return $this->_check_cache[$file_get_config];
    }
}