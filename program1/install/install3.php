<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>安装步骤三</title>
    <style type="text/css" media="screen">
        .tar{
            text-align: right;
        }
    </style>
</head>
<body>
    <table width="600" align="center">
    <form action="installok.php" method="post">
        <tr>
            <td class="tar">数据库服务器：</td>
            <td><input type="text" name="DB_HOST" value="localhost"></td>
        </tr>
        <tr>
            <td class="tar">数据库用户名：</td>
            <td><input type="text" name="DB_USER" value="root"></td>
        </tr>
        <tr>
            <td class="tar">数据库密码：</td>
            <td><input type="password" name="DB_PWD" value=""></td>
        </tr>
        <tr>
            <td class="tar">数据库名：</td>
            <td><input type="text" name="DB_NAME" value="" required></td>
        </tr>
        <tr>
            <td class="tar">数据库字符集：</td>
            <td>
                <input type="radio" name="DB_CHARSET" value="utf8" checked>UTF8
                <input type="radio" name="DB_CHARSET" value="gbk">GBK
            </td>
        </tr>
        <tr>
            <td class="tar">管理员账号：</td>
            <td><input type="text" name="username" value="admin"></td>
        </tr>
        <tr>
            <td class="tar">管理员密码：</td>
            <td><input type="password" name="userpwd1" value="" required></td>
        </tr>
        <tr>
            <td class="tar">确认密码：</td>
            <td><input type="password" name="userpwd2" value="" required></td>
        </tr>
        <tr>
            <td class="tar">管理员邮箱：</td>
            <td><input type="text" name="email" value="admin@admin.com"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="确认安装">
                <input type="button" value="返回上一步" onclick="window.history.back(-1)">
            </td>
        </tr>
    </form>
    </table>
</body>
</html>