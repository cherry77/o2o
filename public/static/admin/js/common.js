/*页面 全屏-添加*/
function o2o_edit(title,url){
    var index = layer.open({
        type: 2,
        title: title,
        content: url
    });
    layer.full(index);
}

/*添加或者编辑缩小的屏幕*/
function o2o_s_edit(title,url,w,h){
    layer_show(title,url,w,h);
}
/*-删除*/
function o2o_del(id,url){

    layer.confirm('确认要删除吗？',function(index){
        window.location.href=url;
    });
}

$('.listorder input').blur(function(){
    // 失去焦点后的事件
    //1.获取要改变序号的数据id(主键id)
    var id = $(this).attr('attr-id');
    //2.获取填写的排序序号
    var listorder = $(this).val();

    var post_data = {
        'id' : id,
        'listorder' : listorder
    };
    var url = $scope.listorder_url;
    $.post(url,post_data,function(result){
        if(result.code == 1){
            //如果成功，就刷新页面
            location.href = result.data;
        }else{
            alert(result.msg);
        }
    },"json");
});



