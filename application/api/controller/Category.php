<?php
namespace app\api\controller;
use think\Controller;

class Category extends Controller{
    protected $mdl;
    public function _initialize()
    {
        $this->mdl = model('Category');
    }

    public function get_category_by_parent_id(){
        $parent_id = input('post');
        if(!intval($parent_id)){
            $this->error('参数获取异常');
        }
        $result = $this->mdl->get_list($parent_id);
        if(!$result){
            $this->error('分类不存在');
        }
        return return_value(1,'获取成功',$result);

    }
}