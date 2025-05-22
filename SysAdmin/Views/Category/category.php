<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>栏目列表</title>
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
                            <button class="layui-btn layui-btn-sm layui-btn-normal" onclick="javascript:open_window('<?=site_url("xccmssys/cate/form")?>','新增栏目')" >新增</button>
                        <?php endif;?>
                        <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>
                            <button class="layui-btn layui-btn-sm layui-btn-danger" onclick="del()">删除</button>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        <?php endif;?>
        <table class="layui-table" style="margin: 0 0 10px">
            <thead>
            <tr>
                <th  width="1"><input  id="check_all"  type="checkbox"/></th>
                <th>栏目名称</th>
                <th >栏目排序</th>
                <th >上级栏目</th>
                <th >栏目类型</th>
                <th >是否显示</th>
                <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                    <th  style="width: 95px">操作</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>

            <?php foreach($list as $row): ?>
                <tr>
                    <td class="check"><input type="checkbox" name='choice' value="<?=$row['id']?>"/></td>
                    <!--                        <td >--><?//=$row['id']?><!--</td>-->
                    <td ><?=$row['cat_name']?></td>
                    <td ><?=$row['sort_order']?></td>
                    <td >无</td>
                    <td ><?=hp_cate_type($row['cat_type'])?></td>
                    <td ><?=hp_show($row['is_show'])?></td>
                    <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                        <td  style="width: 85px">
                            <?php if (isset($nav_mold[2])&&$nav_mold[2]==1):?>
                                <a class="layui-btn layui-btn-xs" lay-event="edit" href="javascript:open_window('<?=site_url("xccmssys/cate/form?id=".$row['id'])?>','编辑栏目--<?=$row['cat_name']?>')">修改</a>
                            <?php endif;?>
                            <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>
                                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="delone(<?=$row['id']?>)" >删除</a>
                            <?php endif;?>
                        </td>
                    <?php endif;?>
                </tr>

                <?php if(isset($row['child'])): ?>
                    <?php foreach($row['child'] as $row2): ?>
                        <tr>
                            <td class="check"><input type="checkbox" name='choice' value="<?=$row2['id']?>"/></td>
                            <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row2['cat_name']?></td>
                            <td ><?=$row2['sort_order']?></td>
                            <td ><?=$row['cat_name']?></td>
                            <td ><?=hp_cate_type($row2['cat_type'])?></td>
                            <td ><?=hp_show($row2['is_show'])?></td>
                            <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                                <td  style="width: 85px">
                                    <?php if (isset($nav_mold[2])&&$nav_mold[2]==1):?>
                                        <a class="layui-btn layui-btn-xs" lay-event="edit" href="javascript:open_window('<?=base_url("xccmssys/cate/form?id=".$row2['id'])?>','编辑栏目--<?=$row2['cat_name']?>')">修改</a>
                                    <?php endif;?>
                                    <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>
                                        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="delone(<?=$row2['id']?>)" >删除</a>
                                    <?php endif;?>
                                </td>
                            <?php endif;?>
                        </tr>
                        <?php if(isset($row2['child'])): ?>
                            <?php foreach($row2['child'] as $row3): ?>
                                <tr>
                                    <td class="check"><input type="checkbox" name='choice' value="<?=$row3['id']?>"/></td>
                                    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-—<?=$row3['cat_name']?></td>
                                    <td ><?=$row3['sort_order']?></td>
                                    <td ><?=$row3['cat_name']?></td>
                                    <td ><?=hp_cate_type($row3['cat_type'])?></td>
                                    <td ><?=hp_show($row3['is_show'])?></td>
                                    <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                                        <td  style="width: 85px">
                                            <?php if (isset($nav_mold[2])&&$nav_mold[2]==1):?>
                                                <a class="layui-btn layui-btn-xs" lay-event="edit" href="javascript:open_window('<?=site_url("xccmssys/cate/form?id=".$row3['id'])?>','编辑栏目--<?=$row3['cat_name']?>')">修改</a>
                                            <?php endif;?>
                                            <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>
                                                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="delone(<?=$row3['id']?>)" >删除</a>
                                            <?php endif;?>
                                        </td>
                                    <?php endif;?>

                                </tr>
                            <?php endforeach; ?>
                        <?php endif;?>
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

        window.open_window = function (u, t) {
            var index = layer.open({
                type: 2,
                title: t,
                shade: 0.5,
                area: ['80%', "80%"],
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
            n="<?=base_url('xccmssys/cate/deleteCat')?>";
            delMsg2(x,n);
        }

        window.delone=function(x){
            n="<?=base_url('xccmssys/cate/deleteCat')?>";
            upMsg(x,n);
        }
        window.upMsg=function(chk_value,n) {
            layer.confirm('该栏目若有子栏目该操作将会连同子栏目一起删除，请您确定是否删除？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                delId={
                    id:chk_value,
                };
                $.post(n,delId,function (data) {
                    data= eval("("+data+")");
                    if (data.status=='success'){
                        layer.alert("栏目已删除成功", {
                            closeBtn: 0,
                            anim: 4 //动画类型
                        },function(){
                            window.location.reload();

                        });
                    }else if(data.status=='failed'){
                        layer.msg("栏目删除失败", {icon: 1});
                    }
                }) ;

            }, function(){
                layer.msg('您已取消删除栏目', {icon: 1});
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
