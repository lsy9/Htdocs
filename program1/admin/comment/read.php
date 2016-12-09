<?php
    // 接收商品id
    if(!isset($_GET['id']) || empty($_GET['id'])){
        echo '<script>
            alert("id不能为空");
            window.location.href="../comment.php";
        </script>';
        exit;
    }
    $id = $_GET['id'];
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>查看评论|后台管理</title>
    <link rel="stylesheet" type="text/css" href="../public/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/main.css"/>
    <script type="text/javascript" src="../public/js/libs/modernizr.min.js"></script>
    <style type="text/css" media="screen">
        table th{width: 20%;}
    </style>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="../index.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="../comment.php">评论管理</a><span class="crumb-step">&gt;</span><span>查看评论</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <?php
                    $sql = "select c.content,u.username,g.goodsname from shop_goods_comment c,shop_goods g,shop_user u where c.gid=g.id and c.uid=u.id and c.id={$id}";
                    $result = mysqli_query($link,$sql);
                    $row = mysqli_fetch_assoc($result);
                ?>
                <table class="insert-tab" width="100%">
                    <tbody>
                        <tr>
                            <th>商品名称：</th>
                            <td>
                                <?php echo $row['goodsname']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>用户名：</th>
                            <td>
                                <?php echo $row['username']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>用户评价：</th>
                            <td>
                                <?php echo $row['content']; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>