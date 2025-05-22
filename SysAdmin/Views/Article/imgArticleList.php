<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>文章列表</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">

</head>

<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <fieldset class="table-search-fieldset">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px">
                <form class="layui-form layui-form-pane" method="get" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">文章名称</label>
                            <div class="layui-input-inline">
                                <input type="text" name="article_title" autocomplete="off" class="layui-input" value="<?=isset($_GET['article_title'])?$_GET['article_title']:''?>">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">所属栏目</label>
                            <div class="layui-input-inline">

                                <select name="nav_id" class="form-control">
                                    <option value="">--------------------</option>
                                    <?php foreach($cat_list as $row): ?>
<!--                                        --><?php //echo($row['id'])?>
                                        <option value="<?=$row['id']?>"  <?=isset($_GET['nav_id'])?(($row['id']==$_GET['nav_id'])?'selected':''):''?>><?=$row['label']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button type="submit" class="layui-btn layui-btn"  lay-submit lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>
<!--                            <button type="reset" class="layui-btn layui-btn-primary"  lay-reset ><i class="layui-icon-circle"></i> 重 置</button>-->
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>
        <?php if (isset($nav_mold[1])||isset($nav_mold[3])):?>
            <div class="layui-border-box layui-table-view" style="margin:10px 0 0" >
                <div class="layui-table-tool">
                    <div class="layui-btn-container">
                        <?php if (isset($nav_mold[1])&&$nav_mold[1]==1):?>
                            <button class="layui-btn layui-btn-sm layui-btn-normal" onclick="javascript:open_window('<?=site_url("xccmssys/imgArticle/form")?>','新增文章')" >新增</button>
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
                <th>文章标题</th>
                <th width="140">所属栏目</th>
                <th width="80">作者</th>
                <th >缩略图</th>
                <th width="40">排序</th>
                <th  width="80">日期</th>
                <th width="60">是否显示</th>
                <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                    <th style="width: 90px">操作</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>

            <?php foreach($list as $row): ?>
                <tr>
                    <td class="check"><input type="checkbox" name='choice' value="<?=$row['id']?>"/></td>
                    <td ><?=$row['article_title']?></td>
                    <td ><?=$row['label']?></td>
                    <td ><?=$row['author']?></td>
                    <td ><?=empty($row['thumb'])?'无':'<img src="'.base_url($row['thumb']).'"'?></td>

                    <td ><?=$row['sort_order']?></td>
                    <td ><?=$row['atime']==''?'':date("Y-m-d",strtotime($row['atime']))?></td>
                    <td ><?=hp_show($row['is_show'])?></td>
                    <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                        <td style="width: 90px">
                            <?php if (isset($nav_mold[2])&&$nav_mold[2]==1):?>
                                <a class="layui-btn layui-btn-xs" lay-event="edit" href="javascript:open_window('<?=site_url("xccmssys/imgArticle/form?id=".$row['id'])?>','编辑文章--<?=$row['label']?>')">修改</a>
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
        <!--    --><?//= dd($pager) ?>


        <div style="text-align: center">
            <?= $pager->links('alist','default_layui') ?>
        </div>
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
            n="<?=base_url('xccmssys/imgArticle/deleteArt')?>";
            delMsg2(x,n);
        }

        window.delone=function(x){
            n="<?=base_url('xccmssys/imgArticle/deleteArt')?>";
            upMsg(x,n);
        }


        window.upMsg=function(chk_value,n) {
        layer.confirm('请您确定是否删除文章？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            delId={
                id:chk_value,
            };
            $.post(n,delId,function (data) {
                data= eval("("+data+")");
                if (data.status=='success'){
                    layer.alert("文章已删除成功", {
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
