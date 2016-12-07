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
    include('../../public/common/functions.php');

    // 处理用户操作
    switch ($act) {
        case 'webconf': // 修改网站配置
            $id          = $_POST['id'];
            $domain      = htmlspecialchars(trim($_POST['domain']));
            $webname     = htmlspecialchars(trim($_POST['webname']));
            $keywords    = htmlspecialchars(trim($_POST['keywords']));
            $description = htmlspecialchars(trim($_POST['description']));
            $status      = $_POST['status'];
            $logo        = $_FILES['logo'];

            // 判断是否上传了logo
            if($logo['error'] != 4){    // 表名上传了logo
                // 对logo进行上传操作
                $path = '../../public/images/';
                $info = uploadFile($logo,$path,array());
                if($info['isok']){
                    $filename = $info['message'];
                    // 获取文件后缀名
                    $suffix   = pathinfo($filename,PATHINFO_EXTENSION);
                    // 改名
                    rename($path.$filename,$path.'logo.'.$suffix);
                    $newname  = 'logo.'.$suffix;
                    // 设置sql条件
                    $newlogo  = ",logo='{$newname}'";
                } else {
                    echo '<script>
                        alert("LOGO上传失败！请重试");
                        window.location.href="../system.php";
                    </script>';
                    exit;
                }
            } else {
                $newlogo = "";
            }

            // 更新网站信息
            $sql = "update shop_webconf set domain='{$domain}',webname='{$webname}',keywords='{$keywords}',description='{$description}',status={$status}{$newlogo} where id={$id}";
            $result = mysqli_query($link,$sql);
            if($result){
                // 生成网站配置文件
                $config = <<<CONFIG
<?php
    header("Content-type:text/html;charset=utf-8");
    define('WEBSITE_STATUS',$status);
CONFIG;
                // 写入文件
                file_put_contents('../../public/common/webconf.php', $config);

                // 提示信息
                echo '<script>
                    alert("更新网站信息成功");
                    window.location.href="../system.php";
                </script>';
            } else {
                echo '<script>
                    alert("更新网站信息失败");
                    window.location.href="../system.php";
                </script>';
            }
        break;
    }