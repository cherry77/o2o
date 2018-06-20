<?php
namespace app\bis\controller;
use think\Controller;
class Register extends Controller
            {

    public function index(){
            $city_list = model('City')->get_city();
            $category_list = model('Category')->get_list();
            return $this->fetch('',[
                'city_list' => $city_list,
                'category_list' => $category_list
        ]);
    }
}