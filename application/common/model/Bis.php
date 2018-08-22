<?php
namespace app\common\model;
use think\Model;

class Bis extends BaseModel{
    public function getBisByStatus($status = 0){
        $order = [
            'id' => 'desc'
        ];
        $where = [
            'status' => $status
        ];
        $result = $this->where($where)->order($order)->paginate();
        return $result;
    }

    public function getInfoById($id){
    }
}