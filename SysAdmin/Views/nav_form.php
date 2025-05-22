<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>栏目信息</title>
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/font-awesome-4.7.0/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/wangEditor/css/style.css')?>">

    <!--    <link rel="stylesheet" href="--><?//=base_url('statics/css/css.css')?><!--">-->
    <style>
        .layui-form-select dl{
            z-index: 1000;
        }
        #demo1{
            max-width: 200px;
        }
        #link_url{
            display:none;
        }
    </style>
</head>

<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <div class="layui-row clearfix">
            <form class="layui-form" id="cateForm" method="post" >
                <div class="layui-form-item">
                    <label class="layui-form-label">栏目名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="label" lay-verify="required" class="layui-input" value="<?=isset($list['label'])?$list['label']:''?>" placeholder="请输入栏目名称">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">栏目缩略图</label>
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

                <div class="layui-form-item">
                    <label  for="sort_order" class="layui-form-label">栏目排序</label>
                    <div class="layui-input-inline">
                        <input type="text" name="sort_order"  min="0" max="999"  value="<?=isset($list['sort_order'])?$list['sort_order']:'0'?>" lay-verify="required" class="layui-input"/>

                    </div>
                    <div class="layui-form-mid layui-word-aux">排序数字范围0-999，数字越大排序越前！</div>
                </div>

                <div class="layui-form-item">
                    <label for="pid"  class="layui-form-label">上级栏目</label>
                    <div class="layui-input-inline">

                        <select name="pid" class="form-control">
                            <?php $clevelf=isset($clevel)?$clevel:0?>
                            <?php if ($clevelf==2):?><!--	已有两个子栏目							-->
                            <option  value="0">-----------</option>
                        <?php else:?><!--	已有两个子栏目							-->
                            <!--                        --><?//=dd($list)?>
                        <?php $pid=isset($list['pid'])?$list['pid']:"0"?>
                            <option <?php if (isset($_GET['id'])&&$_GET['id']==0):?>selected<?php endif;?> value="0">-----------</option>
                        <?php foreach($cat_list as $row): ?>
                            <?php if($row['pid']==0): ?><!--    输出一级栏目                        -->
                                <?php if ($row['id']!=(isset($_GET['id'])?$_GET['id']:0)):?>
                                    <option value="<?=$row['id']?>" <?php if($row['id']==$pid):?> selected <?php endif;?>><?=$row['label']?></option>
                                    <?php if ($clevelf==0):?>
                                        <?php foreach($cat_list as $row2): ?>
                                            <?php if($row2['pid']==$row['id']): ?><!--    输出二级栏目                        -->
                                                <?php if ($row2['id']!=(isset($_GET['id'])?$_GET['id']:0)):?>
                                                    <option value="<?=$row2['id']?>" <?php if($row2['id']==$pid):?> selected <?php endif;?>>|--<?=$row2['label']?></option>
                                                <?php endif;?>
                                            <?php endif;?>
                                        <?php endforeach; ?>
                                    <?php endif;?>
                                <?php endif;?>
                            <?php endif;?>
                        <?php endforeach; ?>

                        <?php endif;?>



                        </select>
                    </div>
                    <div class="layui-form-mid layui-word-aux">支持最多二级栏目！</div>
                </div>
                <div class="layui-form-item">
                    <label for="n_type"  class="layui-form-label">栏目类型</label>
                    <div class="layui-input-inline">
                        <select name="n_type"  lay-filter="n_type" >
                            <?php foreach (hp_cate_type() as $value): ?>
                                <option value="<?=$value["id"]?>" <?php if(isset($list)&&$list["n_type"]==$value["id"]): ?>selected<?php endif; ?>><?=$value["text"]?></option>
                            <?php endforeach ?>
                        </select>
                        <!--						<span class="help-block m-b-none"><i class="fa fa-info-circle"></i>注意！</span>-->
                    </div>
                </div>
                <input type="hidden" name="is_show" value="<?=isset($list['status'])?$list['status']:"1"?>">
                <div class="layui-form-item" id="link_url">
                    <label  for="link_url" class="layui-form-label">栏目超链接</label>
                    <div class="layui-input-block">
                        <input type="text"  name="link_url"   value="<?=isset($list['link_url'])?$list['link_url']:''?>" class="layui-input"
                               pattern="/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/"
                               placeholder="网页跳转超链接，样式如下：！"
                        />

                    </div>
                </div>

                <div class="layui-form-item">
                    <label  for="target" class="layui-form-label">打开方式</label>
                    <div class="layui-input-block">
                        <input type="text"  name="target"   value="<?=isset($list['target'])?$list['target']:''?>" class="layui-input"
                               placeholder="在新标签页中打开则填写_blank,否则可不做填写！"
                        />

                    </div>
                </div>
                <div class="layui-form-item" id="n_type" style="display: none;">
                    <label for="myEditor"  class="layui-form-label">单页面内容</label>
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
                    <label for="cat_type"  class="layui-form-label">栏目状态</label>
                    <div class="layui-input-inline">
                        <select name="status"  lay-filter="status" >
                            <?php foreach (hp_status() as $value): ?>
                                <option value="<?=$value["id"]?>" <?php if(isset($list)&&$list["status"]==$value["id"]): ?>selected<?php endif; ?>><?=$value["text"]?></option>
                            <?php endforeach ?>
                        </select>
                        <!--						<span class="help-block m-b-none"><i class="fa fa-info-circle"></i>注意！</span>-->
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


    <script src="<?=base_url('statics/plugins/layuimini/lib/layui/layui.js')?>"></script>
    <script src="<?=base_url('statics/plugins/layuimini/js/lay-config.js')?>"></script>
    <!--<script type="text/javascript" charset="utf-8" src="--><?//=base_url('statics/plugins/ueditor/ueditor.config.js')?><!--"></script>-->
    <!--<script type="text/javascript" charset="utf-8" src="--><?//=base_url('statics/plugins/ueditor/ueditor.all.min.js')?><!--"> </script>-->
    <!--<script type="text/javascript" src="--><?//=base_url('statics/plugins/ueditor/lang/zh-cn/zh-cn.js')?><!--"></script>-->
    <script src="<?=base_url('statics/plugins/wangEditor/index.js')?>"></script>

    <script>
        layui.use(['layer', 'jquery', 'form','upload'], function () {
            var layer = layui.layer,
                $ = layui.jquery,
                form = layui.form,
                upload = layui.upload;
            myeditor=0;
            html='';
            var n_type=<?=isset($list["n_type"])?$list["n_type"]:0?>;
            if (n_type==3){
                myeditor=1;
                $("#n_type").show();
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
                    server: '<?=site_url('xccmssys/upLoad/editorImg')?>',
                    timeout: 5 * 1000, // 5s
                    fieldName: 'file',
                    allowedFileTypes: ['image/*'],
                    // meta: { token: 'xxx', a: 100 },
                    metaWithUrl: false, // join params to url
                    headers: { Accept: 'text/x-json' },
                    maxFileSize: 10 * 1024 * 1024, // 10M
                    base64LimitSize: 5 * 1024, // insert base64 format, if file's size less than 5kb
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

            }
            else if (n_type==5){
                $("#link_url").show();
            }
            form.on('select(n_type)', function(data){
                if(data.value == 3&&myeditor==0){
                    $("#n_type").show();
                    myeditor=1;
                    const { createEditor, createToolbar } = window.wangEditor;
                    const editorConfig = {
                        placeholder: 'Type here...',
                        MENU_CONF: {},
                        onChange(editor) {
                            html = editor.getHtml()
                            // console.log('editor content', html)
                            // 也可以同步到 <textarea>
                        }
                    }

                    editorConfig.MENU_CONF['uploadImage'] = {
                        server: '<?=site_url('xccmssys/upLoad/editorImg')?>',
                        timeout: 5 * 1000, // 5s
                        fieldName: 'file',
                        allowedFileTypes: ['image/*'],
                        // meta: { token: 'xxx', a: 100 },
                        metaWithUrl: false, // join params to url
                        headers: { Accept: 'text/x-json' },
                        maxFileSize: 10 * 1024 * 1024, // 10M
                        base64LimitSize: 5 * 1024, // insert base64 format, if file's size less than 5kb
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

                }else{
                    if(data.value == 5){
                        $("#link_url").show();
                    }else{
                        $("#link_url").hide();
                    }
                    $("#n_type").hide();
                }
            });

            var uploadInst = upload.render({
                elem: '#test1'
                ,acceptMime: 'image/*'
                ,url: '<?=site_url('xccmssys/upLoad/upLoadCatImg')?>' //改成您自己的上传接口
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
                        if (html){
                            data.field.editorValue=html;
                        }
                        $.post("<?=site_url('xccmssys/nav/eform')?>",data.field,function(res){
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
