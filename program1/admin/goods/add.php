<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>添加商品|后台管理</title>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="../index.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="../goods.php">商品管理</a><span class="crumb-step">&gt;</span><span>新增商品</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="./doaction.php?act=add" method="post" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                            <tr>
                                <th><i class="require-red">*</i>商品名称：</th>
                                <td>
                                    <input class="common-text required" name="goodsname" size="50" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th width="120"><i class="require-red">*</i>所属分类：</th>
                                <td>
                                    <select name="tid"  class="required">
                                        <?php
                                            // 获取已添加的分类
                                            $sql = 'select id,typename,path from shop_types order by concat(path,id)';
                                            $result = mysqli_query($link,$sql);
                                            if($result && mysqli_num_rows($result)>0){
                                                while($row = mysqli_fetch_assoc($result)){
                                                    $level = substr_count($row['path'], ',');
                                        ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo str_repeat('--', $level-1),$row['typename'] ?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>商品图片：</th>
                                <td>
                                    <input name="goodspic" type="file">
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>商品价格：</th>
                                <td>
                                    <input class="common-text required" name="goodsprice" size="5" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>库存数量：</th>
                                <td>
                                    <input class="common-text required" name="goodsnum" size="5" value="100" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th>商品描述：</th>
                                <td><textarea name="goodsdes" class="common-textarea" id="content" cols="30" style="width: 98%;" rows="10"></textarea></td>
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