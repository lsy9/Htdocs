<?php
    // 引入初始化文件
    include('./public/common/init.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>友情链接</title>
    <link rel="stylesheet" href="./public/css/common.css">
    <link rel="stylesheet" href="./public/css/cart.css">
    <style>
        .links{
            border: 1px solid #ddd;
            overflow: hidden;
        }
        .links .link-list{
            padding-left: 28px;
            float: left;
            /* width: 157px; */
            min-width: 1%;
            /* height: 32px; */
            line-height: 32px;
            border-bottom: 1px dotted #ccc;
            white-space: nowrap;
            overflow: hidden;
        }
        .links .link-list li{
            float: left;
        }
        .links .title{
            height: 30px;
            line-height: 30px;
            background: #f7f7f7;
            padding-left: 10px;
            font-weight: normal;
        }
        .links .intro{
            margin: 10px 0 0 30px;
            float: left;
            width: 500px;
            border-right: 1px dotted #ccc;
            margin-right: 43px;
            padding-bottom: 170px;
        }
        .links .apply input[type='text']{
            width: 245px;
            padding: 6px 1px;
            height: 18px;
            line-height: 18px;
            border: 1px solid #ccc;
            height: 18px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- 顶部区域 -->
    <?php include('./public/common/header.php'); ?>
    <!-- 导航条 -->
    <div class="w100 bdr">
        <div class="wm navbar">
            <?php include('./public/common/navbar.php'); ?>
        </div>
    </div>
    <!-- 主体区域 -->
    <div id="main" class="wm">
        <!-- 全部商品分类 -->
        <?php include('./public/common/navlist.php'); ?>
        <!-- 友情链接展示 -->
        <div class="links">
            <h3 class="title">友情链接</h3>
            <ul class="link-list">
                <?php
                    // 查询友情连接
                    $links = getAll($link,'shop_friendlink','linkname,linkurl','status=1');
                    if($links){
                        foreach ($links as $row) {
                ?>
                <li><a href="<?php echo $row['linkurl']; ?>"><?php echo $row['linkname']; ?></a></li>
                <?php
                        }
                    }
                ?>
            </ul>
        </div>
        <div class="links mt10">
            <h3 class="title">申请友情链接</h3>
            <div class="intro">
                申请步骤：<br>
                    1.请先在贵网站做好京东的文字友情链接： <br>
                    <?php $domain = getOne($link,'shop_webconf','domain','','',1); ?>
                    链接文字：京东链接地址： <a href="<?php echo $domain; ?>"><?php echo $domain; ?></a> <br>
                    2.做好链接后，请在右侧填写申请信息。京东只接受申请文字友情链接。<br>
                    3.已经开通我站友情链接且内容健康，符合本站友情链接要求的网站，经京东管理员审核后，可以显示在此友情链接页面。<br>
                    4.请通过右侧提交申请，注明：友情链接申请。 <br>
            </div>
            <div class="apply">
                <form action="./doaction.php?act=links" method="post">
                    网站名称：<input type="text" name="linkname" id=""><br>
                    网站链接：<input type="text" name="linkurl" id=""> <br>
                    <span style="visibility:hidden">点击提交：</span><input type="submit" value="提交" class="btn btn-danger mt10">
                </form>
            </div>
        </div>
    </div>
    <!-- 底部 -->
    <?php include('./public/common/footer.php'); ?>
</body>
</html>