<?php
namespace app\common\model;
use think\Model;

class Category extends Model{

    protected $autoWriteTimestamp = true;

    public function get_list(){
        $where = [
          'parent_id' => 0,
          'status' => ['neq',-1]
        ];
        $order = [
            'id' => 'desc'
        ];

        $result = $this->where($where)->order($order)->select();
        return $result;
    }

    /**
     * 新增生活服务分类
     * @param $data
     * @return false|int
     */
    public function add($data){

        $data['status'] = 1;
//        $data['create_time'] = time();
        return $this->save($data);
    }

    /**
     * 分类栏目获取一级分类
     */
    public function get_first_category_list(){
        $where = [
            'status' => 1,
            'parent_id' => 0
        ];
        $order = [
          'id' => 'desc'
        ];

        return $this->where($where)->order($order)->select();
    }

}