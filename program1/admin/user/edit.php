<?php
    // 接收用户id
    if(!isset($_GET['id']) || empty($_GET['id'])){
        echo '<script>
            alert("id不能为空");
            window.location.href="../user.php";
        </script>';
        exit;
    }
    $id = $_GET['id'];
    date_default_timezone_set("PRC");
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
                <?php
                    // 获取数据
                    $sql = "select u.username,u.nickname,u.userpic,u.level,d.gold,d.sex,d.email,d.regtime,d.lasttime,d.regip from shop_user u,shop_user_details d where u.id = d.uid and u.status=1 and u.id = {$id}";
                    $result = mysqli_query($link,$sql);
                    if($result && mysqli_num_rows($result)>0){
                        $row = mysqli_fetch_assoc($result);
                    }
                ?>
                <form action="./doaction.php?act=edit" method="post" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                            <tr>
                                <th><i class="require-red">*</i>用户名：</th>
                                <td>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input class="common-text required" name="username" size="50" value="<?php echo $row['username']?>" type="text" disabled>
                                </td>
                            </tr>
                            <tr>
                                <th>昵称：</th>
                                <td>
                                    <input class="common-text required" id="title" name="nickname" size="50" value="<?php echo $row['nickname']?>" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th width="120"><i class="require-red">*</i>用户级别：</th>
                                <td>
                                    <select name="level"  class="required">
                                        <option value="0" <?php echo $row['level']==0?'selected':''; ?>>注册会员</option>
                                        <option value="1" <?php echo $row['level']==1?'selected':''; ?>>管理员</option>
                                        <option value="2" <?php echo $row['level']==2?'selected':''; ?>>青铜会员</option>
                                        <option value="3" <?php echo $row['level']==3?'selected':''; ?>>白银会员</option>
                                        <option value="4" <?php echo $row['level']==4?'selected':''; ?>>黄金会员</option>
                                        <option value="5" <?php echo $row['level']==5?'selected':''; ?>>钻石会员</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>性别：</th>
                                <td>
                                    <input class="common-text" name="sex" value="1" type="radio" <?php echo $row['sex']==1?'checked':''; ?>> 男
                                    <input class="common-text" name="sex" value="2" type="radio" <?php echo $row['sex']==2?'checked':''; ?>> 女
                                    <input class="common-text" name="sex" value="3" type="radio" <?php echo $row['sex']==3?'checked':''; ?>> 保密
                                </td>
                            </tr>
                            <tr>
                                <th>邮箱：</th>
                                <td>
                                    <input class="common-text required" id="title" name="email" size="50" value="<?php echo $row['email'] ?>" type="text">
                                    <?php echo isset($email) ? $email : '';?>
                                </td>
                            </tr>
                            <tr>
                                <th>头像：</th>
                                <td>
                                    <?php if(!empty($row['userpic'])){?>
                                        <img src="../../public/uploads/<?php echo $row['userpic']?>" alt="" width="30">
                                    <?php } else {?>
                                        <img src="../../public/images/default.jpg" alt="" width="30">
                                    <?php }?>
                                    <input name="userpic" type="file">
                                    <?php echo isset($userpic) ? $userpic : '';?>
                                </td>
                            </tr>
                            <tr>
                                <th>金币：</th>
                                <td>
                                    <input class="common-text required" name="gold" size="5" value="<?php echo $row['gold']; ?>" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th>注册时间</th>
                                <td><?php echo date('Y-m-d H:i:s',$row['regtime']); ?></td>
                            </tr>
                            <tr>
                                <th>最后登录时间</th>
                                <td><?php echo date('Y-m-d H:i:s',$row['lasttime']); ?></td>
                            </tr>
                            <tr>
                                <th>注册IP</th>
                                <td><?php echo $row['regip']; ?></td>
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