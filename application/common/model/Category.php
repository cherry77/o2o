<?php
namespace app\common\model;
use think\Model;

class Category extends Model{

    protected $autoWriteTimestamp = true;

    /**
     * 分类栏目获取一级分类和二级分类
     * $parent_id为0时，是一级分类
     */
    public function get_list($parent_id = 0){
        $where = [
          'parent_id' => $parent_id,
          'status' => ['neq',-1]
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];

        $result = $this->where($where)->order($order)->paginate();
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
     * 点击添加分类下的分类栏目获取一级分类
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