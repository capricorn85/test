<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>部门信息</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/css/public.css')?>">
    <style>
        .layui-form-select dl{
            z-index: 1000;
        }
        .layui-form-label{
            width:115px;
        }
        .layui-input-block{
            margin-left:145px;
        }

        .layuimini-container{
            padding:20px;
        }
        .tableSelect{border: 1px solid #00FF00}
    </style>
</head>

<body>

<div class="layuimini-container">
    <div class="layuimini-main">
        <div class="layui-row clearfix">
        <form class="layui-form" id="cateForm" method="post" >
            <div class="layui-form-item">
                <label class="layui-form-label">部门编码</label>
                <div class="layui-input-block">
                    <input type="text" name="dno" lay-verify="required" class="layui-input" value="<?=isset($list['dno'])?$list['dno']:''?>" placeholder="请输入部门编码">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">部门名称</label>
                <div class="layui-input-block">
                    <input type="text" name="dname" class="layui-input" value="<?=isset($list['dname'])?$list['dname']:''?>" placeholder="请输入部门名称">

                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">部门负责人</label>
                <div class="layui-input-inline">
                    <input type="text"  name="pname" id="pname" readonly lay-verify="required" class="layui-input checkDup" value="<?=isset($list['pname'])?$list['pname']:''?>" placeholder="点击选择负责人">
                </div>
            </div>
            <input type="hidden" id="director" name="director" lay-verify="required"  data-ctype='director'  class="layui-input checkDup" value="<?=isset($list['director'])?$list['director']:''?>">

            <div class="layui-form-item">
                <label class="layui-form-label">所属工商所</label>
                <div class="layui-input-block">
                    <select name="org" class="form-control" lay-verify="required"  lay-search="">
                        <option value="">搜索选择</option>
                        <?php foreach($alist as $row): ?>
                        <?php if ($row['paid']==0):?>
                            <option value="<?=$row['aid']?>"  <?=isset($list['org'])?(($row['aid']==$list['org'])?'selected':''):''?>><?=$row['short_name']?></option>
                                <?php foreach($alist as $row2): ?>
                                    <?php if ($row2['paid']==$row['aid']):?>
                                        <option value="<?=$row2['aid']?>"  <?=isset($list['org'])?(($row2['aid']==$list['org'])?'selected':''):''?>>-<?=$row2['short_name']?></option>
                                        <?php foreach($alist as $row3): ?>
                                            <?php if ($row3['paid']==$row2['aid']):?>
                                                <option value="<?=$row3['aid']?>"  <?=isset($list['org'])?(($row3['aid']==$list['org'])?'selected':''):''?>>--<?=$row3['short_name']?></option>
                                            <?php endif;?>
                                        <?php endforeach; ?>
                                    <?php endif;?>
                                <?php endforeach; ?>
                        <?php endif;?>
                        <?php endforeach; ?>
                    </select>

                </div>
            </div>
            <?php if (isset($nav_mold[3])&&$nav_mold[3]==1):?>
            <div class="layui-form-item">
                <label  for="sort_order" class="layui-form-label">部门状态</label>
                <div class="layui-input-block">
                    <select name="d_state"  lay-filter="rstyle" >

                            <?php foreach (hp_d_status() as $value): ?>
                                <option value="<?=$value["id"]?>" <?php if(isset($list)&&$list["d_state"]==$value["id"]): ?>selected<?php endif; ?>><?=$value["text"]?></option>
                            <?php endforeach ?>

                    </select>
                    <!--						<span class="help-block m-b-none"><i class="fa fa-info-circle"></i>注意！</span>-->
                </div>
            </div>
            <?php endif;?>
            <div class="layui-form-item">
                <label  for="sort_order" class="layui-form-label">部门排序</label>
                <div class="layui-input-inline">
                    <input type="text" name="sort_order"  min="0" max="999"  value="<?=isset($list['sort_order'])?$list['sort_order']:'0'?>" lay-verify="required" class="layui-input"/>

                </div>
                <div class="layui-form-mid layui-word-aux">排序数字范围0-999，数字越大排序越前！</div>
            </div>


            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo" id="btnSave">立即提交</button>

                </div>
            </div>
        </form>
    </div>
</div>

    <script src="<?=base_url('statics/plugins/layuimini/lib/layui/layui.js')?>"></script>
    <script src="<?=base_url('statics/plugins/layuimini/js/lay-config.js')?>"></script>


<script>
    layui.use(['layer', 'jquery', 'form','tableSelect'], function () {
        var layer = layui.layer,
            $ = layui.jquery,
            tableSelect = layui.tableSelect,
            form = layui.form;

        // form.verify({
        //
        // });



        tableSelect.render({
            elem: '#pname',	//定义输入框input对象 必填
            checkedKey: 'pid', //表格的唯一建值，非常重要，影响到选中状态 必填
            searchKey: 'name',	//搜索输入框的name值 默认keyword
            searchPlaceholder: '姓名',	//搜索输入框的提示文字 默认关键词搜索
            height:'400',  //自定义高度
            width:'800',  //自定义宽度
            parseData: function(res){ //res 即为原始返回的数据
                return {
                    "code": res.code, //解析接口状态
                    // "msg": res.msg, //解析提示文本
                    "count": res.count, //解析数据长度
                    "data": res.data.item //解析数据列表
                };
            },
            table: {	//定义表格参数，与LAYUI的TABLE模块一致，只是无需再定义表格elem

                url:'<?=base_url('xccmssys/Persons/pdlist')?>',
                limit:8,
                limits:[8],
                cols: [[ {field:'pid', title:'ID', width:70, fixed: 'left', unresize: true,  type: 'radio' }
                    ,{field:'name', width:90,title:'姓名'}
                    ,{field:'dname', title:'所属部门'}
                    ,{field:'a_state', title:'账号状态'}
                    ]]
            },

            done: function (elem, data) {
                //选择完后的回调，包含2个返回值 elem:返回之前input对象；data:表格返回的选中的数据 []
                //拿到data[]后 就按照业务需求做想做的事情啦~比如加个隐藏域放ID...
                layui.each(data.data,function (index,item){
                    $("#pname").val(item.name);
                    $("#director").val(item.pid);
                })

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
            layer.confirm('确定提交信息？',{btn:["确定","取消"],icon: 3, title:'提示'}, function(index){
                if(!lock) {
                    lock = true;//锁定
                    data.field.id=<?=isset($_GET['did'])?$_GET['did']:'0'?>;
                    $.post("<?=site_url('xccmssys/Department/eform')?>",data.field,function(res){
                        // console.log(res);
                        if(res.status=="success"){
                            layer.alert(res.txt,
                            function(){
                                var index = parent.layer.getFrameIndex(window.name);
                                window.parent.location.reload();//刷新父页面
                                parent.layer.close(index);//关闭弹出层
                            });

                        }else{
                            layer.msg(res.txt, {time: 2000});
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
