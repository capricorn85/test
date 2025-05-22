<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>管理员列表</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">

</head>

<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <?php if (isset($nav_mold[1])||isset($nav_mold[3])):?>

        <div class="layui-border-box layui-table-view" style="margin:10px 0 0" >
            <div class="layui-table-tool">
                <div class="layui-btn-container">
                    <?php if (isset($nav_mold[1])&&$nav_mold[1]==1):?>
                        <button class="layui-btn layui-btn-sm layui-btn-normal" onclick="javascript:open_window('<?=site_url("sys/Admin/adminForm")?>','新增管理员')" >新增</button>
                    <?php endif;?>

                    <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>
                        <button class="layui-btn layui-btn-sm layui-btn-danger" onclick="del()">删除</button>
                    <?php endif;?>
                </div>
            </div>
        </div>

        <?php endif;?>
        <!--    --><?php //dd($list);?>
        <table class="layui-table" style="margin: 0 0 10px">
            <thead>
            <tr>
                <th  width="1"><input  id="check_all"  type="checkbox"/></th>
                <th>用户名</th>
                <th>姓名</th>
                <th>所属机关</th>
                <th>创建时间</th>
                <th>上次登录</th>
                <th>最近登录</th>
                <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                <th style="width: 140px;">操作</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>

            <?php foreach($list as $row): ?>
                <tr>
                    <td class="check">  <?php if ($row['id']!=1):?> <input type="checkbox" name='choice' value="<?=$row['id']?>" /><?php endif;?></td>
                    <td ><?=$row['username']?></td>
                    <td ><?=$row['name']?></td>

                    <td ><?=$row['short_name']?>.<?=$row['dname']?></td>
                    <td ><?=$row['creat_date']?></td>
                    <td ><?=isset($row['lastlogintime'])?$row['lastlogintime']:"无";?></td>
                    <td ><?=isset($row['logintime'])?$row['logintime']:"无";?></td>
                    <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>

                    <td> <div class="layui-btn-group">
                        <?php if ($row['id']!=1):?>
                            <?php if (isset($nav_mold[2])&&$nav_mold[2]==1):?>
                                <a class="layui-btn layui-btn-xs" lay-event="edit" href="javascript:open_window('<?=base_url("sys/Admin/adminForm?id=".$row['id'])?>','编辑管理员--<?=$row['name']?>')">编辑</a>
                                <a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="del" onclick="resetPwd(<?=$row['id']?>)" >重置密码</a>
                            <?php endif;?>
                            <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>
                                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="delone(<?=$row['id']?>)" >删除</a>
                            <?php endif;?>

                        <?php endif;?>
                        </div>
                    </td>
                    <?php endif;?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>


    </div>
</div>
<script src="<?=base_url('statics/plugins/layuimini/lib/layui/layui.js')?>"></script>

<script>

    layui.use(['jquery', 'layer'], function () {
        var $ = layui.jquery,
            layer = layui.layer;


        window.open_window = function (u, t) {
            var index = layer.open({
                type: 2,
                title: t,
                shadeClose: true,
                shade: 0.2,
                area: ['96%', '96%'],
                maxmin: true,
                content: u, //iframe的url
                end: function () {
                    location.reload();//子页面关闭后刷新父页面
                }
            });
        };


        $("#check_all").click(function(){
            if(this.checked){
                $("input[name='choice']").prop("checked", true);
            }else{
                $("input[name='choice']").prop("checked", false);
            }
        });




    window.chkVal=function(x){
        x.each(function(){
            if (chk_value==""){chk_value+=$(this).val();}
            else{
                chk_value+=","+$(this).val();
            }
        });
    }
        <?php if (isset($nav_mold[2])&&$nav_mold[2]==1):?>
       window.resetPwd=function(id){
            layer.confirm('确认重置密码，该操作不可逆？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                u="<?=site_url('sys/Admin/pwdReset')?>";

                $.post(u,{'id':id},function (data) {
                    data= eval("("+data+")");
                    if (data.status=='success'){
                        layer.alert("管理员密码已重置成功,密码重置为"+data.pwd, {
                            closeBtn: 0,
                            anim: 4 //动画类型
                        });
                    }else if(data.status=='failed'){
                        layer.msg("管理员密码重置失败", {icon: 1});
                    }
                }) ;

            }, function(){
                layer.msg('您已取消重置', {icon: 1});
            });

        }
        <?php endif;?>
        <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>
        window.del=function(){
            x=$("input[name='choice']:checked");
            n="<?=base_url('sys/Admin/adminDelete')?>";
            delMsg2(x,n);
        }
        window.delone=function(x){
            n="<?=base_url('sys/Admin/adminDelete')?>";
            upMsg(x,n);
        }
       window.delMsg2=function(x,n) {
            chk_value ="";
            chkVal(x);
            if (chk_value.length==0)
            {
                layer.msg("你还没有选择任何内容！");
            }
            else{
                upMsg(chk_value,n)
            }
        }
        window.upMsg=function(chk_value,n) {
            layer.confirm('管理员删除后，该管理员账号将不可恢复，且不可使用，请确认删除？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                delId={
                    id:chk_value,
                };
                $.post(n,delId,function (data) {
                    data= eval("("+data+")");
                    if (data.status=='success'){
                        layer.alert("管理员已删除成功", {
                            closeBtn: 0,
                            anim: 4 //动画类型
                        },function(){
                            window.location.reload();

                        });
                    }else if(data.status=='failed'){
                        layer.msg("管理员删除失败", {icon: 1});
                    }
                }) ;

            }, function(){
                layer.msg('您已取消删除管理员', {icon: 1});
            });
        }
    <?php endif;?>
    })

</script>
</body>
</html>
