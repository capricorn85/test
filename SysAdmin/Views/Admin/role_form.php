<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>角色信息</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">


    <style>
        .layui-form-select dl{
            z-index: 1000;
        }  .layuimini-container{
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
                <label class="layui-form-label">所属角色组</label>
                <div class="layui-input-block">
                    <select name="pid" class="form-control">
                        <option value="0">---------------</option>
                        <?php foreach($pList as $row): ?>
                            <?php echo($row['id'])?>
                            <option value="<?=$row['id']?>"  <?=isset($list['pid'])?(($row['id']==$list['pid'])?'selected':''):''?>><?=$row['rolename']?></option>

                        <?php endforeach; ?>
                    </select>
                    <div class="layui-form-mid layui-word-aux">仅可选择角色组！</div>

                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">角色名称</label>
                <div class="layui-input-block">
                    <input type="text" name="rolename" lay-verify="required" class="layui-input" value="<?=isset($list['rolename'])?$list['rolename']:''?>" placeholder="请输入角色名称">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="cat_type"  class="layui-form-label">角色类别</label>
                <div class="layui-input-block">
                    <select name="rstyle"  lay-filter="rstyle" >
                        <?php if (isset($ifChild)):?>
                            <option value="2">角色组</option>
                        <?php else:?>
                        <?php foreach (hp_role_type() as $value): ?>
                            <option value="<?=$value["id"]?>" <?php if(isset($list)&&$list["rstyle"]==$value["id"]): ?>selected<?php endif; ?>><?=$value["text"]?></option>
                        <?php endforeach ?>
                        <?php endif;?>
                    </select>
                    <!--						<span class="help-block m-b-none"><i class="fa fa-info-circle"></i>注意！</span>-->
                </div>
            </div>
            <div class="layui-form-item">
                <label  for="sort_order" class="layui-form-label">角色描述</label>
                <div class="layui-input-block">
                    <textarea name="descri" lay-verify="required" placeholder="请输入内容" class="layui-textarea"><?=isset($list['descri'])?$list['descri']:''?></textarea>

                </div>
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
    layui.use(['layer', 'jquery', 'form'], function () {
        var layer = layui.layer,
            $ = layui.jquery,
            form = layui.form;


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
                    $.post("<?=site_url('xccmssys/Role/RoleEForm')?>",data.field,function(res){
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
