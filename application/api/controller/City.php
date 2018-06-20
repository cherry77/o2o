<?php
namespace app\api\controller;
use think\Controller;

class City extends Controller{
    protected $mdl;
    public function _initialize()
    {
        $this->mdl = model('City');
    }

    public function get_city_by_parent_id(){
        $parent_id = input('post.id');
        if(!$parent_id){
            $this->error('参数获取异常');
        }
        $result = $this->mdl->get_city($parent_id);
        if(!$result){
            $this->error('城市不存在');
        }
        return return_value(1,'获取成功',$result);

    }
}