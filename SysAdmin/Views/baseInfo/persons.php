<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>人员列表</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">


<!--    <link rel="stylesheet" href="--><?php //=base_url('statics/css/css.css')?><!--">-->

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
                        <label class="layui-form-label">人员名称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" autocomplete="off" class="layui-input" value="<?=isset($_GET['name'])?$_GET['name']:''?>">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">关联帐号状态</label>
                        <div class="layui-input-inline">
                            <select name="a_state" class="form-control">
                                <option value="999">--------------------</option>
                                <?php foreach(hp_a_status()  as $row): ?>
                                    <option value="<?=$row['id']?>"  <?=isset($_GET['a_state'])?(($row['id']==$_GET['a_state'])?'selected':''):''?>><?=$row['text']?></option>
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
                            <button class="layui-btn layui-btn-sm layui-btn-normal" onclick="javascript:open_window('<?=site_url("xccmssys/Persons/form")?>','新增人员')" >新增</button>
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
<!--                <th>证件号</th>-->
                <th>姓名</th>
                <th>所属组织</th>
<!--                <th>身份</th>-->
                <th>联系电话</th>
                <th>账号状态</th>
                <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                    <th  style="width: 90px">操作</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>
<!--            'list'  =>$this->PersonsModel->select('pid,dname,persons.name pname,p_state,a_state,persons.create_at,tel,capacity,,AIC.short_name aname')-->
            <?php foreach($list as $row): ?>
                <tr>
                    <td class="check"><input type="checkbox" name='choice' value="<?=$row['pid']?>"/></td>
<!--                    <td >--><?php //=$row['Idcard']?><!--</td>-->
                    <td ><?=$row['pname']?></td>
                    <td ><?=$row['dname'].$row['aname']?></td>
<!--                    <td >--><?php //=hp_c_type($row['capacity'])?><!--</td>-->
                    <td ><?=$row['tel']?></td>
                    <td ><?=hp_a_status($row['a_state'])?></td>
                    <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                        <td  style="width: 85px">
                            <?php if (isset($nav_mold[2])&&$nav_mold[2]==1):?>
                                <a class="layui-btn layui-btn-xs" lay-event="edit" href="javascript:open_window('<?=site_url("xccmssys/Persons/form?id=".$row['pid'])?>','编辑人员--<?=$row['pname']?>')">修改</a>
                            <?php endif;?>
                            <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>
                                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="delone(<?=$row['pid']?>)" >删除</a>
                            <?php endif;?>
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
        open_window = function (u, t) {
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
    })

    <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>

    window.del=function(){
        x=$("input[name='choice']:checked");
        n="<?=site_url('xccmssys/Persons/deleteP')?>";
        delMsg2(x,n);
    }

    window.delone=function(x){
        n="<?=site_url('xccmssys/Persons/deleteP')?>";
        upMsg(x,n);
    }
    window.upMsg=function(chk_value,n) {
        layer.confirm('请您确定是否删除该人员信息？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            delId={
                id:chk_value,
            };
            jQuery.post(n,delId,function (data) {
                data= eval("("+data+")");
                if (data.status=='success'){
                    layer.alert("人员信息已删除成功", {
                        closeBtn: 0,
                        anim: 4 //动画类型
                    },function(){
                        window.location.reload();

                    });
                }else if(data.status=='failed'){
                    layer.msg("人员信息删除失败", {icon: 1});
                }
            }) ;

        }, function(){
            layer.msg('您已取消删除人员信息', {icon: 1});
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


</script>
</body>
</html>
