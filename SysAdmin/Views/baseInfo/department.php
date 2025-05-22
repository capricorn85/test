<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>部门列表</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/css/public.css')?>">

</head>

<body>
<div class="layuimini-container">

    <div class="layuimini-main">

        <!--       start 搜索-->
        <div style="margin: 10px 10px 10px 10px">
            <!--            <blockquote class="layui-elem-quote layui-bg-cyan">-->
            <!--                <span class="layui-badge-dot layui-bg-orange" style="margin-right:8px"></span>说明。-->
            <!--             -->
            <!--            </blockquote>-->
            <form class="layui-form layui-form-pane" method="get" action="">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">部门编码</label>
                        <div class="layui-input-inline">
                            <input type="text" name="dno" autocomplete="off" class="layui-input" value="<?=isset($_GET['dno'])?$_GET['dno']:''?>">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">名称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="dname" autocomplete="off" class="layui-input" value="<?=isset($_GET['dname'])?$_GET['dname']:''?>">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">所属工商所</label>
                        <div class="layui-input-inline">

                            <select name="status" class="form-control">
                                <option value="">--------------------</option>
                                <?php foreach(hp_show()  as $value): ?>
                                    <?php if (($value['id']!=3)||isset($_GET['invalid_code'])):?>
                                        <option value="<?=$value['id']?>"  <?=isset($_GET['status'])?(($value['id']==$_GET['status'])?'selected':''):''?>><?=$value['text']?></option>
                                    <?php endif;?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button type="submit" class="layui-btn layui-btn" id="submit" lay-submit lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>

                    </div>
                </div>
            </form>
        </div>
        <!--       end 搜索-->


        <?php if (isset($nav_mold[1])||isset($nav_mold[3])):?>
            <div class="layui-border-box layui-table-view" style="margin:10px 0 0" >
                <div class="layui-table-tool">
                    <div class="layui-btn-container">
                        <?php if (isset($nav_mold[1])&&$nav_mold[1]==1):?>
                            <button class="layui-btn layui-btn-sm layui-btn-normal" onclick="javascript:open_window('<?=site_url("xccmssys/Department/form")?>','新增栏目')" >新增</button>
                        <?php endif;?>
                        <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>
                            <button class="layui-btn layui-btn-sm layui-btn-danger" onclick="del()">停用</button>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        <?php endif;?>
        <table class="layui-table" style="margin: 0 0 10px">
            <thead>
            <tr>
                <th  width="1"><input  id="check_all"  type="checkbox"/></th>
                <th>部门编码</th>
                <th >部门名称</th>
                <th >负责人</th>
                <th >所属工商所</th>
                <th >状态</th>
                <th >排序</th>
                <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                    <th  style="width: 85px">操作</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>
            <?php foreach($list as $row): ?>
                <tr>
                    <td class="check"><input type="checkbox" name='choice' value="<?=$row['did']?>"/></td>
                    <!--                        <td >--><?//=$row['id']?><!--</td>-->
                    <td ><?=$row['dno']?></td>
                    <td ><?=$row['dname']?></td>
                    <td ><?=$row['pname']?></td>
                    <td ><?=$row['aname']?></td>
                    <td ><?=hp_d_status($row['d_state'])?></td>
                    <td ><?=$row['sort_order']?></td>
                    <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                        <td  style="width: 85px">
                            <div class="layui-btn-group">
                                <?php if (isset($nav_mold[2])&&$nav_mold[2]==1):?>
                                    <a class="layui-btn layui-btn-xs" lay-event="edit" href="javascript:open_window('<?=site_url("xccmssys/Department/form?did=".$row['did'])?>','编辑部门信息--<?=$row['dname']?>')">修改</a>
                                <?php endif;?>
                                <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>
                                    <?php if ($row['d_state']==1):?>
                                        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="delone(<?=$row['did']?>)" >停用</a>
                                    <?php endif;?>
                                <?php endif;?>

                            </div>
                        </td>
                    <?php endif;?>
                </tr>


            <?php endforeach; ?>
            </tbody>
        </table>

        <div style="text-align: center">
            <?= $pager->links('alist','default_layui') ?>
        </div>

    </div>
</div>

<script src="<?=base_url('statics/plugins/layuimini/lib/layui/layui.js')?>"></script>


<script>


    layui.use(['jquery', 'layer','form'], function () {
        var $ = layui.jquery,
            form = layui.form,
            layer = layui.layer;

        //layer弹出窗口
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
            n="<?=site_url('xccmssys/Department/stopDep')?>";
            delMsg2(x,n);
        }

        window.delone=function(x){
            n="<?=site_url('xccmssys/Department/stopDep')?>";
            upMsg(x,n);
        }
        window.upMsg=function(chk_value,n) {
            layer.confirm('请您确定是否停用该部门？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                delId={
                    id:chk_value,
                };
                $.post(n,delId,function (data) {
                    console.log(data);
                    data= eval("("+data+")");
                    if (data.status=='success'){
                        layer.alert("部门已停用成功", {
                            closeBtn: 0,
                            anim: 4 //动画类型
                        },function(){
                            window.location.reload();

                        });
                    }else if(data.status=='failed'){
                        layer.msg("部门停用失败", {icon: 1});
                    }
                }) ;

            }, function(){
                layer.msg('您已取消停用部门', {icon: 1});
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
