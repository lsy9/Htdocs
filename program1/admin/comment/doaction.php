<?php
    // 开启session
    session_start();
    // 设置页面字符集
    header("Content-type:text/html;charset=utf-8");
    // 接收用户操作
    $act = $_GET['act'];

    // 设置默认时区
    date_default_timezone_set("PRC");
    // 引入数据库配置文件
    include('../../public/common/config.php');

    // 处理用户操作
    switch ($act) {
        case 'hidden':
            // 接收id
            $id = $_GET['id'];
            // 将状态改为0
            $sql = "update shop_goods_comment set status=0 where id={$id}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                echo '<script>
                    alert("评论已隐藏");
                    window.location.href="../comment.php";
                </script>';
            } else {
                echo '<script>
                    alert("操作失败！请重试");
                    window.location.href="../comment.php";
                </script>';
            }
        break;
        case 'show':
            // 接收id
            $id = $_GET['id'];
            // 将状态改为0
            $sql = "update shop_goods_comment set status=1 where id={$id}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                echo '<script>
                    alert("评论开启成功");
                    window.location.href="./hidden.php";
                </script>';
            } else {
                echo '<script>
                    alert("操作失败！请重试");
                    window.location.href="./hidden.php";
                </script>';
            }
        break;
    }