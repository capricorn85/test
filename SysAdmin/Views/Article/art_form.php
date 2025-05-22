<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>文章信息</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/font-awesome-4.7.0/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/wangEditor/css/style.css')?>">
    <style>
        .layui-form-select dl{
            z-index: 1000;
        }
        #demo1{
            max-width: 200px;
        }
    </style>
</head>

<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <div class="layui-row clearfix">
            <form class="layui-form" id="articleForm" method="post" >
                <div class="layui-form-item">
                    <label for="nav_id"  class="layui-form-label">所属栏目</label>
                    <div class="layui-input-inline">
                        <select name="nav_id"  required class="form-control">
                            <?php if ($cat_list):?>
                                <?php foreach($cat_list as $row): ?>
                                    <option value="<?=$row['id']?>"  <?=isset($_GET['id'])?(($row['id']==$_GET['id'])?'selected':''):''?>><?=$row['label']?></option>
                                <?php endforeach; ?>
                            <?php else:?>
                            <option value="">无可选栏目，请添加！</option>
                            <?php endif;?>
                        </select>
                    </div>
                    <div class="layui-form-mid layui-word-aux">仅可选择文章类栏目！</div>

                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">文章标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="article_title" lay-verify="required" class="layui-input" value="<?=isset($list['article_title'])?$list['article_title']:''?>" placeholder="请输入文章标题">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">作者</label>
                    <div class="layui-input-inline">
                        <input type="text" name="author" lay-verify="required" class="layui-input" value="<?=isset($list['author'])?$list['author']:$_SESSION['admin']['nickname']?>" placeholder="请输入作者">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">发布日期</label>
                    <div class="layui-input-inline">
                        <input type="text" name="atime" id="date1" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <?php if (isset($a_type)&&$a_type==1):?>
                    <div class="layui-form-item">
                        <label class="layui-form-label">文章缩略图</label>
                        <div class="layui-input-inline">
                            <div class="layui-upload">
                                <button type="button" class="layui-btn" id="test1">选择图片</button>
                                <div class="layui-upload-list">
                                    <img class="layui-upload-img" id="demo1" <?=empty($list['thumb'])?'':'src="'.base_url($list['thumb']).'"'?>>
                                    <p id="demoText"></p>
                                </div>
                                <input type="hidden" class="imgUrl" name="thumb" id='imgUrl'   value="<?=isset($list['thumb'])?$list['thumb']:''?>" />
                            </div>
                        </div>
                        <div class="layui-form-mid layui-word-aux">缩略图图片建议尺寸：160px*100px或16:10比例图片，jpg、png格式！</div>

                    </div>
                <?php endif;?>
                <div class="layui-form-item">
                    <label  for="sort_order" class="layui-form-label">文章排序</label>
                    <div class="layui-input-inline">
                        <input type="text" name="sort_order"  min="0" max="999"  value="<?=isset($list['sort_order'])?$list['sort_order']:'0'?>" lay-verify="required" class="layui-input"/>

                    </div>

                    <div class="layui-form-mid layui-word-aux">排序数字范围0-999，数字越大排序越前！</div>
                </div>



                <div class="layui-form-item">
                    <label for="cat_type"  class="layui-form-label">是否显示</label>
                    <div class="layui-input-inline">
                        <select name="is_show"  lay-filter="is_show" >
                            <?php foreach (hp_show() as $value): ?>
                                <option value="<?=$value["id"]?>" <?php if(isset($list)&&$list["is_show"]==$value["id"]): ?>selected<?php endif; ?>><?=$value["text"]?></option>
                            <?php endforeach ?>
                        </select>
                        <!--						<span class="help-block m-b-none"><i class="fa fa-info-circle"></i>注意！</span>-->
                    </div>
                </div>
                <!--            <input type="hidden" name="is_show" value="--><?//=isset($list['is_show'])?$list['is_show']:"1"?><!--">-->


                <div class="layui-form-item" id="cat_type" >
                    <label for="myEditor"  class="layui-form-label">文章详情</label>
                    <div class="layui-input-block">
                        <!--            <div id="editor" style="margin: 50px 0 50px 0">-->
                        <!--                --><?//=isset($list['content'])?$list['content']:''?>
                        <!--            </div>-->
                        <div id="editor—wrapper" >
                            <div id="toolbar-container"><!-- 工具栏 --></div>
                            <div id="editor-container"><!-- 编辑器 --></div>
                        </div>
                    </div>
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
<script src="<?=base_url('statics/plugins/layuimini/js/lay-config.js')?>"></script>
<script src="<?=base_url('statics/plugins/wangEditor/index.js')?>"></script>



