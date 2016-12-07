<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>『豪情』后台管理</title>
    <link rel="stylesheet" type="text/css" href="./public/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="./public/css/main.css"/>
    <script type="text/javascript" src="./public/js/libs/modernizr.min.js"></script>
</head>
<body>
<!-- 顶部导航 -->
<?php include('./header.php'); ?>
<!-- 主体部分 -->
<div class="container clearfix">
    <!-- 左侧导航菜单 -->
    <?php include('./nav.php'); ?>
    <!--/sidebar-->
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="./index.php">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">网站设置</span></div>
        </div>
        <div class="result-wrap">
            <?php
                // 获取网站信息
                $sql = "select * from shop_webconf limit 1";
                $result = mysqli_query($link,$sql);
                if($result && mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
                }
            ?>
            <form action="./system/doaction.php?act=webconf" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="config-items">
                    <div class="config-title">
                        <h1><i class="icon-font">&#xe00a;</i>网站信息设置</h1>
                    </div>
                    <div class="result-content">
                        <table width="100%" class="insert-tab">
                            <tbody>
                                <tr>
                                    <th width="15%"><i class="require-red">*</i>域名：</th>
                                    <td><input type="text" value="<?php echo $row['domain']; ?>" size="85" name="domain" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th><i class="require-red">*</i>网站名称：</th>
                                    <td><input type="text" value="<?php echo $row['webname']; ?>" size="85" name="webname" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th><i class="require-red">*</i>网站LOGO：</th>
                                    <td>
                                        <?php if (empty($row['logo'])){ ?>
                                        <img src="../public/images/logo.png" width="50">
                                        <?php } else { ?>
                                        <img src="../public/images/<?php echo $row['logo']; ?>" width="50">
                                        <?php } ?>
                                        <input type="file" name="logo">
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="require-red">*</i>关键字：</th>
                                    <td><input type="text" value="<?php echo $row['keywords']; ?>" size="85" name="keywords" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th><i class="require-red">*</i>描述：</th>
                                    <td><textarea name="description" class="common-textarea" id="content" cols="30" style="width: 98%;" rows="10"><?php echo $row['description']; ?></textarea></td>
                                </tr>
                                <tr>
                                    <th>开/关网站：</th>
                                    <td>
                                        <input type="radio" name="status" value="1" <?php echo $row['status']==1 ? 'checked' : ''; ?>>开
                                        <input type="radio" name="status" value="0" <?php echo $row['status']==0 ? 'checked' : ''; ?>>关
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <input type="submit" value="提交" class="btn btn-primary btn6 mr10">
                                        <input type="button" value="返回" onclick="history.go(-1)" class="btn btn6">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
            <!-- <form action="./system/doaction.php?act=admin" method="post">
                <div class="config-items">
                    <div class="config-title">
                        <h1><i class="icon-font">&#xe014;</i>站长信息设置</h1>
                    </div>
                    <div class="result-content">
                        <table width="100%" class="insert-tab">
                            <tr>
                                <th width="15%"><i class="require-red">*</i>网站联系邮箱：</th>
                                <td><input type="text" id="" value="jikeytang@163.com" size="85" name="email" class="common-text"></td>
                            </tr>
                                <tr>
                                    <th><i class="require-red">*</i>联系人：</th>
                                    <td><input type="text" id="" value="豪情" size="85" name="contact" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th><i class="require-red">*</i>联系电话：</th>
                                    <td><input type="text" id="" value="123456" size="85" name="phone" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th><i class="require-red">*</i>备案ICP：</th>
                                    <td><input type="text" id="" value="哥在香港" size="85" name="icp" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th><i class="require-red">*</i>地址：</th>
                                    <td><input type="text" id="" value="中国 • 上海" size="85" name="address" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <input type="hidden" value="siteConf.inc.php" name="file">
                                        <input type="submit" value="提交" class="btn btn-primary btn6 mr10">
                                        <input type="button" value="返回" onclick="history.go(-1)" class="btn btn6">
                                    </td>
                                </tr>
                        </table>
                    </div>
                </div>
            </form> -->
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>