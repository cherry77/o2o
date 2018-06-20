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
//所属城市
$('.cityId').change(function(){
    city_id = $(this).val();
    post_data = {'id':city_id};
    url = SCOPE.city_url;
    $.post(url,post_data,function(ret){
        if(ret.status == 1){
            //将信息填充到html
            city_html = "";
            $(ret.data.data).each(function(i){
                city_html += "<option value="+this.id+">"+this.name+"</option>";
            });
            $('.se_city_id').html(city_html);
        }else if(!ret.data.data){
            $('.se_category_id').html('');
        }
    },'json');
});
//所属分类
$('.categoryId').change(function(){
    category_id = $(this).val();
    post_data = {'id':category_id};
    url = SCOPE.category_url;
    $.post(url,post_data,function(ret){
        if(ret.status == 1){
            //将信息填充到html
            category_html = "";
            $(ret.data.data).each(function(i){
                category_html += "<input type='checkbox' name='category-box' id="+this.id+"/>"+this.name;
            });
            $('.se_category_id').html(category_html);
        }else if(!ret.data.data){
            $('.se_category_id').html('');
        }
    },'json');
});



