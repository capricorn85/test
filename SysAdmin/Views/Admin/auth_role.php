<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>角色权限调整</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">

    <style>
        .layui-form-select dl{
            z-index: 1000;
        }
        .checkdisabled{
            cursor:not-allowed
        }
    </style>
</head>

<body class=" layui-bg-gray">
<div class="layui-container ">
    <div class="layuimini-main">
        <form class="layui-form" id="articleForm" method="post" >

            <div class="layui-form-item layui-col-space15">
                <div class="layui-row layui-col-space15">

                    <?php foreach ($authList  as $item):?>
                        <?php $mold=isset($item['mold'])?$item['mold']:0?>
                        <div class="layui-col-xs12 layui-col-md6">
                            <div class="layui-card top-panel layui-elem-quote">
                                <div class="layui-card-header">
<!--                                    <input type="checkbox" checked lay-skin="switch" lay-filter="encrypt" title="是否加密">-->

<!--                                        <input type="checkbox" checked lay-skin="switch">-->
                                        <input type="checkbox" <?=($mold==0)?'':'checked'?>
                                               lay-text="<?=$item['auth_name']?>开|<?=$item['auth_name']?>关"
                                               lay-skin="switch"
                                               lay-filter="auth_box"
                                               id="check<?=$item['id']?>"
                                           ></div>


                                <div class="layui-card-body">
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">操作权限</label>
                                        <div class="layui-input-block">
                                            <?php if ($mold==0):?>
                                                <input type="checkbox"  class="check<?=$item['id']?> "   lay-filter="checkglance" id="check<?=$item['id']?>glance" name="auth[<?=$item['id']?>][glance]" value="8" title="浏览" disabled>
                                                <input type="checkbox"  class="check<?=$item['id']?>" name="auth[<?=$item['id']?>][add]" value="1" title="新增" disabled>
                                                <input type="checkbox"  class="check<?=$item['id']?>" name="auth[<?=$item['id']?>][del]" value="2" title="删除" disabled>
                                                <input type="checkbox"  class="check<?=$item['id']?>" name="auth[<?=$item['id']?>][ins]" value="4" title="编辑" disabled>
                                            <?php else:?>
                                                <!--                                            1,3,7-->
                                                <input type="checkbox"  class="check<?=$item['id']?>"    lay-filter="checkglance" name="auth[<?=$item['id']?>][glance]" id="check<?=$item['id']?>glance" title="浏览"  value="8" <?=in_array($mold,[8,9,10,11,12,13,14,15])?'checked':''?>>
                                                <!--                                            1,3,7-->
                                                <input type="checkbox"  class="check<?=$item['id']?>" name="auth[<?=$item['id']?>][add]" title="新增"  value="1" <?=in_array($mold,[1,3,5,7,9,11,13,15])?'checked':''?>>
                                                <!--                                            2,3,6,7-->
                                                <input type="checkbox"  class="check<?=$item['id']?>" name="auth[<?=$item['id']?>][del]" title="删除"  value="2"  <?=in_array($mold,[2,3,6,7,10,11,14,15])?'checked':''?>>
                                                <!--                                            4,6,7-->
                                                <input type="checkbox"  class="check<?=$item['id']?>" name="auth[<?=$item['id']?>][ins]" title="编辑"  value="4" <?=in_array($mold,[4,5,6,7,12,13,14,15])?'checked':''?>>
                                            <?php endif;?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>

            <div class="layui-form-item" style="text-align: center">
                <div class="">
                    <!--                    <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>-->
                    <button class="layui-btn " lay-submit lay-filter="formDemo" id="btnSave">立即提交</button>
                    <!--                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>-->
                </div>
            </div>
        </form>
    </div>
</div>

<script src="<?=base_url('statics/plugins/layuimini/lib/layui/layui.js')?>"></script>



<script>
    layui.use(['layer', 'jquery', 'form'], function () {
        var layer = layui.layer,
            $ = layui.jquery,
            form = layui.form;


        form.on('checkbox(checkglance)',function (data) {
            if (data.elem.checked){
                // $("#"+data.elem.id).prop('checked', true);
                // form.render('checkbox');
            }else{
                $("#"+data.elem.id).prop('checked', true);
                form.render('checkbox');
            }
        })
        form.on('switch(auth_box)', function(data){
            if (data.elem.checked){
                $("."+data.elem.id).removeAttr("disabled");
                $("#"+data.elem.id+"glance").prop('checked', true);
                // $("#"+data.elem.id+"glance").attr("readonly",true);
                form.render('checkbox');
            }else{
                $("."+data.elem.id).attr("disabled",true);
                $("."+data.elem.id).prop('checked', false);
                $(this).addClass("checkdisabled");
                $(this).next().children("i[class='layui-icon layui-icon-ok']").css("cursor", 'not-allowed');
                form.render('checkbox');
            }
        });

        //监听提交
        form.on('submit(formDemo)', function(data){
            var isDisabled = $("#btnSave").hasClass('layui-btn-disabled');
            if (isDisabled) {
                return false;
            }
            else{$("#btnSave").addClass('layui-btn-disabled');}
            var lock=false;
            layer.confirm('确定提交信息？',{btn:["确定","取消"],icon: 3, title:'提示'}, function(index){
                if(!lock) {
                    lock = true;//锁定
                    data.field.id=<?=isset($_GET['id'])?$_GET['id']:'0'?>;
                    console.log(data.field);
                    // return false;
                    $.post("<?=site_url('xccmssys/Role/authRoleForm')?>",data.field,function(res){
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
    });



</script>
</body>
</html>
