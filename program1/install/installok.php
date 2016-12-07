<?php
    // 执行安装操作
    // 设置默认字符集
    header("Content-type:text/html;charset=utf-8");
    // 设置默认时区
    date_default_timezone_set("PRC");

    $userpwd1 = htmlspecialchars(trim($_POST['userpwd1']));
    $userpwd2 = htmlspecialchars(trim($_POST['userpwd2']));

    // 先验证两次密码是否输入一致
    if($userpwd1 == $userpwd2){
        $userpwd = md5($userpwd1);
    } else {
        echo '<script>
            alert("两次密码不一致");
            window.location.href="./install3.php";
        </script>';
        exit;
    }

    // 先接受表单传递的数据库配置，写入到配置文件中
    $config = "<?php\n";

    // 循环接收表单数据
    foreach ($_POST as $key => $value) {
        if($key == 'username'){
            break;
        }
        $config .= "define('{$key}','{$value}');\n";
    }

    // 写入连接数据库配置
    $config .= "\$link = @mysqli_connect(DB_HOST,DB_USER,DB_PWD) or die('数据库连接失败');\n";

    $config .= "mysqli_select_db(\$link,DB_NAME);\n";

    $config .= "mysqli_set_charset(\$link,DB_CHARSET);\n";

    // 写入到配置文件中
    if(file_put_contents('../public/common/config.php',$config)){
        // 写入成功，则引入配置文件
        include('../public/common/config.php');

        // 创建数据库
        $createDb = "CREATE DATABASE " . DB_NAME . ' DEFAULT CHARSET=' . DB_CHARSET;
        $result = mysqli_query($link,$createDb);

        if($result){
            mysqli_select_db($link,DB_NAME);
            // 获取数据表结构
            $sqlStr = file_get_contents('./shop.sql');
            // 对表结构进行分割
            $sqlArr = explode(';',$sqlStr);
            // var_dump($sqlArr);
            // 弹出最后一个
            array_pop($sqlArr);

            // 循环创建表
            foreach ($sqlArr as $key => $value) {
                $patt = '/`[\w]+`/';
                preg_match($patt,$value,$dbname);
                if(mysqli_query($link,$value)){
					$errno = 1;
                    echo $dbname[0] . '数据表创建成功<br>';
                } else {
                    echo mysqli_error($link);
                    echo $dbname[0] . '数据表创建失败<br>';
                    static $errno = 0;
                }
            }

            // 检测是否完全创建成功
            if($errno === 0){
                echo '数据表没有完全创建成功！请重新安装';
                exit;
            }

            // 完全创建成功，则插入信息
            $username = htmlspecialchars(trim($_POST['username']));
            $sql = "insert into shop_user(username,userpwd,level) value('{$username}','{$userpwd}',1)";
            mysqli_query($link,$sql);   // 插入管理员账号

            $uid = mysqli_insert_id($link);
            $email = htmlspecialchars(trim($_POST['email']));
            $regtime = time();
            $regip = $_SERVER['REMOTE_ADDR'];

            $sql = "insert into shop_user_details(uid,email,regtime,regip) value({$uid},'{$email}','{$regtime}','{$regip}')";
            mysqli_query($link,$sql);

            // 插入网站配置
            $sql = "insert into shop_webconf(webname,status) value('我的网站',1)";
            mysqli_query($link,$sql);

            // 生成网站配置文件
                $config = <<<CONFIG
<?php
    header("Content-type:text/html;charset=utf-8");
    define('WEBSITE_STATUS',1);
CONFIG;
            // 写入文件
            file_put_contents('../public/common/webconf.php', $config);

            // 生成文件锁
            file_put_contents('../public/common/install.lock','');

            echo '网站安装成功，<a href="../index.php">点击进入首页</a>';
            exit;
        } else {
            echo '数据库创建失败';
        }
    } else {
        echo '配置文件写入失败';
    }
?>