<script>
    layui.use(['layer', 'jquery', 'form','upload'], function () {
        var layer = layui.layer,
            $ = layui.jquery,
            form = layui.form
            ,upload = layui.upload
            , laydate = layui.laydate;

        //日期
        laydate.render({
            elem: '#date1'
            ,type: 'date'
            ,value: "<?=isset($list['atime'])?date("Y-m-d",strtotime($list['atime'])):date("Y-m-d")?>"
        });
        //日期
        //laydate.render({
        //    elem: '#date2'
        //    ,type: 'date'
        //    ,value: "<?//=isset($list['issue_date'])?$list['issue_date']:date("Y-m-d")?>//"
        //});
        cat_type=<?=isset($list["cat_type"])?$list["cat_type"]:0?>;

        html='';
        ////wangeditor
        const { createEditor, createToolbar } = window.wangEditor;
        const editorConfig = {
            placeholder: '请输入',
            MENU_CONF: {},
            onChange(editor) {
                html = editor.getHtml()
                // console.log('editor content', html)
                // 也可以同步到 <textarea>
            }
        }

        editorConfig.MENU_CONF['uploadImage'] = {
            server: '<?=site_url('xccmssys/upLoad/articleImg')?>',
            timeout: 5 * 1000, // 5s
            fieldName: 'file',
            allowedFileTypes: ['image/*'],
            // meta: { token: 'xxx', a: 100 },
            metaWithUrl: false, // join params to url
            headers: { Accept: 'text/x-json' },
            maxFileSize: 10 * 1024 * 1024, // 10M
            base64LimitSize: 5 * 1024, // insert base64 format, if file's size less than 5kb
            onBeforeUpload(file) {
                // console.log('onBeforeUpload', file)
                return file // will upload this file
                // return false // prevent upload
            },
            onProgress(progress) {
                console.log('onProgress', progress)
            },
            onSuccess(file, res) {
                console.log('onSuccess---', file, res)
            },
            onFailed(file, res) {
                console.log('onFailed---', file, res)
            },
            onError(file, err, res) {
                console.error('onError---', file, err, res)
            },

            customInsert(res, insertFn) {
                // console.log('customInsert', res)
                const imgInfo = res.data || {}
                const { url, alt, href } = imgInfo
                if (!url) throw new Error(`Image url is empty`)

                // console.log('Your image url ', url)
                insertFn(url, alt, href)
            },
        }

        const editor = createEditor({
            selector: '#editor-container',
            html:'<?=isset($list['content'])?$list['content']:''?>',
            config: editorConfig,
            mode: 'default', // or 'simple'
        })
        const toolbarConfig = {}
        const toolbar = createToolbar({
            editor,
            selector: '#toolbar-container',
            config: toolbarConfig,
            mode: 'default', // or 'simple'

        })


        <?php if (isset($a_type)&&$a_type==1):?>
        eurl="<?=site_url('xccmssys/imgArticle/eform')?>";

        var uploadInst = upload.render({
            elem: '#test1'
            ,acceptMime: 'image/*'
            ,url: '<?=site_url('xccmssys/upLoad/upLoadImg')?>' //改成您自己的上传接口
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                if(res.code = 200){
                    $("#imgUrl").val(res.imgurl);
                    // console.log(res.imgurl)
                    $('#demo1').attr('src', '<?=base_url()?>/'+res.imgurl); //图片链接（base64）
                    return layer.msg(res.msg);
                }
                else{
                    return layer.msg(res.msg);
                }
                //上传成功
            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            },
        });

        <?php else:?>
        eurl="<?=site_url('xccmssys/Article/eform')?>";
        <?php endif;?>
        // form.verify({
        //
        // });
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
                    data.field.id=<?=isset($_GET['id'])?$_GET['id']:'0'?>;
                    data.field.content=html;

                    $.post(eurl,data.field,function(res){
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
