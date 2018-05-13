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
        $parent_id = input('get.parent_id',0,'intval');
        $category_list = $this->mdl->get_list($parent_id);
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

//        判断数据是不是通过post传递的
        if(!request()->isPost()){
            $this->error('请求失败');
        }
        $data = input('post.');
        $validate = Validate('Category');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
//        如果传过来的数据有id,说明进行的是修改操作
        if(!empty($data['id'])){
            return $this->update($data);
        }
        //把$data提交model层
        $result = $this->mdl->add($data);
        if($result){
            $this->success('新增成功');
        }else{
            $this->error('新增失败');
        }
    }

    public function edit($id = 0){
        //1.获取数据展示在编辑页中
        $result = $this->mdl->get($id);//通过tp5Model层自带的get方法获取
        $categories = $this->mdl->get_first_category_list();
        return $this->fetch('',[
            'categories'=>$categories,
            'category_info'=>$result
        ]);
    }

    public function update($data){
        //对数据进行更新
        $result = $this->mdl->save($data,['id' => intval($data['id'])]);
        if($result){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }
    /**
     * 排序
     */
        public function listorder($id,$listorder){
          $result = $this->mdl->save(['listorder'=>$listorder],['id'=>$id]);
          if($result){
              $this->result($_SERVER['HTTP_REFERER'],1,'success');
          }else{
              $this->result($_SERVER['HTTP_REFERER'],0,'更新失败');
          }
    }

}