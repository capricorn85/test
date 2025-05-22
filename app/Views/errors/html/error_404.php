<!-- App\Views\errors\custom_404.php -->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - 页面未找到</title>
    <!-- 引入 Layui 样式 -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('statics/layui/css/layui.css')?>">
    <style>
        body {
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .error-container {
            text-align: center;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .error-code {
            font-size: 80px;
            font-weight: bold;
            color: #ff5722;
            margin-bottom: 20px;
        }
        .error-message {
            font-size: 20px;
            color: #333;
            margin-bottom: 30px;
        }
        .error-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1E9FFF;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .error-btn:hover {
            background-color: #007BFF;
        }
    </style>
</head>
<body>
<div class="error-container">
    <div class="error-code">404</div>
    <div class="error-message">抱歉，您访问的页面不存在。</div>
    <a href="/" class="error-btn">返回首页</a>
</div>

<!-- 引入 Layui 脚本 -->
<script src="<?=base_url('statics/layui/layui.js')?>"></script>
</body>
</html>