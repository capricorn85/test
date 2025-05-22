<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>重置密码</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/css/public.css')?>">

    <style>
    </style>
</head>

<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <form  class="layui-form"  method="post">
            <div class="layui-form layuimini-form">
                <div class="layui-form-item">
                    <label class="layui-form-label required">旧的密码</label>
                    <div class="layui-input-block">
                        <input type="password" name="old_password" lay-verify="required|pass" lay-reqtext="旧的密码不能为空" placeholder="请输入旧的密码"  value="" class="layui-input">
                        <tip>填写自己账号的旧的密码。</tip>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label required">新的密码</label>
                    <div class="layui-input-block">
                        <input type="password" name="password" lay-verify="required|pass|inconPass" lay-reqtext="新的密码不能为空" placeholder="请输入新的密码"  value="" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label required">确认密码</label>
                    <div class="layui-input-block">
                        <input type="password" name="again_password" lay-verify="required|pass|confirmPass" lay-reqtext="确认密码不能为空" placeholder="请输入确认密码"  value="" class="layui-input">
                    </div>
                </div>

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




<script>
    layui.use(['layer','form'], function () {
        var form = layui.form,
          $ = layui.jquery,
            miniTab = layui.miniTab,
            layer = layui.layer;


        form.verify({
            pass: [/^[\S]{6,12}$/,'密码必须6到12位，且不能出现空格']
            ,confirmPass:function(value){
                if($('input[name=password]').val() !== value)
                    return '两次密码输入不一致！';
            }
            ,inconPass:function (value) {
                if($('input[name=old_password]').val() == value)
                    return '新密码不能同原密码相同！';
            }
        })
        //监听提交
        form.on('submit(formDemo)', function(data){
            var isDisabled = $("#btnSave").hasClass('layui-btn-disabled');
            if (isDisabled) {
                return false;
            }
            else{$("#btnSave").addClass('layui-btn-disabled');}
            var lock=false;
            layer.confirm('确定修改密码？',{btn:["确定","取消"],icon: 3, title:'提示'}, function(index){
                if(!lock) {
                    lock = true;//锁定
                    $.post("<?=site_url('xccmssys/Home/pwdReset')?>",data.field,function(res){
                        // console.log(res);
                        if(res.status=="success"){
                            var index = layer.alert('密码更改成功,请重新登录！', {
                            }, function () {
                                layer.close(index);
                                // miniTab.deleteCurrentByIframe();
                                window.location = "<?=base_url('login/logout')?>";
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
