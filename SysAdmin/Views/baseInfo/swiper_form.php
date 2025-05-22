<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>幻灯片信息</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/css/public.css')?>">
    <style>
        .layui-form-select dl{
            z-index: 1000;
        }
        .layui-upload img{
            max-height: 100px;
        }
    </style>
</head>

<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <div class="layui-row clearfix">
        <form class="layui-form" id="articleForm" method="post" >

            <div class="layui-form-item">
                <label class="layui-form-label">幻灯片标题</label>
                <div class="layui-input-inline">
                    <input type="text" name="title" lay-verify="required" class="layui-input" value="<?=isset($list['title'])?$list['title']:''?>" placeholder="请输入文章标题">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">幻灯片</label>
                <div class="layui-input-inline">
                    <div class="layui-upload">
                        <button type="button" class="layui-btn" id="test1">选择图片</button>
                        <div class="layui-upload-list">
                            <img class="layui-upload-img"  id="demo1" <?=empty($list['href'])?'':'src="'.base_url($list['href']).'"'?>>
                            <p id="demoText"></p>
                        </div>
                        <input type="hidden" class="imgUrl" name="href" id='imgUrl'   value="<?=isset($list['href'])?$list['href']:''?>" />
                    </div>
                </div>：
                <div class="layui-form-mid layui-word-aux">首页幻灯片图片建议尺寸：1080px*433px，其他幻灯片建议尺寸：1080px*200px，jpg、png格式！</div>
            </div>

            <div class="layui-form-item">
                <label  for="sort_order" class="layui-form-label">排序</label>
                <div class="layui-input-inline">
                    <input type="text" name="sort_order"  min="0" max="999"  value="<?=isset($list['sort_order'])?$list['sort_order']:'0'?>" lay-verify="required" class="layui-input"/>

                </div>

                <div class="layui-form-mid layui-word-aux">排序数字范围0-999，数字越大排序越前！</div>
            </div>

            <div class="layui-form-item">
                <label for="cat_type"  class="layui-form-label">图片类型</label>
                <div class="layui-input-inline">
                    <select name="itype"  lay-filter="itype" >
                        <?php foreach (hp_i_type() as $value): ?>
                            <option value="<?=$value["id"]?>" <?php if(isset($list)&&$list["itype"]==$value["id"]): ?>selected<?php endif; ?>><?=$value["text"]?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="layui-form-mid layui-word-aux">注意！如为logo只按排序及日期显示最新的一张</div>

            </div>


            <div class="layui-form-item">
                <label for="cat_type"  class="layui-form-label">是否显示</label>
                <div class="layui-input-inline">
                    <select name="is_show"  lay-filter="is_show" >
                        <?php foreach (hp_show() as $value): ?>
                            <option value="<?=$value["id"]?>" <?php if(isset($list)&&$list["is_show"]==$value["id"]): ?>selected<?php endif; ?>><?=$value["text"]?></option>
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
</div>

<script src="<?=base_url('statics/plugins/layuimini/lib/layui/layui.js')?>"></script>




<script>
    layui.use(['layer', 'jquery', 'form','upload'], function () {
        var layer = layui.layer,
            $ = layui.jquery,
            form = layui.form
            ,upload = layui.upload
            , laydate = layui.laydate;

        //日期
        laydate.render({
            elem: '#date1'
            ,type: 'datetime'
            ,value: "<?=isset($list['atime'])?$list['atime']:date("Y-m-d H:i:s")?>"
        });
        cat_type=<?=isset($list["cat_type"])?$list["cat_type"]:0?>;

        var uploadInst = upload.render({
            elem: '#test1'
            ,acceptMime: 'image/*'
            ,url: '<?=site_url('xccmssys/upLoad/upLoadSwiperImg')?>' //改成您自己的上传接口
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                if(res.code = 200){
                    $("#imgUrl").val(res.imgurl);
                    $('#demo1').attr('src', '<?=base_url()?>/'+res.imgurl); //图片链接（base64）
                    return layer.msg(res.msg);
                }
                else{
                    return layer.msg(res.msg);
                }
                //上传成功
            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            },
        });


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
                    $.post("<?=site_url('xccmssys/Swipers/eform')?>",data.field,function(res){
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
