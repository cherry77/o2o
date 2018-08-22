<?php
/**
 * Created by PhpStorm.
 * User: 15071
 * Date: 2018/8/19
 * Time: 21:42
 */
namespace app\admin\controller;
use think\Controller;
class Bis extends Controller{
    protected $mdl;
    public function _initialize(){
        $this->mdl = model('Bis');
    }

    /**
     * 入驻申请列表
     * @return mixed
     */
    public function apply(){
        $bisList = $this->mdl->getBisByStatus();
        return $this->fetch('',[
            'bisList' => $bisList
        ]);
    }
    public function detail(){
        $id = input('get.id');
        if(!$id){
            $this->error('id参数错误');
        }
        $city_list = model('City')->get_city();
        $category_list = model('Category')->get_list();
        //获取商户数据
        $bisData = model('Bis')->get($id);
        //获取总店数据
        $locationData = model('BisLocation') -> get(['bis_id' => $id,'is_main' => 1]);
        $category_info = [];
        if($locationData['category_id']){
            $category_info = model('Category')->get_list($locationData['category_id']);
        }
        $category = [];
        if(preg_match('/,/',$locationData['category_path'])){
            $category_path = explode(',',$locationData['category_path']);
            $category_path = $category_path[1];
            if(preg_match('/|/',$category_path)) {
                $category_path = explode('|', $category_path);
                $category_path = implode(',',$category_path);
                $where['id'] = ['in',$category_path];
                $category = model('Category')->where($where)->select();
            }
        }
        //获取账户信息
        $accountData = model('BisAccount') -> get(['bis_id' => $id,'is_main' => 1]);
        $cur_time = time();
        $result = [
            'city_list' => $city_list,
            'category_list' => $category_list,
            'cur_time' => $cur_time,
            'md5_data' => md5('unique_salt'.$cur_time),
            'bisData' => $bisData,
            'locationData' => $locationData,
            'category' => $category,
            'accountData' => $accountData,
            'category_info' => $category_info
        ];
        return $this->fetch('',$result);
    }

    function change_status(){
        $data = input('get.');
        $result = $this->mdl->save(['status'=>$data['status']],['id'=> $data['id']]);
        if($result){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }

    function index(){
        $status = 1;
        $result = $this->mdl->getBisByStatus($status);
        return $this->fetch('',[
            'bisData' => $result
        ]);
    }
    function dellist(){
        $status = -1;
        $result = $this->mdl->getBisByStatus($status);
        return $this->fetch('',[
            'bisData' => $result
        ]);
        return $this->fetch();
    }
}