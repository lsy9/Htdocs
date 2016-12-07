<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>添加分类|后台管理</title>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="../index.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="../type.php">分类管理</a><span class="crumb-step">&gt;</span><span>新增分类</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="./doaction.php?act=add" method="post">
                    <table class="insert-tab" width="100%">
                        <tbody>
                            <tr>
                                <th><i class="require-red">*</i>分类名称：</th>
                                <td>
                                    <input class="common-text required" name="typename" size="50" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th width="120"><i class="require-red">*</i>上级分类：</th>
                                <td>
                                    <select name="pid"  class="required">
                                        <option value="0">顶级分类</option>
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