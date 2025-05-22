<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>角色列表</title>
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
                            <button class="layui-btn layui-btn-sm layui-btn-normal" onclick="javascript:open_window('<?=site_url("xccmssys/Role/roleForm")?>','新增角色')" >新增</button>
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
                <th>角色名称</th>
                  <th>角色描述</th>
                <th>角色组</th>
                <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>

                <th style="width: 158px;">操作</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>

            <?php foreach($list as $row): ?>
                <tr>
                    <td class="check"><input type="checkbox" name='choice' value="<?=$row['id']?>"/></td>
                    <td ><?=$row['rolename']?></td>
                     <td ><?=$row['descri']?></td>
                    <td ><?=empty($row['pname'])?'无':$row['pname']?></td>
                    <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                    <td>
                        <div class="layui-btn-group">
                        <?php if (isset($nav_mold[2])&&$nav_mold[2]==1):?>
                            <a class="layui-btn layui-btn-xs" lay-event="edit" href="javascript:open_window('<?=site_url("xccmssys/Role/roleForm?id=".$row['id'])?>','编辑角色--<?=$row['rolename']?>')">编辑</a>
                            <?php if(!isset($row['child'])):?>
                                <a class="layui-btn  layui-btn-warm layui-btn-xs" lay-event="edit" href="javascript:open_window('<?=site_url("xccmssys/Role/auth_role?id=".$row['id'])?>','权限调整--<?=$row['rolename']?>')">权限调整</a>
                            <?php endif;?>
                        <?php endif;?>
                        <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>
                            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="delone(<?=$row['id']?>)" >删除</a>
                        <?php endif;?>
                        </div>
                    </td>
                    <?php endif;?>
                </tr>
                <?php if (isset($row['child'])):?>
                    <?php foreach($row['child'] as $row2): ?>
                        <tr>
                            <td class="check"><input type="checkbox" name='choice' value="<?=$row2['id']?>"/></td>
                            <td >&nbsp;&nbsp;&nbsp;&nbsp;|—<?=$row2['rolename']?></td>
                             <td ><?=$row2['descri']?></td>
                            <td ><?=$row2['pname']?></td>
                        <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                            <td>
                                <div class="layui-btn-group">
                                <?php if (isset($nav_mold[2])&&$nav_mold[2]==1):?>
                                    <a class="layui-btn layui-btn-xs" lay-event="edit" href="javascript:open_window('<?=site_url("xccmssys/Role/roleForm?id=".$row2['id'])?>','编辑角色--<?=$row2['rolename']?>')">编辑</a>
                                    <a class="layui-btn  layui-btn-warm layui-btn-xs" lay-event="edit" href="javascript:open_window('<?=site_url("xccmssys/Role/auth_role?id=".$row2['id'])?>','权限调整--<?=$row2['rolename']?>')">权限调整</a>
                                <?php endif;?>
                                <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>
                                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="delone(<?=$row2['id']?>)" >删除</a>
                                <?php endif;?>
                                </div>
                            </td>
                        <?php endif;?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif;?>
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

        //layer弹出窗口
        window.open_window = function (u, t) {
            var index = layer.open({
                type: 2,
                title: t,
                shade: 0.5,
                area: ['80%', '80%'],
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


    <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>
        window.del=function(){
        x=$("input[name='choice']:checked");
        n="<?=site_url('xccmssys/Role/roleDelete')?>";
        delMsg2(x,n);
    }
    window.delone=function(x){
        n="<?=site_url('xccmssys/Role/roleDelete')?>";
        upMsg(x,n);
    }
     window.upMsg=function(chk_value,n) {
        layer.confirm('该角色若有子角色该操作将会连同子角色一起删除，请您确定是否删除？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            delId={
                id:chk_value,
            };
            $.post(n,delId,function (data) {
                data= eval("("+data+")");
                if (data.status=='success'){
                    layer.alert("角色已删除成功", {
                        closeBtn: 0,
                        anim: 4 //动画类型
                    },function(){
                        window.location.reload();

                    });
                }else if(data.status=='failed'){
                    layer.msg("角色删除失败", {icon: 1});
                }
            }) ;

        }, function(){
            layer.msg('您已取消删除角色', {icon: 1});
        });
    }
    window.chkVal=function(x){
        x.each(function(){
            if (chk_value==""){chk_value+=$(this).val();}
            else{
                chk_value+=","+$(this).val();
            }
        });
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
    <?php endif;?>
    })
</script>
</body>
</html>
