<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>管理员信息</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">



    <!--    <link rel="stylesheet" href="--><?//=base_url('statics/css/css.css')?><!--">-->
    <style>
        .layui-form-select dl{
            z-index: 1000;
        }
        .layuimini-container{
            padding:20px;
        }
    </style>
</head>

<body>

<div class="layuimini-container">
    <div class="layuimini-main">
        <div class="layui-row clearfix">
            <form class="layui-form" id="articleForm" method="post" >
                <div class="layui-form-item">
                    <label class="layui-form-label">用户名</label>
                    <div class="layui-input-inline">
                        <?php if (isset($list['username'])):?>
                            <span class="layui-input"  style="line-height: 38px" value="<?=isset($list['username'])?$list['username']:''?>"><?=$list['username']?></span>
                        <?php else:?>
                            <input type="text" name="username"  id="adminname" lay-verify="required|username" class="layui-input"  placeholder="请输入用户名">

                        <?php endif;?>
                    </div>
                    <div class="layui-form-mid layui-word-aux"><span id="msgCheck"></span>用户名为登录账号，创建成功后不可更改！</div>

                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">关联人员</label>
                    <div class="layui-input-inline">
                        <input type="text"  id="pname" name="pname" readonly lay-verify="required" class="layui-input checkDup" value="<?=isset($list['name'])?$list['name']:''?>"  placeholder="点击选择所属人员">
                    </div>
                    <input type="hidden" id="pid" name="pid" lay-verify="required" class="layui-input" value="<?=isset($list['pid'])?$list['pid']:''?>">
                </div>

<!--                <div class="layui-form-item">-->
<!--                    <label class="layui-form-label">所属市场主体</label>-->
<!--                    <div class="layui-input-block">-->
<!--                        <input type="text"  id="b_name" name="b_name" id="b_name" readonly lay-verify="required" class="layui-input checkDup" value="--><?//=isset($list['b_name'])?$list['b_name']:''?><!--" placeholder="点击选择市场主体">-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--                <input type="hidden" id="eid" name="eid" lay-verify="required"  data-aa='AA'  class="layui-input checkDup" value="--><?//=isset($list['AA'])?$list['AA']:''?><!--">-->

                <div class="layui-form-item">
                    <label class="layui-form-label">所属角色</label>
                    <div class="layui-input-block">

                        <div id="tree"></div>

                        <!--                    <input type="text" name="author" lay-verify="required" class="layui-input" value="--><?//=isset($list['scopes'])?$list['scopes']:''?><!--" placeholder="请输入权限名称">-->
                    </div>
                    <!--                <div class="layui-form-mid layui-word-aux">请选择权限菜单！--><?//=isset($list['scopes'])?$list['scopes']:''?><!--</div>-->

                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <!--                    <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>-->
                        <button class="layui-btn" lay-submit lay-filter="formDemo" id="btnSave">立即提交</button>
                        <!--                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>-->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?=base_url('statics/plugins/layuimini/lib/layui/layui.js')?>"></script>
<script src="<?=base_url('statics/plugins/layuimini//js/lay-config.js')?>"></script>




