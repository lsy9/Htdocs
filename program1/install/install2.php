<?php
    // 本页面进行检测环境变量
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>安装步骤二</title>
</head>
<body>
    <table width="500" align="center">
    <form method="post" action="install3.php">
        <caption>检测环境</caption>
        <thead>
            <tr>
                <th>环境检测</th>
                <th>当前服务器</th>
            </tr>
            <tr>
                <td>操作系统</td>
                <td><?php echo PHP_OS; ?></td>
            </tr>
            <tr>
                <td>PHP版本：</td>
                <td><?php echo PHP_VERSION; ?></td>
            </tr>
            <tr>
                <td>数据库支持：</td>
                <td><?php echo function_exists('mysqli_connect') ? '支持mysqli' : '不支持mysqli'; ?></td>
            </tr>
            <tr>
                <td>上传目录：</td>
                <td>
                    <?php echo is_writable('../public/uploads')?'可写':'不可写'; ?>
                </td>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th colspan="2"><input type="submit" value="下一步"></th>
            </tr>
        </tfoot>
    </table>
    </form>
</body>
</html>