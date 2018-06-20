<?php
/**
 * Created by PhpStorm.
 * User: 15071
 * Date: 2018/6/11
 * Time: 8:16
 */
namespace app\common\model;
use think\Model;
class City extends Model{

    public function get_city($parent_id = 0){
        $where = [
            'parent_id' => $parent_id,
            'status' => 1
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];

        $result = $this->where($where)->order($order)->paginate();
        return $result;
    }
}