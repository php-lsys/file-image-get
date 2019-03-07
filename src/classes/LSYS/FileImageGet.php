<?php
namespace LSYS;
use LSYS\FileImageGet\Data;
class FileImageGet{
    protected $_file_get_config;
    protected $_config;
    protected $_storage;
    public function __construct(Config $config,Data $storage){
        $this->_file_get_config=$config->get("fileget");
        $this->_config=$config;
        $this->_storage=$storage;
    }
    public function url($file){
        $file=\LSYS\FileGet\DI::get()->fileget($this->_file_get_config)->url($file);
        if ($file===false)return false;
        if ($file===null)return $this->_config->get("not_found_url");
        return $file;
    }
    public function resizeUrl($file,$resize){
        $rfile=$this->_storage->resizeGet($this->_file_get_config,$file,$resize);
        if ($rfile) return $this->url($rfile);
        return $this->_config->get("resize_url").$resize.".".$file;
    }
    public function urls($file,$default='source'){
        $out=array($default=>$this->url($file));
        $resize=$this->_config->get("resize",[]);
        if(is_array($resize))foreach ($resize as $v){
            $out[$v]=$this->resizeUrl($file, $v);
        }
        return $out;
    }
}