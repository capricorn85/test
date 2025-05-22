<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>栏目信息</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/font-awesome-4.7.0/css/font-awesome.min.css')?>">
    <style>
        .layui-form-select dl{
            z-index: 1000;
        }
    </style>
</head>

<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <div class="layui-row clearfix">
        <form class="layui-form" id="cateForm" method="post" >
            <div class="layui-form-item">
                <label class="layui-form-label">栏目名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="title" lay-verify="required" class="layui-input" value="<?=isset($list['title'])?$list['title']:''?>" placeholder="请输入栏目名称">
                </div>
            </div>

            <div class="layui-form-item">
                <label  for="sort_order" class="layui-form-label">栏目图标</label>
                <div class="layui-input-inline">
                    <input type="text" name="icon" value="<?=isset($list['icon'])?$list['icon']:''?>"  lay-verify="required" class="layui-input"  placeholder="请输入栏目图标"/>
                </div>
                <div class='layui-form-mid layui-word-aux'><?=isset($list['icon'])?"<i class='".$list['icon']."'></i>":''?></div>

            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">地址</label>
                <div class="layui-input-inline">
                    <input type="text" name="href" class="layui-input" value="<?=isset($list['href'])?$list['href']:''?>" placeholder="请输入栏目地址">
                </div>
                <div class="layui-form-mid layui-word-aux">如是具体页面，请填写对应控制器地址！</div>
            </div>
            <div class="layui-form-item">
                <label  for="sort_order" class="layui-form-label">栏目排序</label>
                <div class="layui-input-inline">
                    <input type="text" name="sort"  min="0" max="999"  value="<?=isset($list['sort'])?$list['sort']:'0'?>" lay-verify="required" class="layui-input"/>

                </div>
                <div class="layui-form-mid layui-word-aux">排序数字范围0-999，数字越大排序越前！</div>
            </div>
            <div class="layui-form-item">
                <label for="cate_id"  class="layui-form-label">所属模块</label>
                <div class="layui-input-inline">
                    <select name="cate_id"   >
                        <?php foreach (hp_cate_nav() as $value): ?>
                            <option value="<?=$value["id"]?>" <?php if(isset($list)&&$list["cate_id"]==$value["id"]): ?>selected<?php endif; ?>><?=$value["text"]?></option>
                        <?php endforeach ?>
                    </select>
                    <!--						<span class="help-block m-b-none"><i class="fa fa-info-circle"></i>注意！</span>-->
                </div>
            </div>

            <div class="layui-form-item">
                <label for="is_show"  class="layui-form-label">上级栏目</label>
                <div class="layui-input-inline">

                    <select name="pid" class="form-control">
                        <?php $clevelf=isset($clevel)?$clevel:0?>
                        <?php if ($clevelf==2):?><!--	已有两个子栏目							-->
                        <option  value="0">-----------</option>
                    <?php else:?><!--	已有两个子栏目							-->
<!--                        --><?//=dd($list)?>
                    <?php $pid=isset($list)?$list['pid']:"0"?>
                        <option <?php if (isset($_GET['id'])&&$_GET['id']==0):?>selected<?php endif;?> value="0">-----------</option>
                    <?php foreach($cat_list as $row): ?>
                        <?php if($row['pid']==0): ?><!--    输出一级栏目                        -->
                            <?php if ($row['id']!=(isset($_GET['id'])?$_GET['id']:0)):?>
                                <option value="<?=$row['id']?>" <?php if($row['id']==$pid):?> selected <?php endif;?>><?=$row['title']?></option>
                                <?php if ($clevelf==0):?>
                                    <?php foreach($cat_list as $row2): ?>
                                        <?php if($row2['pid']==$row['id']): ?><!--    输出二级栏目                        -->
                                            <?php if ($row2['id']!=(isset($_GET['id'])?$_GET['id']:0)):?>
                                                <option value="<?=$row2['id']?>" <?php if($row2['id']==$pid):?> selected <?php endif;?>>|--<?=$row2['title']?></option>
                                            <?php endif;?>
                                        <?php endif;?>
                                    <?php endforeach; ?>
                                <?php endif;?>
                            <?php endif;?>
                        <?php endif;?>
                    <?php endforeach; ?>

                    <?php endif;?>



                    </select>
                </div>
                <div class="layui-form-mid layui-word-aux">支持最多二级栏目！</div>
            </div>
            <div class="layui-form-item">
                <label for="cat_type"  class="layui-form-label">栏目状态</label>
                <div class="layui-input-inline">
                    <select name="status"  lay-filter="status" >
                        <?php foreach (hp_status() as $value): ?>
                            <option value="<?=$value["id"]?>" <?php if(isset($list)&&$list["status"]==$value["id"]): ?>selected<?php endif; ?>><?=$value["text"]?></option>
                        <?php endforeach ?>
                    </select>
                    <!--						<span class="help-block m-b-none"><i class="fa fa-info-circle"></i>注意！</span>-->
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


<script src="<?=base_url('statics/plugins/layuimini/lib/layui/layui.js')?>"></script>


<script>
    layui.use(['layer', 'jquery', 'form'], function () {
        var layer = layui.layer,
            $ = layui.jquery,
            form = layui.form;


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
            layer.confirm('确定提交信息？',{btn:["确定","取消"],icon: 3, title:'提示'}, function(index){
                if(!lock) {
                    lock = true;//锁定
                    data.field.id=<?=isset($_GET['id'])?$_GET['id']:'0'?>;

                    $.post("<?=site_url('xccmssys/sysCategory/eform')?>",data.field,function(res){
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
