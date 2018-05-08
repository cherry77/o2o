<?php
namespace app\admin\controller;

use think\Controller;
use think\Validate;

class Category extends Controller{
    protected $mdl;
    public function _initialize(){
        $this->mdl = model("Category");
    }

    public function index(){
        $category_list = $this->mdl->get_list();
        return $this->fetch('',[
            'category_list' => $category_list,
        ]);
    }
    public function add(){
        $categories = $this->mdl->get_first_category_list();
        return $this->fetch('',[
            'categories'=>$categories
        ]);
    }
    public function save(){
//        print_r($_POST);
//        print_r(input('post.'));TP5自帶的
//        print_r(request()->post());
        $data = input('post.');
        $validate = Validate('Category');
        if(!$validate->check($data)){
            $this->error($validate->getError());
        }
        //把$data提交model层
        $result = $this->mdl->add($data);
        if($result){
            $this->success('新增成功');
        }else{
            $this->error('新增失败');
        }
    }

}