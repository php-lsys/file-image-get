<?php
namespace LSYS\FileImageGet;
interface Data{
    public function resizeGet(string $file_get_config,string $file,string $resize):?string; 
}