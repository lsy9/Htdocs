<?php
    // 如果没有开启session，则开启session
    if(!isset($_SESSION)){
        session_start();
    }
    $file = str_replace('\\','/',__FILE__);
    $root = $_SERVER['DOCUMENT_ROOT'];
    $path = str_replace($root, '', $file);
    define('__ADMIN__', dirname($path));
    define('__HOME__', dirname(__ADMIN__));
    $arr = explode('/', ltrim($_SERVER['SCRIPT_NAME'],'/'));
    $proPath = $_SERVER['DOCUMENT_ROOT'].'/'.array_shift($arr);
    define('ROOT_PATH', $proPath);

    // 引入文件
    include(ROOT_PATH."/public/common/config.php");
    // 引入函数库文件
    include(ROOT_PATH.'/public/common/functions.php');
?>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="./index.php" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="<?php echo __ADMIN__; ?>">首页</a></li>
                <li><a href="<?php echo __HOME__ ?>/index.php" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <?php
                    // 显示账户名
                    $sql = "select username,nickname from shop_user where id={$_SESSION['user']['id']}";
                    $result = mysqli_query($link,$sql);
                    if($result && mysqli_num_rows($result)>0){
                        $row = mysqli_fetch_assoc($result);
                        $nickname = $row['nickname'];
                        $username = $row['username'];
                        if(empty($nickname)){
                            echo '<li><a href="#">'.$username.'</a></li>';
                        } else {
                            echo '<li><a href="#">'.$nickname.'</a></li>';
                        }
                    }

                ?>
                <li><a href="#">修改密码</a></li>
                <li><a href="./doaction.php?act=layout">退出</a></li>
            </ul>
        </div>
    </div>
</div>