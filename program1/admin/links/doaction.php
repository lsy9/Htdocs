<?php
    // 开启session
    session_start();
    // 设置页面字符集
    header("Content-type:text/html;Charset=utf-8");
    // 引入数据库连接配置
    include('../../public/common/config.php');
    // 接收用户操作
    $act = $_GET['act'];

    // 设置默认时区
    date_default_timezone_set('PRC');

    // 处理用户操作
    switch($act){
        case 'show':    // 审核友情链接
            $id = $_GET['id'];
            $sql = "update shop_friendlink set status=1 where id={$id}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                echo '<script>
                    alert("审核通过");
                    window.location.href="../links.php";
                </script>';
                exit;
            } else {
                echo '<script>
                    alert("操作失败，请重试");
                    window.location.href="../links.php";
                </script>';
                exit;
            }
        break;
        case 'del': // 删除申请
            $id = $_GET['id'];
            $sql = "delete from shop_friendlink where id={$id}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                echo '<script>
                    alert("删除成功");
                    window.location.href="../links.php";
                </script>';
                exit;
            } else {
                echo '<script>
                    alert("删除失败，请重试");
                    window.location.href="../links.php";
                </script>';
                exit;
            }
        break;
        case 'hidden':
            $id = $_GET['id'];
            $sql = "update shop_friendlink set status=0 where id={$id}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                echo '<script>
                    alert("取消审核成功");
                    window.location.href="./show.php";
                </script>';
                exit;
            } else {
                echo '<script>
                    alert("操作失败，请重试");
                    window.location.href="./show.php";
                </script>';
                exit;
            }
        break;
    }