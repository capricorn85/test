
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>日志</title>
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
                        <label class="layui-form-label" style="width: 140px">日志形式</label>
                        <div class="layui-input-inline">
                            <input type="text" name="title" autocomplete="off" class="layui-input" value="<?=isset($_GET['title'])?$_GET['title']:''?>">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label" style="width: 140px">操作类型</label>
                        <div class="layui-input-inline">
                            <input type="text" name="optype" autocomplete="off" class="layui-input" value="<?=isset($_GET['optype'])?$_GET['optype']:''?>">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <button type="submit" class="layui-btn layui-bg-blue"  lay-submit lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>
                    </div>
                </div>
            </form>


            <table class="layui-table" style="margin: 0 0 10px">
            <thead>
            <tr>
                <th>日志形式</th>
                <th>描述</th>
                <th>操作类型</th>
                <th>操作日期</th>
                <th> 操作账号</th>
                <th>备注</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($list as $row): ?>
                <tr>
                    <td><?=$row['title']?></td>
                    <td><?=$row['describ']?></td>
                    <td><?=$row['optype']?></td>
                    <td><?=isset($row['opdate'])?date('Y-m-d H:i:s',strtotime($row['opdate'])):'-'?></td>

                    <td><?=$row['name']?></td>
                    <td><?=$row['notes']?></td>



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


    layui.use(['jquery', 'layer'], function () {
        var $ = layui.jquery,
            upload = layui.upload,
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

        <?php if (isset($nav_mold[1])&&$nav_mold[1]==1):?>
        upload.render({
            elem: '#choosefile',
            url: '<?=base_url('mentity/foexport')?>',
            accept: "file",
            exts: 'xls|xlsx',
            auto: false,
            size:2048,
            bindAction: '#startExport'
            ,choose: function(obj){
                //确认框
                obj.preview(function(index, file, result){
                    $("#chose_title").text(file.name);
                });
                layer.alert('提醒：导入操作将导致以前数据失效，点击导入按钮请谨慎！', {icon: 3, title:'提示'})
                $('#startExport').addClass("layui-btn-disabled").attr("disabled",false);
                $('#startExport').removeClass("layui-btn-disabled");
            }
            ,before: function(obj){
                layer.msg('文件导入中...', {
                    icon: 16,
                    shade: 0.01,
                    time: 0
                })

            }
            ,done: function(res){
                layer.close(layer.msg());
                $('#startExport').addClass("layui-btn-disabled").attr("disabled",true);
                $('#startExport').addClass("layui-btn-disabled");

                if (res.code==200){
                    layer.alert(res.msg,function(){
                        location.reload();//刷新页面
                    })
                }else{
                    layer.alert(res.msg,function(){
                        location.reload();//刷新页面
                    })
                }

            }
            ,error: function(){
                layer.alert('导入失败，请联系管理员检查！',function(){
                    location.reload();//刷新页面
                })
            }
        });



        <?php endif;?>

    })
</script>
</body>
</html>
