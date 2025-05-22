<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>人员信息</title>
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
                <label class="layui-form-label">姓名</label>
                <div class="layui-input-block">
                    <input type="text" name="name" lay-verify="required" class="layui-input" value="<?=isset($list['pname'])?$list['pname']:''?>" placeholder="请输入姓名">
                </div>
            </div>


            <div class="layui-form-item">
                <label class="layui-form-label">所属部门	</label>
                <div class="layui-input-block">
                    <input type="text"  name="dname" id="dname" readonly lay-verify="required" class="layui-input checkDup" value="<?=isset($list['dname'])?$list['aname'].'.'.$list['dname']:''?>" placeholder="点击选择部门">
                </div>
            </div>
            <input type="hidden" id="dep" name="dep" lay-verify="required"  data-ctype='dep'  class="layui-input checkDup" value="<?=isset($list['dep'])?$list['dep']:''?>">




            <div class="layui-form-item">
                <label  for="sort_order" class="layui-form-label">身份</label>
                <div class="layui-input-block">
                    <select name="capacity"  lay-filter="rstyle" >

                        <?php foreach (hp_capacity() as $value): ?>
                            <option value="<?=$value["id"]?>" <?php if(isset($list)&&$list["capacity"]==$value["id"]): ?>selected<?php endif; ?>><?=$value["text"]?></option>
                        <?php endforeach ?>

                    </select>
                    <!--						<span class="help-block m-b-none"><i class="fa fa-info-circle"></i>注意！</span>-->
                </div>
            </div>
            <div class="layui-form-item">
                <label  for="sort_order" class="layui-form-label">人员状态</label>
                <div class="layui-input-block">
                    <select name="p_state"  lay-filter="rstyle" >

                            <?php foreach (hp_p_status() as $value): ?>
                                <option value="<?=$value["id"]?>" <?php if(isset($list)&&$list["p_state"]==$value["id"]): ?>selected<?php endif; ?>><?=$value["text"]?></option>
                            <?php endforeach ?>

                    </select>
                    <!--						<span class="help-block m-b-none"><i class="fa fa-info-circle"></i>注意！</span>-->
                </div>
            </div>
            <div class="layui-form-item">
                <label  for="sort_order" class="layui-form-label">电话</label>
                <div class="layui-input-block">
                        <input type="text" name="tel" lay-verify="required" class="layui-input" value="<?=isset($list['tel'])?$list['tel']:''?>" placeholder="请输入电话">

                </div>
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
            elem: '#dname',	//定义输入框input对象 必填
            checkedKey: 'did', //表格的唯一建值，非常重要，影响到选中状态 必填
            searchKey: 'dname',	//搜索输入框的name值 默认keyword
            searchPlaceholder: '部门名称',	//搜索输入框的提示文字 默认关键词搜索
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

                url:'<?=base_url('xccmssys/Department/getDlist')?>',
                limit:8,
                limits:[8],
                cols: [[ {field:'did', title:'ID', width:70, fixed: 'left', unresize: true,  type: 'radio' }
                    ,{field:'dno', width:90,title:'部门编码'}
                    ,{field:'dname',title:'部门'}
                    ,{field:'short_name', title:'所属工商所'}
                    ]]
            },

            done: function (elem, data) {
                //选择完后的回调，包含2个返回值 elem:返回之前input对象；data:表格返回的选中的数据 []
                //拿到data[]后 就按照业务需求做想做的事情啦~比如加个隐藏域放ID...
                layui.each(data.data,function (index,item){
                    $("#dname").val(item.short_name+'.'+item.dname);
                    $("#dep").val(item.did);
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
                    data.field.id=<?=isset($_GET['pid'])?$_GET['pid']:'0'?>;
                    $.post("<?=site_url('xccmssys/Persons/eform')?>",data.field,function(res){
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
