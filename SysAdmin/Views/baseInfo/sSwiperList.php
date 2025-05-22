<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>幻灯片列表</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layui/css/layui.css')?>">
    <link rel="stylesheet" href="<?=base_url('statics/css/css.css')?>">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/css/public.css')?>">

</head>

<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <?php if (isset($nav_mold[1])||isset($nav_mold[3])):?>
            <div class="layui-border-box layui-table-view" style="margin:10px 0 0" >
                <div class="layui-table-tool">
                    <div class="layui-btn-container">
                        <?php if (isset($nav_mold[1])&&$nav_mold[1]==1):?>
                            <button class="layui-btn layui-btn-sm layui-btn-normal" onclick="javascript:open_window('<?=site_url("sourceSwipers/form")?>','新增幻灯片')" >新增</button>
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
                <th>标题</th>
                <th >图片</th>
                <th >排序</th>
                <th >图片类型</th>
                <th >是否显示</th>
                <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                    <th style="width: 85px">操作</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>

            <?php foreach($list as $row): ?>
                <tr>
                    <td class="check"><input type="checkbox" name='choice' value="<?=$row['id']?>"/></td>
                    <td ><?=$row['title']?></td>
                    <td ><img src="<?=base_url($row['href'])?>"></td>
                    <td ><?=$row['sort_order']?></td>
                    <td ><?=hp_img_type($row['itype'])?></td>
                    <td ><?=hp_show($row['is_show'])?></td>
                    <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                        <td style="width: 85px">
                            <?php if (isset($nav_mold[2])&&$nav_mold[2]==1):?>
                                <a class="layui-btn layui-btn-xs" lay-event="edit" href="javascript:open_window('<?=site_url("sourceSwipers/form?id=".$row['id'])?>','编辑幻灯片--<?=$row['title']?>')">修改</a>
                            <?php endif;?>
                            <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>
                                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="delone(<?=$row['id']?>)" >删除</a>
                            <?php endif;?>
                        </td>
                    <?php endif;?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>
<script src="<?=base_url('statics/js/jquery-3.4.1.min.js')?>"></script>
<script src="<?=base_url('statics/plugins/layui/layui.all.js')?>"></script>

<script>
    $(function () {
        //layer弹出窗口



        open_window = function (u, t) {
            var index = layer.open({
                type: 2,
                title: t,
                shade: 0.2,
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
    })

    <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>

    function del(){
        x=$("input[name='choice']:checked");
        n="<?=site_url('sourceSwipers/deleteSwiper')?>";
        delMsg2(x,n);
    }

    function delone(x){
        n="<?=site_url('sourceSwipers/deleteSwiper')?>";
        upMsg(x,n);
    }

    function upMsg(chk_value,n) {
        layer.confirm('请您确定是否删除幻灯片？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            delId={
                id:chk_value,
            };
            jQuery.post(n,delId,function (data) {
                data= eval("("+data+")");
                if (data.status=='success'){
                    layer.alert("幻灯片已删除成功", {
                        closeBtn: 0,
                        anim: 4 //动画类型
                    },function(){
                        window.location.reload();

                    });
                }else if(data.status=='failed'){
                    layer.msg("文章删除失败", {icon: 1});
                }
            }) ;

        }, function(){
            layer.msg('您已取消删除文章', {icon: 1});
        });
    }

    function chkVal(x){
        x.each(function(){
            if (chk_value==""){chk_value+=$(this).val();}
            else{
                chk_value+=","+$(this).val();
            }
        });
    }
    function delMsg2(x,n) {
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



</script>
</body>
</html>
