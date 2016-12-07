<?php
    // 开启session
    session_start();
    // 设置页面字符集
    header("Content-type:text/html;charset=utf-8");

    // 设置默认时区
    date_default_timezone_set('PRC');

    // 引入数据库配置
    include('../../public/common/config.php');

    // 接收用户操作
    $act = $_GET['act'];

    // 处理用户操作
    switch($act){
        case 'deliver':
            // 发货 状态为1
            // 接收id
            $ordernum = $_GET['ordernum'];
            $sql = "update shop_order_status set status=1 where ordernum={$ordernum}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                // 修改商品库存
                // 查询订单信息
                $sql = "select gid,num from shop_order where ordernum={$ordernum}";
                $result = mysqli_query($link,$sql);
                if($result && mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
                    // 修改库存
                    $sql = "update shop_goods set goodsnum=goodsnum-{$row['num']} where id={$row['gid']}";
                    $result = mysqli_query($link,$sql);
                    if($result && mysqli_affected_rows($link)>0){
                        echo '<script>
                            alert("发货成功");
                            window.location.href="../order.php";
                        </script>';
                    }
                }
            } else {
                echo '<script>
                    alert("发货失败");
                    window.location.href="../order.php";
                </script>';
            }
        break;
        case 'cancel':
            // 状态为5的是取消的订单
            // 接收id
            $ordernum = $_GET['ordernum'];
            $sql = "update shop_order_status set status=5 where id={$ordernum}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                echo '<script>
                    alert("取消订单成功");
                    window.location.href="../order.php";
                </script>';
            } else {
                echo '<script>
                    alert("取消订单失败");
                    window.location.href="../order.php";
                </script>';
            }
        break;
        case 'oktui':
            // 确认退货，返还金币
            $ordernum = $_GET['ordernum'];
            // 修改订单状态
            $sql = "update shop_order_status set status=6 where ordernum={$ordernum}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                // 查询数据
                $sql = "select o.uid,o.gid,o.num,g.goodsprice,d.gold from shop_order o,shop_goods g,shop_user_details d where o.ordernum={$ordernum} and o.gid=g.id and o.uid=d.uid";
                $result = mysqli_query($link,$sql);
                if($result && mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
                    // 修改用户金币
                    $gold = $row['gold']+($row['goodsprice']*$row['num']);
                    $sql = "update shop_user_details set gold={$gold} where uid={$row['uid']}";
                    $result = mysqli_query($link,$sql);
                    if($result && mysqli_affected_rows($link)>0){
                        // 修改商品库存
                        // 修改库存
                        $sql = "update shop_goods set goodsnum=goodsnum+{$row['num']} where id={$row['gid']}";
                        $result = mysqli_query($link,$sql);
                        if($result && mysqli_affected_rows($link)>0){
                            echo '<script>
                                alert("退货成功，金币已返还给用户");
                                window.location.href="./tuihuan.php";
                            </script>';
                        } else {
                            echo '<script>
                                alert("退货失败");
                                window.location.href="./tuihuan.php";
                            </script>';
                        }
                    } else {
                        echo '<script>
                            alert("退货失败");
                            window.location.href="./tuihuan.php";
                        </script>';
                    }
                }
            } else {
                echo '<script>
                    alert("订单号不存在！！");
                    window.location.href="./tuihuan.php";
                </script>';
                exit;
            }
        break;
        case 'notui':
            $ordernum = $_GET['ordernum'];
            // 不退货，修改订单状态为2
            $sql = "update shop_order_status set status=2 where ordernum={$ordernum}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                echo '<script>
                    alert("操作成功");
                    window.location.href="./tuihuan.php";
                </script>';
            } else {
                echo '<script>
                    alert("操作失败");
                    window.location.href="./tuihuan.php";
                </script>';
            }
        break;
        case 'okhuan':
            $ordernum = $_GET['ordernum'];
            // 不换货，修改订单状态为1
            $sql = "update shop_order_status set status=1 where ordernum={$ordernum}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                echo '<script>
                    alert("操作成功");
                    window.location.href="./tuihuan.php";
                </script>';
            } else {
                echo '<script>
                    alert("操作失败");
                    window.location.href="./tuihuan.php";
                </script>';
            }
        break;
        case 'nohuan':
            $ordernum = $_GET['ordernum'];
            // 不换货，修改订单状态为2
            $sql = "update shop_order_status set status=2 where ordernum={$ordernum}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                echo '<script>
                    alert("操作成功");
                    window.location.href="./tuihuan.php";
                </script>';
            } else {
                echo '<script>
                    alert("操作失败");
                    window.location.href="./tuihuan.php";
                </script>';
            }
        break;
    }