<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>人员列表</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/css/public.css')?>">

</head>

<body>
<div class="layuimini-container">

    <div class="layuimini-main">
        <div style="margin: 10px 10px 10px 10px">
            <form class="layui-form layui-form-pane" method="get" action="">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">姓名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" autocomplete="off" class="layui-input" value="<?=isset($_GET['name'])?$_GET['name']:''?>">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">人员状态</label>
                        <div class="layui-input-inline">
                            <select name="p_state" class="form-control">
                                <option value="999">--------------------</option>
                                <?php foreach(hp_p_status()  as $row): ?>
                                    <option value="<?=$row['id']?>"  <?=isset($_GET['p_state'])?(($row['id']==$_GET['p_state'])?'selected':''):''?>><?=$row['text']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">人员身份</label>
                        <div class="layui-input-inline">
                            <select name="capacity" class="form-control">
                                <option value="999">--------------------</option>
                                <?php foreach(hp_capacity()  as $row): ?>
                                    <option value="<?=$row['id']?>"  <?=isset($_GET['capacity'])?(($row['id']==$_GET['capacity'])?'selected':''):''?>><?=$row['text']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">账号状态</label>
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
                    </div>
                </div>
            </div>
        <?php endif;?>
        <table class="layui-table" style="margin: 0 0 10px">
            <thead>
            <tr>
                <th  width="1"></th>
                <th>姓名</th>
                <th>所属部门</th>
                <th >身份</th>
                <th >账号状态</th>
                <th >人员状态</th>
                <th >电话</th>
                <th >创建时间</th>
                <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                    <th  style="width: 85px">操作</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>
            <?php $i=1;?>
            <?php foreach($list as $row): ?>
                <tr>
                    <td class="check"><?=$i++?></td>
                    <td ><?=$row['pname']?></td>
                    <td ><?=$row['aname'].'.'.$row['dname']?></td>
                    <td ><?=hp_capacity($row['capacity'])?></td>
                    <td ><?=hp_a_status($row['a_state'])?></td>
                    <td ><?=hp_p_status($row['p_state'])?></td>
                    <td ><?=$row['tel']?></td>
                    <td ><?=$row['create_at']?></td>
                    <?php if (isset($nav_mold[2])||isset($nav_mold[3])):?>
                        <td  style="width: 85px">
                            <div class="layui-btn-group">
                                <?php if (isset($nav_mold[2])&&$nav_mold[2]==1):?>
                                    <a class="layui-btn layui-btn-xs" lay-event="edit" href="javascript:open_window('<?=site_url("xccmssys/Persons/form?pid=".$row['pid'])?>','编辑人员信息--<?=$row['pname']?>')">修改</a>
<!--                                    --><?php //if ($row['a_state']==0):?>
<!--                                        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="delone(--><?//=$row['pid']?>//)" >生成账号</a>
//                                    <?php //endif;?>
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



    })
</script>
</body>
</html>
