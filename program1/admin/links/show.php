<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>友情连接管理|后台管理</title>
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
        <!-- 当前位置 -->
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="../index.php">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">友情链接管理</span></div>
        </div>
        <!-- 搜索框 -->
        <div class="search-wrap">
            <div class="search-content">
                <form action="./show.php" method="get">
                    <table class="search-tab">
                        <tr>
                            <th width="120">选择友链:</th>
                            <td>
                                <select name="search" id="">
                                    <option value="linkname">网站名称</option>
                                    <option value="linkurl">网站连接</option>
                                </select>
                            </td>
                            <th width="70">关键字:</th>
                            <td><input class="common-text" placeholder="关键字" name="keyword" type="text"></td>
                            <td><input class="btn btn-primary btn2" value="搜索" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <!-- 订单管理 -->
        <div class="result-wrap">
            <form method="post">
                <!-- 快捷操作 -->
                <div class="result-title">
                    <div class="result-list">
                        <a href="../links.php"><i class="icon-font"></i>未审核链接</a>
                    </div>
                </div>
                <div class="result-content">
                    <!-- 订单显示 -->
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%">
                                <input class="allChoose" name="" type="checkbox">
                            </th>
                            <th>ID</th>
                            <th>网站名称</th>
                            <th>网站URL</th>
                            <th>操作</th>
                        </tr>
                        <?php
                            // 设置模糊搜索
                            $search = isset($_GET['search']) ? $_GET['search'] : '';
                            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

                            // sql条件
                            if(!empty($search) && !empty($keyword)){
                                // 通过订单名搜索是模糊搜索，id搜索是精确搜索
                                switch($search){
                                    case 'linkname':
                                        $search_where = " and linkname like '%{$keyword}%'";
                                    break;
                                    case 'linkurl':
                                        $search_where = " and linkurl like '%{$keyword}%'";
                                    break;
                                }
                                $search_url = "&search={$search}&keyword={$keyword}";
                            } else {
                                $search_where = '';
                                $search_url = '';
                            }

                            // 设置分页
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $pageSize = 6;  // 每页显示条数
                            $pageOffset = ($page-1)*$pageSize;  // 偏移

                            // 设置分页连接
                            $sql = "select count(id) num from shop_friendlink where status=1{$search_where}";
                            $result = mysqli_query($link,$sql);
                            if($result && mysqli_num_rows($result)>0){
                                $row = mysqli_fetch_assoc($result);
                                $total = $row['num']; // 获取所有订单数量
                            }

                            $pageMax = ceil($total/$pageSize);    // 最大页数

                            // 设置上一页下一页
                            if($page == 1){
                                $pagePrev = 1;
                            } else {
                                $pagePrev = $page-1;
                            }

                            if($page == $pageMax){
                                $pageNext = $pageMax;
                            } else {
                                $pageNext = $page + 1;
                            }

                            // 获取所有未审核信息
                            $sql = "select * from shop_friendlink where status=1{$search_where} order by id desc limit {$pageOffset},{$pageSize}";
                            $result = mysqli_query($link,$sql);
                            if($result && mysqli_num_rows($result)>0){
                                // 循环输出所有
                                while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td class="tc">
                                <input name="id[]" value="<?php echo $row['id']; ?>" type="checkbox">
                            </td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['linkname']; ?></td>
                            <td><?php echo $row['linkurl']; ?></td>
                            <td>
                                <a class="link-update" href="./doaction.php?act=hidden&id=<?php echo $row['id'];?>">取消审核</a>
                                <a class="link-del" href="./doaction.php?act=del&id=<?php echo $row['id']; ?>">删除</a>
                            </td>
                        </tr>
                        <?php
                                }
                            } else {
                                echo '<tr><td align="center" colspan="11" style="color:red;">查无数据</td></tr>';
                            }
                        ?>
                    </table>
                    <!-- 分页 -->
                    <?php if($total!=0){ ?>
                    <div class="list-page"> 
                        <?php echo $total.'条 ' . $page . '/' . $pageMax . '页'; ?>
                        <a href="./links.php?page=1<?php echo $search_url; ?>">首页</a>
                        <a href="./links.php?page=<?php echo $pagePrev,$search_url; ?>">上一页</a>
                        <a href="javascript:void(0);" class="current"><?php echo $page; ?></a>
                        <a href="./links.php?page=<?php echo $pageNext,$search_url; ?>">下一页</a>
                        <a href="./links.php?page=<?php echo $pageMax,$search_url; ?>">尾页</a>
                    </div>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>