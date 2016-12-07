<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商品管理|后台管理</title>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="./index.php">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">商品管理</span></div>
        </div>
        <!-- 搜索框 -->
        <div class="search-wrap">
            <div class="search-content">
                <form action="./goods.php" method="get">
                    <table class="search-tab">
                        <tr>
                            <th width="120">选择分类:</th>
                            <td>
                                <select name="search" id="">
                                    <option value="id">ID</option>
                                    <option value="goodsname" selected>商品名</option>
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
        <!-- 商品管理 -->
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <!-- 快捷操作 -->
                <div class="result-title">
                    <div class="result-list">
                        <a href="./goods/add.php"><i class="icon-font"></i>添加商品</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                        <a id="blackList" href="./goods/recycle.php"><i class="icon-font"></i>回收站管理</a>
                    </div>
                </div>
                <div class="result-content">
                    <!-- 商品显示 -->
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%">
                                <input class="allChoose" name="" type="checkbox">
                            </th>
                            <th>商品编号</th>
                            <th>商品图片</th>
                            <th>商品名</th>
                            <th>所属分类</th>
                            <th>价格</th>
                            <th>库存</th>
                            <th>评论数</th>
                            <th>操作</th>
                        </tr>
                        <?php
                            // 设置默认时区
                            date_default_timezone_set("PRC");
                            // 设置模糊搜索
                            $search = isset($_GET['search']) ? $_GET['search'] : '';
                            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

                            // sql条件
                            if(!empty($search) && !empty($keyword)){
                                // 通过商品名搜索是模糊搜索，id搜索是精确搜索
                                switch($search){
                                    case 'goodsname':
                                        $search_where = " and goodsname like '%{$keyword}%'";
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
                            $sql = "select count(id) num from shop_goods where status=1 {$search_where}";
                            $result = mysqli_query($link,$sql);
                            if($result && mysqli_num_rows($result)){
                                $row = mysqli_fetch_assoc($result);
                                $total = $row['num']; // 获取所有商品数量
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

                            // 获取所有商品信息
                            $sql = "select id,tid,goodsname,goodspic,goodsprice,goodsnum from shop_goods where status=1 {$search_where} limit {$pageOffset},{$pageSize}";
                            $result = mysqli_query($link,$sql);
                            if($result && mysqli_num_rows($result)>0){
                                // 循环输出所有商品
                                while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td class="tc">
                                <input name="id[]" value="<?php echo $row['id']; ?>" type="checkbox">
                            </td>
                            <td><?php echo $row['id']; ?></td>
                            <td>
                                <?php if(!empty($row['goodspic'])){?>
                                    <img src="../public/uploads/<?php echo $row['goodspic']?>" alt="" width="30">
                                <?php } else {?>
                                    <img src="../public/images/default.jpg" alt="" width="30">
                                <?php }?>
                            </td>
                            <td>
                                <?php echo $row['goodsname']; ?>
                            </td>
                            <td><?php echo $row['tid']; ?></td>
                            <td><?php echo $row['goodsprice'] ?></td>
                            <td><?php echo $row['goodsnum']; ?></td>
                            <td>
                                <?php
                                    // 查询评论条数
                                    $sql = "select count(id) num from shop_goods_comment where gid={$row['id']}";
                                    $comment_result = mysqli_query($link,$sql);
                                    if($comment_result && mysqli_num_rows($comment_result)>0){
                                        $comment = mysqli_fetch_assoc($comment_result);
                                ?>
                                <a href="./comment.php?search=gid&keywords=<?php echo $row['id']; ?>"><?php echo $comment['num']; ?></a>
                                <?php } ?>
                            </td>
                            <td>
                                <a class="link-update" href="./goods/edit.php?id=<?php echo $row['id'];?>">修改</a>
                                <a class="link-del" href="./goods/doaction.php?act=off&id=<?php echo $row['id']; ?>">下架</a>
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
                        <a href="./goods.php?page=1<?php echo $search_url; ?>">首页</a>
                        <a href="./goods.php?page=<?php echo $pagePrev,$search_url; ?>">上一页</a>
                        <a href="javascript:void(0);" class="current"><?php echo $page; ?></a>
                        <a href="./goods.php?page=<?php echo $pageNext,$search_url; ?>">下一页</a>
                        <a href="./goods.php?page=<?php echo $pageMax,$search_url; ?>">尾页</a>
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