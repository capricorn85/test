<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>站点信息</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">
        <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/css/public.css')?>">


    <style>
    </style>
</head>

<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <form>
            <div class="layui-form layuimini-form">
                <div class="layui-form-item">
                    <label class="layui-form-label required">网站名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="site_name" lay-verify="required"  placeholder="请输入网站名称"  value="<?=isset($list['site_name'])?$list['site_name']:''?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label required">联系电话</label>
                    <div class="layui-input-block">
                        <input type="text" name="tel" lay-verify="required"  placeholder="请输入联系电话"  value="<?=isset($list['tel'])?$list['tel']:''?>" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label required">地址信息</label>
                    <div class="layui-input-block">
                        <input type="text" name="address" lay-verify="required"  placeholder="请输入地址信息"  value="<?=isset($list['address'])?$list['address']:''?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label required">网站关键字</label>
                    <div class="layui-input-block">
                        <input type="text" name="keywords" lay-verify="required" placeholder="请输入确认密码"  value="<?=isset($list['keywords'])?$list['keywords']:''?>" class="layui-input">
                        <tip>网站关键字。</tip>

                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label required">网站描述</label>
                    <div class="layui-input-block">
                        <textarea name="description" placeholder="请输入内容" class="layui-textarea"><?=isset($list['description'])?$list['description']:''?></textarea>
                    </div>
                </div>
           <!--      <div class="layui-form-item" id="cat_type">
                    <label for="myEditor"  class="layui-form-label">网站详情</label>
                    <div class="layui-input-block">
                        <script type="text/plain"  id="myEditor" style="width:100%;height:500px;"></script>
                    </div>
                </div> -->


                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formDemo" id="btnSave">立即提交</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



<script src="<?=base_url('statics/plugins/layuimini/lib/layui/layui.js')?>"></script>


<script src="<?=base_url('statics/plugins/layuimini/js/lay-config.js')?>"></script>



<script>
    layui.use(['form','miniTab'], function () {
        var form = layui.form,
            layer = layui.layer,
            miniTab = layui.miniTab,
            $ = layui.jquery;
        // 指定开关事件
        // form.on('switch(switchTest)', function(data){
        //     layer.msg('开关 checked：'+ (this.checked ? 'true' : 'false'), {
        //         offset: '6px'
        //     });
        //     layer.tips('温馨提示：请注意开关状态的文字可以随意定义，而不仅仅是 ON|OFF', data.othis)
        // });
        //监听提交
        form.on('submit(formDemo)', function(data){
            var isDisabled = $("#btnSave").hasClass('layui-btn-disabled');
            if (isDisabled) {
                return false;
            }
            else{$("#btnSave").addClass('layui-btn-disabled');}
            var lock=false;
            if(data.field.wswitch == "on") {
                data.field.wswitch = "1";
            } else {
                data.field.wswitch = "0";
            }
            layer.confirm('确定更改信息？',{btn:["确定","取消"],icon: 3, title:'提示'}, function(index){
                if(!lock) {
                    lock = true;//锁定
                    // data.field.content= ue.getContent();
                    $.post("<?=base_url('sys/Site/upInfo')?>",data.field,function(res){
                        // console.log(res);
                        if(res.status=="success"){
                            var index = layer.alert('信息更改成功', {
                            }, function () {
                                layer.close(index);
                                miniTab.deleteCurrentByIframe();
                            });
                            return false;

                        }else{
                            layer.msg(res.txt, function (index) {
                                form.render();
                            });
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
