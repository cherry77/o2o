<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function status($status){
    if($status == 1){
        $str = "<span class='label label-success radius'>正常</span>";
    }elseif ($status == 0){
        $str = "<span class='label label-danger radius'>待审</span>";
    }else{
        $str = "<span class='label label-success radius'>删除</span>";
    }
    return $str;
}

function doCurl($url,$type,$data =[]){
    $ch = curl_init();//初始化
    //设置选项
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_HEADER,0);

    if($type == 1){
        //post
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    }
    //执行并获取内容
    $output = curl_exec($ch);
    //释放句柄
    curl_close($ch);
    return $output;
}
/*tp5中调用一些类的静态方法前面加\
这个作用是摆脱当前命名空间的影响  从根目录去寻找你要用的类  不加的话会从当前的命名空间开始寻找  可能找不到你要用的类*/

