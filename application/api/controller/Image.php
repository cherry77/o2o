<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use think\File;
class Image extends Controller{
    public function upload(){
        $file = Request::instance()->file('file');
        $info = $file->move('upload');
        print_r($info);
    }
}