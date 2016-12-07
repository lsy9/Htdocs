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
        <!-- 当前位置 -->
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="../index.php">首页</a><span class="crumb-step">&gt;</span><a href="../user.php">用户管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">黑名单管理</span></div>
        </div>
        <!-- 搜索框 -->
        <div class="search-wrap">
            <div class="search-content">
                <form action="./blacklist.php" method="get">
                    <table class="search-tab">
                        <tr>
                            <th width="120">选择分类:</th>
                            <td>
                                <select name="search" id="">
                                    <option value="id">ID</option>
                                    <option value="username" selected>用户名</option>
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
        <!-- 用户管理 -->
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <!-- 快捷操作 -->
                <div class="result-title">
                    <div class="result-list">
                        <a href="./add.php"><i class="icon-font"></i>添加用户</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                        <a id="userList" href="../user.php"><i class="icon-font"></i>用户列表</a>
                    </div>
                </div>
                <div class="result-content">
                    <!-- 用户显示 -->
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%">
                                <input class="allChoose" name="" type="checkbox">
                            </th>
                            <th>ID</th>
                            <th>头像</th>
                            <th>用户名</th>
                            <th>昵称</th>
                            <th>等级</th>
                            <th>金币</th>
                            <th>性别</th>
                            <th>邮箱</th>
                            <th>最后登录时间</th>
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
                                // 通过用户名搜索是模糊搜索，id搜索是精确搜索
                                switch($search){
                                    case 'username':
                                        $search_where = " and u.username like '%{$keyword}%'";
                                    break;
                                    case 'id':
                                        $search_where = " and u.id={$keyword}";
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
                            $sql = "select count(u.id) num from shop_user u,shop_user_details d where u.id=d.uid{$search_where} and u.status=0";
                            $result = mysqli_query($link,$sql);
                            if($result && mysqli_num_rows($result)){
                                $row = mysqli_fetch_assoc($result);
                                $total = $row['num']; // 获取所有用户数量
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

                            // 获取所有用户信息
                            $sql = "select u.id,u.username,u.nickname,u.userpic,u.level,d.gold,d.sex,d.email,d.lasttime from shop_user u,shop_user_details d where u.id=d.uid{$search_where} and u.status=0 limit {$pageOffset},{$pageSize}";
                            $result = mysqli_query($link,$sql);
                            if($result && mysqli_num_rows($result)>0){
                                // 循环输出所有用户
                                while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td class="tc">
                                <input name="id[]" value="<?php echo $row['id']; ?>" type="checkbox">
                            </td>
                            <td><?php echo $row['id']; ?></td>
                            <td>
                                <?php if(!empty($row['userpic'])){?>
                                    <img src="../../public/uploads/<?php echo $row['userpic']?>" alt="" width="30">
                                <?php } else {?>
                                    <img src="../../public/images/default.jpg" alt="" width="30">
                                <?php }?>
                            </td>
                            <td>
                                <?php echo $row['username']; ?>
                            </td>
                            <td><?php echo $row['nickname']; ?></td>
                            <td><?php echo getLevel($row['level']); ?></td>
                            <td><?php echo $row['gold']; ?></td>
                            <td><?php echo getSex($row['sex']); ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo date('Y-m-d H:i:s',$row['lasttime']); ?></td>
                            <td>
                                <!-- <a class="link-update" href="#">修改</a> -->
                                <a class="link-del" href="./doaction.php?act=open&id=<?php echo $row['id']; ?>">启用</a>
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
                        <a href="./blacklist.php?page=1<?php echo $search_url; ?>">首页</a>
                        <a href="./blacklist.php?page=<?php echo $pagePrev,$search_url; ?>">上一页</a>
                        <a href="javascript:void(0);" class="current"><?php echo $page; ?></a>
                        <a href="./blacklist.php?page=<?php echo $pageNext,$search_url; ?>">下一页</a>
                        <a href="./blacklist.php?page=<?php echo $pageMax,$search_url; ?>">尾页</a>
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