<?php
    // 接收错误信息
    if(isset($_GET['errno']) && !empty($_GET['errno'])){
        $errno = $_GET['errno'];

        // 设置错误信息
        switch ($errno) {
            case 1:
                $userpic = '<i class="require-red">头像上传失败，请重试</i>';
            break;
            case 2:
                $pwd = '<i class="require-red">两次密码不一致</i>';
            break;
            case 3:
                $user = '<i class="require-red">用户名已存在</i>';
            break;
            case 4:
                $email = '<i class="require-red">邮箱已存在</i>';
            break;
        }
    }
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="../public/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/main.css"/>
    <script type="text/javascript" src="../public/js/libs/modernizr.min.js"></script>
</head>
<body>
<!-- 顶部导航 -->
<?php include('../header.php'); ?>
<!-- 主体部分 -->
<div class="container clearfix">
    <!-- 左侧导航菜单 -->
    <?php include('../nav.php'); ?>
    <!--/sidebar-->
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="../index.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="../user.php">用户管理</a><span class="crumb-step">&gt;</span><span>新增用户</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="./doaction.php?act=add" method="post" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                            <tr>
                                <th><i class="require-red">*</i>用户名：</th>
                                <td>
                                    <input class="common-text required" name="username" size="50" value="" type="text">
                                    <?php echo isset($user) ? $user : '';?>
                                </td>
                            </tr>
                            <tr>
                                <th>昵称：</th>
                                <td>
                                    <input class="common-text required" id="title" name="nickname" size="50" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>密码：</th>
                                <td>
                                    <input class="common-text required" id="title" name="userpwd" size="50" value="" type="password">
                                    <?php echo isset($pwd) ? $pwd : '';?>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>确认密码：</th>
                                <td>
                                    <input class="common-text required" id="title" name="userpwd2" size="50" value="" type="password">
                                </td>
                            </tr>
                            <tr>
                                <th width="120"><i class="require-red">*</i>用户级别：</th>
                                <td>
                                    <select name="level"  class="required">
                                        <option value="0">注册会员</option>
                                        <option value="1">管理员</option>
                                        <option value="2">青铜会员</option>
                                        <option value="3">白银会员</option>
                                        <option value="4">黄金会员</option>
                                        <option value="5">钻石会员</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>性别：</th>
                                <td>
                                    <input class="common-text" name="sex" value="1" type="radio"> 男
                                    <input class="common-text" name="sex" value="2" type="radio"> 女
                                    <input class="common-text" name="sex" value="3" type="radio" checked> 保密
                                </td>
                            </tr>
                            <tr>
                                <th>邮箱：</th>
                                <td>
                                    <input class="common-text required" id="title" name="email" size="50" value="" type="text">
                                    <?php echo isset($email) ? $email : '';?>
                                </td>
                            </tr>
                            <tr>
                                <th>头像：</th>
                                <td>
                                    <input name="userpic" type="file">
                                    <?php echo isset($userpic) ? $userpic : '';?>
                                </td>
                            </tr>
                            <tr>
                                <th>金币：</th>
                                <td>
                                    <input class="common-text required" name="gold" size="5" value="30" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                                    <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>