<script>
    layui.use(['layer', 'jquery', 'form','tree','tableSelect'], function () {
        var layer = layui.layer,
            $ = layui.jquery,
            form = layui.form,
            tableSelect = layui.tableSelect,
            tree = layui.tree;
        <?php if(!isset($list['pid'])):?>
        tableSelect.render({
            elem: '#pname',	//定义输入框input对象 必填
            checkedKey: 'pid', //表格的唯一建值，非常重要，影响到选中状态 必填
            searchType: 'more',
            searchList: [
                {searchKey: 'name', searchPlaceholder: '搜索姓名'},
            ],
            // searchKey: 'name',	//搜索输入框的name值 默认keyword
            // searchPlaceholder: '市场主体名称',	//搜索输入框的提示文字 默认关键词搜索
            height:'400',  //自定义高度
            width:'600',  //自定义宽度
            parseData: function(res){ //res 即为原始返回的数据
                return {
                    "code": res.code, //解析接口状态
                    // "msg": res.msg, //解析提示文本
                    "count": res.count, //解析数据长度
                    "data": res.data.item //解析数据列表
                };
            },
            table: {	//定义表格参数，与LAYUI的TABLE模块一致，只是无需再定义表格elem

                url:'<?=base_url('xccmssys/Persons/palist')?>',
                limit:8,
                limits:[8],
                cols: [[{field:'pid', title:'ID', width:70, fixed: 'left', unresize: true,  type: 'radio' }
                    ,{field:'name', width:90,title:'姓名'}
                    ,{field:'short_name', title:'所属工商所'}
                    ,{field:'dname', title:'所属部门'}]]
            },
            done: function (elem, data) {
                //选择完后的回调，包含2个返回值 elem:返回之前input对象；data:表格返回的选中的数据 []
                //拿到data[]后 就按照业务需求做想做的事情啦~比如加个隐藏域放ID...
                layui.each(data.data,function (index,item){
                    $("#pname").val(item.name);
                    $("#pid").val(item.pid);
                })

            }
        })
        <?php endif;?>
        data2=<?=json_encode($rList)?>;

        //基本演示
        tree.render({
            elem: '#tree'
            ,data: data2
            ,showCheckbox: true  //是否显示复选框
            ,id: 'demoId'
            ,spread:true
            ,click: function(obj){
                // var data = obj.data;  //获取当前点击的节点数据
                // layer.msg('状态：'+ obj.state + '<br>节点数据：' + JSON.stringify(data));
            }
        });
        //scopes=<?//=json_encode($list['scopes'])?>//;
        //scopes = scopes.split(",");
        // tree.setChecked('demoId', scopes); //批量勾选 id 为 2、3 的节点
        // form.verify({
        //
        // });

        //用户名检测
        $("#adminname").on("change",function(e){
            //用户名可用检测
            m=e.delegateTarget.value;
            if (m){
                var url = "<?=site_url('xccmssys/Admin/checkName')?>";
                $.post(url, {type: "data",adminname: m}, function(res){
                    if(res.status=="failed"){
                        layer.alert(res.txt);
                        $("#adminname").val('');
                    }else{
                        txt='<i class="fa fa-check-square-o" style="color: green"></i>';
                        $("#msgCheck").html(txt);
                    }
                } ,"json");
            }
        });

        form.verify({
            username: function(value, item){ //value：表单的值、item：表单的DOM对象
                if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                    return '用户名不能有特殊字符';
                }
                if(/(^\_)|(\__)|(\_+$)/.test(value)){
                    return '用户名首尾不能出现下划线\'_\'';
                }
                if(/^\d+\d+\d$/.test(value)){
                    return '用户名不能全为数字';
                }
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

            var checkData = tree.getChecked('demoId');
            var ids = getCheckedId(checkData);



            layer.confirm('确定提交信息？',{btn:["确定","取消"],icon: 3, title:'提示'}, function(index){
                if(!lock) {
                    lock = true;//锁定
                    data.field.id=<?=isset($_GET['id'])?$_GET['id']:'0'?>;
                    data.field.roleid=ids;
                    $.post("<?=site_url('xccmssys/Admin/AdminEForm')?>",data.field,function(res){
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


        window.getCheckedId=function(jsonObj) {
            var id = "";
            $.each(jsonObj, function (index, item) {
                // console.log(item);
                if (!item.children){
                    if (id != "") {
                        id = id + "," + item.id;
                    }
                    else {
                        id = item.id;
                    }
                }
                var i = getCheckedId(item.children);
                if (i != "") {
                    if (id !=""){
                        id = id + "," + i;
                    }else{
                        id=i;
                    }
                }

            });
            return id;
        }
    });
</script>
</body>
</html>
