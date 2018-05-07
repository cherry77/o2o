<?php
namespace app\admin\controller;

use think\Controller;

class Category extends Controller{

    public function index(){
        return $this->fetch();
    }
    public function add(){
        return $this->fetch();
    }
    public function save(){
//        print_r($_POST);
//        print_r(input('post.'));TP5自帶的
//        print_r(request()->post());
        $data = input('post.');
    }

}