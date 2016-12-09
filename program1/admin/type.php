<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>分类管理|后台管理</title>
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
        <!-- 当前位置 -->
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="../index.php">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">分类管理</span></div>
        </div>
        <!-- 搜索框 -->
        <div class="search-wrap">
            <div class="search-content">
                <form action="./type.php" method="get">
                    <table class="search-tab">
                        <tr>
                            <th width="120">选择分类:</th>
                            <td>
                                <select name="search" id="">
                                    <option value="id">ID</option>
                                    <option value="typename" selected>分类名称</option>
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
        <!-- 分类管理 -->
        <div class="result-wrap">
            <form method="post">
                <!-- 快捷操作 -->
                <div class="result-title">
                    <div class="result-list">
                        <a href="./type/add.php"><i class="icon-font"></i>添加分类</a>
                        <a href="./type/recycle.php"><i class="icon-font"></i>禁用分类</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                    </div>
                </div>
                <div class="result-content">
                    <!-- 分类显示 -->
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%">
                                <input class="allChoose" name="" type="checkbox">
                            </th>
                            <th>ID</th>
                            <th>分类名称</th>
                            <th>上级分类id</th>
                            <th>路径</th>
                            <th>操作</th>
                        </tr>
                        <?php
                            // 设置模糊搜索
                            $search = isset($_GET['search']) ? $_GET['search'] : '';
                            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

                            // sql条件
                            if(!empty($search) && !empty($keyword)){
                                // 通过分类名搜索是模糊搜索，id搜索是精确搜索
                                switch($search){
                                    case 'typename':
                                        $search_where = " and typename like '%{$keyword}%'";
                                    break;
                                    case 'id':
                                        $search_where = " and id={$keyword}";
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
                            $sql = "select count(id) num from shop_types where status=1 {$search_where}";
                            $result = mysqli_query($link,$sql);
                            if($result && mysqli_num_rows($result)>0){
                                $row = mysqli_fetch_assoc($result);
                                $total = $row['num']; // 获取所有分类数量
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

                            // 获取所有分类信息
                            $sql = "select * from shop_types where status=1 {$search_where} order by concat(path,id) limit {$pageOffset},{$pageSize}";
                            $result = mysqli_query($link,$sql);
                            if($result && mysqli_num_rows($result)>0){
                                // 循环输出所有分类
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // 统计分类等级
                                    $level = substr_count($row['path'], ',');
                        ?>
                        <tr>
                            <td class="tc">
                                <input name="id[]" value="<?php echo $row['id']; ?>" type="checkbox">
                            </td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo str_repeat('--',$level-1),$row['typename']; ?></td>
                            <td><?php echo $row['pid']; ?></td>
                            <td><?php echo $row['path']; ?></td>
                            <td>
                                <a class="link-update" href="./type/edit.php?id=<?php echo $row['id'];?>">修改</a>
                                <a class="link-del" href="./type/doaction.php?act=hidden&id=<?php echo $row['id']; ?>">禁用</a>
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
                        <a href="./type.php?page=1<?php echo $search_url; ?>">首页</a>
                        <a href="./type.php?page=<?php echo $pagePrev,$search_url; ?>">上一页</a>
                        <a href="javascript:void(0);" class="current"><?php echo $page; ?></a>
                        <a href="./type.php?page=<?php echo $pageNext,$search_url; ?>">下一页</a>
                        <a href="./type.php?page=<?php echo $pageMax,$search_url; ?>">尾页</a>
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