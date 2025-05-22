<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>权限信息</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">

    <style>
        .layui-form-select dl{
            z-index: 1000;
        }
        .layuimini-container{
            padding:20px;
        }
    </style>
</head>

<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <div class="layui-row clearfix">
            <form class="layui-form" id="articleForm" method="post" >
                <div class="layui-form-item">
                    <label class="layui-form-label">权限名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="auth_name" lay-verify="required" class="layui-input" value="<?=isset($list['auth_name'])?$list['auth_name']:''?>" placeholder="请输入权限名称">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label  for="sort_order" class="layui-form-label">权限描述</label>
                    <div class="layui-input-block">
                        <textarea name="descri" lay-verify="required" placeholder="请输入内容" class="layui-textarea"><?=isset($list['descri'])?$list['descri']:''?></textarea>

                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">权限范围</label>
                    <div class="layui-input-block">

                        <div id="tree"></div>

                        <!--                    <input type="text" name="author" lay-verify="required" class="layui-input" value="--><?//=isset($list['scopes'])?$list['scopes']:''?><!--" placeholder="请输入权限名称">-->
                    </div>
                    <!--                <div class="layui-form-mid layui-word-aux">请选择权限菜单！--><?//=isset($list['scopes'])?$list['scopes']:''?><!--</div>-->

                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <!--                    <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>-->
                        <button class="layui-btn" lay-submit lay-filter="formDemo" id="btnSave">立即提交</button>
                        <!--                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>-->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?=base_url('statics/plugins/layuimini/lib/layui/layui.js')?>"></script>



<script>
    layui.use(['layer', 'jquery', 'form','tree'], function () {
        var layer = layui.layer,
            $ = layui.jquery,
            form = layui.form,
            tree = layui.tree;


        data2=<?=json_encode($nav_list)?>;

        //基本演示
        tree.render({
            elem: '#tree'
            ,data: data2
            ,showCheckbox: true  //是否显示复选框
            ,id: 'demoId'
            ,spread:true
            ,click: function(obj){
                // var data = obj.data;  //获取当前点击的节点数据
                // layer.msg('状态：'+ obj.state + '<br>节点数据：' + JSON.stringify(data));
            }
        });
        //scopes=<?//=json_encode($list['scopes'])?>//;
        //scopes = scopes.split(",");
        // tree.setChecked('demoId', scopes); //批量勾选 id 为 2、3 的节点
        // form.verify({
        //
        // });



        //监听提交
        form.on('submit(formDemo)', function(data){
            var isDisabled = $("#btnSave").hasClass('layui-btn-disabled');
            if (isDisabled) {
                return false;
            }
            else{$("#btnSave").addClass('layui-btn-disabled');}
            var lock=false;

            var checkData = tree.getChecked('demoId');
            var ids = getCheckedId(checkData);



            layer.confirm('确定提交信息？',{btn:["确定","取消"],icon: 3, title:'提示'}, function(index){
                if(!lock) {
                    lock = true;//锁定
                    data.field.id=<?=isset($_GET['id'])?$_GET['id']:'0'?>;
                    data.field.scopes=ids;
                    $.post("<?=site_url('xccmssys/Authority/AuthEForm')?>",data.field,function(res){
                        // console.log(res);
                        if(res.status=="success"){
                            layer.alert(res.txt,
                                function(){
                                    var index = parent.layer.getFrameIndex(window.name);
                                    window.parent.location.reload();//刷新父页面
                                    parent.layer.close(index);//关闭弹出层
                                });

                        }else{
                            layer.msg(res.txt, {time: 2000});
                            $("#btnSave").removeClass('layui-btn-disabled');
                            return false;
                        }
                    },'json');
                }
                return false;
            },function(){
                layer.msg('已取消提交');
                $("#btnSave").removeClass('layui-btn-disabled');
                return false;
            });
            return false;
        });

        window.getCheckedId=function(jsonObj) {
            var id = "";
            $.each(jsonObj, function (index, item) {
                // console.log(item);
                if (!item.children){
                    if (id != "") {
                        id = id + "," + item.id;
                    }
                    else {
                        id = item.id;
                    }
                }
                var i = getCheckedId(item.children);
                if (i != "") {
                    if (id !=""){
                        id = id + "," + i;
                    }else{
                        id=i;
                    }
                }

            });
            return id;
        }
    });



</script>
</body>
</html>
