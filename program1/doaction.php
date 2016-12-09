<?php
	// 开启session
	session_start();
	// 设置页面字符集
	header("Content-type:text/html;Charset=utf-8");

	// 引入数据库连接配置
	include('./public/common/config.php');
	// 接收用户操作
	$act = $_GET['act'];

	// 设置默认时区
	date_default_timezone_set('PRC');

	// 处理用户操作
    switch($act){
		case 'reg':
			// 接收传递的数据
			$username = htmlspecialchars(trim($_POST['username']));	// 用户名
			$userpwd = htmlspecialchars(trim($_POST['userpwd']));	// 密码
			$userpwd2 = htmlspecialchars(trim($_POST['userpwd2']));	// 确认密码
			$vcode = $_POST['vcode'];	// 验证码

			// 判断验证码是否一致
			$vcode = strtolower($vcode);
			$yzm = strtolower($_SESSION['code']);

			if($vcode != $yzm){
				// 跳转
				header('location:./reg.php?errno=1');	// 1是验证码错误
				// 终止程序执行
				exit;
			}

			// 检测两次密码是否一致
			if($userpwd != $userpwd2){
				// 跳转
				header('location:./reg.php?errno=2');	// 2表示两次密码不一致
				// 终止
				exit;
			}
			// 检测用户名是否存在
			// 密码加密
			$userpwd = md5($userpwd);
			$sql = "select id from shop_user where username='{$username}'";
			
			// 执行查询
			$result = mysqli_query($link,$sql);

			// 判断
			if($result && mysqli_num_rows($result)>0){
				// 能查询到用户，证明用户存在
				header('location:./reg.php?errno=3');	// 3代表用户已存在
				//终止
				exit;
			} else {
				// 查找不到用户，证明用户不存在执行插入
				$sql = "insert into shop_user(username,userpwd) value('{$username}','{$userpwd}')";
				// 执行操作
				$result = mysqli_query($link,$sql);
				
				// 判断
				// 如果插入成功，则同时更改用户详情表
				if($result && mysqli_affected_rows($link)>0){
					// 获取插入的id
					$uid = mysqli_insert_id($link);

					$gold = 30;	// 默认赠送30个金币
					$regtime = $lasttime = time();	// 默认注册时间和最后登录时间一致
					$regip = $_SERVER['REMOTE_ADDR'];

					$sql = "insert into shop_user_details(uid,gold,regtime,lasttime,regip) value({$uid},{$gold},{$regtime},{$lasttime},'{$regip}')";

					// 执行sql
					$result = mysqli_query($link,$sql);
					// 判断
					if($result && mysqli_affected_rows($link)>0){
                        $_SESSION['user']['id'] = $uid;
                        $_SESSION['user']['level'] = 0;
						echo '<script>
							alert("注册成功，金币+30");
							window.location.href="./index.php";
						</script>';
					} else {
						// 如果插入详情表失败，删除刚才插入用户表中的数据
						$sql = "delete from shop_user where id={$uid}";
						mysqli_query($link,$sql);
						// 弹窗提示注册失败
						echo '<script>
							alert("注册失败，请重新尝试");
							window.location.href="./reg.php";
						</script>';
					}
				} else {
					// 插入失败，返回错误信息
					echo '<script>
						alert("注册失败，请重新尝试");
						window.location.href="./reg.php";
					</script>';
				}
			}
		break;
		case 'login':
			// 接收数据
			$username = htmlspecialchars(trim($_POST['username']));
			$userpwd = htmlspecialchars(trim($_POST['userpwd']));
			$userpwd = md5($userpwd);

			// 检测用户是否存在，且账号密码正确
			$sql = "select id,level,status from shop_user where username='{$username}' and userpwd='{$userpwd}'";
			$result = mysqli_query($link,$sql);
			// 检测
			if($result && mysqli_num_rows($result) > 0){
				// 登录成功
				$row = mysqli_fetch_assoc($result);
				$id = $row['id'];
				$level = $row['level'];

				// 已禁用的用户不允许登录
				if($row['status']!=1){
					echo '<script>
						alert("用户已禁用，禁止登录\n请联系管理员");
						window.location.href="./index.php";
					</script>';
					exit;
				}

				// 判断是否是第一次登录
				$sql = "select gold,lasttime from shop_user_details where uid={$id}";
				$result = mysqli_query($link,$sql);
				if($result && mysqli_num_rows($result)){
					// 获取查询结果
					$row = mysqli_fetch_assoc($result);
					$time = time();
					$lasttime = $row['lasttime'];

					// 如果当前时间大于上次登录时间1天则金币增加
					$now = date('Ymd',$time);
					$lasttime = date('Ymd',$lasttime);

					if(($now-$lasttime)>=1){
						$gold = $row['gold'] + 10;
						$gold = ",gold={$gold}";
					} else {
						$gold = '';
					}

					// 执行更新操作
					$sql = "update shop_user_details set lasttime={$time}{$gold} where uid={$id}";

					// 执行update
					$result = mysqli_query($link,$sql);
					if($result && mysqli_affected_rows($link)){
						// 存入session
						// 写入到session中
						$uid = $_SESSION['user']['id'] = $id;
						$_SESSION['user']['level'] = $level;
						//var_dump($_SESSION);
                        // 判断购物车表中是否存在该用户
                        $sql = "select * from shop_shopcar_tmp where uid={$id}";
                        $result = mysqli_query($link,$sql);
                        if($result && mysqli_num_rows($result)>0){
                            $row = mysqli_fetch_assoc($result);
                            $gid = $row['gid'];
                            $num = $row['num'];

                            // 根据商品id查询商品信息
                            if(!empty($gid)){
                                // 存在商品，则销毁原有购物车
                                unset($_SESSION['shopcar']);

                                $gid = explode(',',$gid);
                                $num = explode(',',$num);
                                foreach ($gid as $k=>$v) {
                                    $sql = "select id,goodsname,goodspic,goodsprice from shop_goods where id={$v} and status=1";
                                    //echo $sql;
                                    $result = mysqli_query($link,$sql);
                                    $row = mysqli_fetch_assoc($result);

                                    // 存入session
                                    $_SESSION['shopcar'][$v] = $row;
                                    $_SESSION['shopcar'][$v]['num'] = $num[$k];
                                }
                            } else {
                                if(!empty($_SESSION['shopcar'])){
                                    // 将数据进行插入到购物车
                                    // 创建变量进行接收
                                    $gid = '';
                                    $num = '';
                                    foreach($_SESSION['shopcar'] as $goods){
                                        $gid .= $goods['id'] . ',';
                                        $num .= $goods['num'] . ',';
                                    }

                                    $gid = rtrim($gid,',');
                                    $num = rtrim($num,',');

                                    // 查询购物车表中是否存在购物车商品
                                    $sql = "update shop_shopcar_tmp set gid='{$gid}',num='{$num}' where uid={$uid}";
                                        //echo $sql;
                                    $result = mysqli_query($link,$sql);
                                }
                            }
                        } else {
                            // 插入购物车
                            if(!empty($_SESSION['shopcar'])){
                                // 将数据进行插入到购物车
                                // 创建变量进行接收
                                $gid = '';
                                $num = '';
                                foreach($_SESSION['shopcar'] as $goods){
                                    $gid .= $goods['id'] . ',';
                                    $num .= $goods['num'] . ',';
                                }

                                $gid = rtrim($gid,',');
                                $num = rtrim($num,',');

                                // 表中没有该用户，则插入到购物车表中
                                $sql = "insert into shop_shopcar_tmp(uid,gid,num) value({$uid},'{$gid}','{$num}')";

                                $result = mysqli_query($link,$sql);
                            }
                        }

						// 如果是第一次登录，则提示增加金币信息
						if(!empty($gold)){
							echo '<script>
								alert("登录成功，金币+10");
								window.location.href="./index.php";
							</script>';
						} else {
							// 不是第一次登录的提示信息
							echo '<script>
								alert("登录成功");
								window.location.href="./index.php";
							</script>';
						}

					} else {
						echo '<script>
							alert("登录失败！");
							window.location.href="./login.php";
						</script>';
					}
				}

			} else {
				echo '<script>
					alert("登录失败！用户名或者密码错误！");
					window.location.href="./login.php";
				</script>';
			}
			exit;
		break;
		case 'layout':
            // 判断是否存在购物车，如果购物车中有商品则进行插入数据库，并销毁当前购物车
            if(!empty($_SESSION['shopcar'])){
                // 将数据进行插入到购物车
                // 创建变量进行接收
                $gid = '';
                $num = '';
                foreach($_SESSION['shopcar'] as $goods){
                    $gid .= $goods['id'] . ',';
                    $num .= $goods['num'] . ',';
                }

                $gid = rtrim($gid,',');
                $num = rtrim($num,',');

                $uid = $_SESSION['user']['id'];

                // 查询购物车表中是否存在购物车商品
                $sql = "select uid from shop_shopcar_tmp where uid={$uid}";
                $result = mysqli_query($link,$sql);
                if($result && mysqli_num_rows($result)>0){
                    // 购物车表中存在该商品，只需要进行更新
                    $sql = "update shop_shopcar_tmp set gid='{$gid}',num='{$num}' where uid={$uid}";
                    //echo $sql;
                    $result = mysqli_query($link,$sql);
                    if($result){
                        // 不执行操作
                        unset($_SESSION['shopcar']);
                    } else {
                        echo '<script>
                            alert("插入购物表失败");
                            window.location.href="./shopcar.php";
                        </script>';
                        exit;
                    }
                } else {
                    // 表中没有该用户，则插入到购物车表中
                    $sql = "insert into shop_shopcar_tmp(uid,gid,num) value({$uid},'{$gid}','{$num}')";

                    $result = mysqli_query($link,$sql);
                    if($result && mysqli_affected_rows($link)>0){
                        // 插入成功
                        unset($_SESSION['shopcar']);
                    } else {
                        echo '<script>
                            alert("插入购物表失败");
                            window.location.href="./shopcar.php";
                        </script>';
                        exit;
                    }
                }
            }

            // 销毁session
            unset($_SESSION['user']);
			// 跳转
			header('location:./index.php');
			exit;
		break;
		case 'shopcar':
			$id = $_POST['id'];
			$num = $_POST['goodsnum'];
			if(!empty($_SESSION['shopcar'][$id])){
				// 证明已经存在，只需要更改num即可
				$_SESSION['shopcar'][$id]['num'] += $num;
			} else {
				// 根据id查询到商品信息
				$sql = "select id,goodsname,goodspic,goodsprice from shop_goods where id={$id}";
				$result = mysqli_query($link,$sql);
				if($result && mysqli_num_rows($result)>0){
					$row = mysqli_fetch_assoc($result);
				}
				// 存储session
				$_SESSION['shopcar'][$id] = $row;
				$_SESSION['shopcar'][$id]['num'] = $num;
			}
			echo '<script>
				alert("添加购物车成功");
				window.location.href="./shopcar.php";
			</script>';
		break;
		case 'jiacar':	// 数量加1
			$id = $_GET['id'];
			$_SESSION['shopcar'][$id]['num']++;
			echo '<script>
				window.location.href="./shopcar.php";
			</script>';
		break;
		case 'jiancar':	// 数量减一
			$id = $_GET['id'];
			if($_SESSION['shopcar'][$id]['num']>1){
				$_SESSION['shopcar'][$id]['num']--;
			}
			echo '<script>
				window.location.href="./shopcar.php";
			</script>';
		break;
		case 'delcar':	// 移除购物车
			$id = $_GET['id'];
			unset($_SESSION['shopcar'][$id]);
			echo '<script>
				window.location.href="./shopcar.php";
			</script>';
		break;
		case 'info':
			// 接收表单数据
            $id = $_SESSION['user']['id'];
            $nickname = htmlspecialchars(trim($_POST['nickname']));
            $sex = $_POST['sex'];
            $file = $_FILES['userpic'];
            // 判断是否上传头像
            if($file['error'] != 4){
                // 证明上传了文件
                // 引入函数库文件，对文件进行处理
                include('./public/common/functions.php');
                // 处理上传的图片
                $path = './public/uploads/';
                $info = uploadFile($file,$path,array());

                // 判断
                if($info['isok']){
                    // 获取原有头像文件名，用于更新成功后进行删除
                    $sql = "select userpic from shop_user where id={$id}";
                    $result = mysqli_query($link,$sql);
                    if($result && mysqli_num_rows($result)>0){
                        $row = mysqli_fetch_assoc($result);
                    }

                    // 获取文件名
                    $filename = $info['message'];
                    // 对图片进行缩放
                    imageResize($path.$filename,$path,80,80,'');

                    // 拼接sql语句
                    $userpic = ",userpic='{$filename}'";
                } else {
                    echo '<script>
                        alert("上传头像失败，请重试\n错误原因：'.$info['message'].'");
                        window.location.href="./ucenter.php";
                    </script>';
                    exit;
                }
            } else {
                $userpic = '';
            }

            // 更新语句
            $sql = "update shop_user set nickname='{$nickname}'{$userpic} where id={$id}";
            $result = mysqli_query($link,$sql);
            if($result){
                // 更新成功，删除原有头像文件
                @unlink($path.$row['userpic']);
                // 更新详情表
                $sql = "update shop_user_details set sex={$sex} where uid={$id}";
                $result = mysqli_query($link,$sql);
                if($result){
                    echo '<script>
                        alert("更新成功");
                        window.location.href="./ucenter.php";
                    </script>';
                } else {
                    echo '<script>
                        alert("修改失败，请重试");
                        window.location.href="./ucenter.php";
                    </script>';
                }
            } else {
                // 修改失败，删除上传的文件
                @unlink($path.$filename);
                echo '<script>
                    alert("修改失败，请重试");
                    window.location.href="./ucenter.php";
                </script>';
            }
        break;
        case 'changepwd':   // 修改密码
            // 接收信息
            $oldpwd = htmlspecialchars(trim($_POST['oldpwd']));
            $newpwd1 = htmlspecialchars(trim($_POST['newpwd1']));
            $newpwd2 = htmlspecialchars(trim($_POST['newpwd2']));
            $uid = $_SESSION['user']['id'];

            // 验证新密码是否一致
            if(md5($newpwd1) != md5($newpwd2)){
                echo '<script>
                    alert("修改失败，请重试");
                    window.location.href="./usersafe.php";
                </script>';
                exit;
            }

            // 一致则判断密码是否正确
            $userpwd = md5($oldpwd);
            $sql = "select userpwd from shop_user where id={$uid} and userpwd='{$userpwd}'";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_num_rows($result)>0){
                // 密码验证正确，进行更新操作
                $userpwd = md5($newpwd1);
                $sql = "update shop_user set userpwd='{$userpwd}' where id={$uid}";
                $result = mysqli_query($link,$sql);
                if($result){
                    unset($_SESSION['user']);
                    echo '<script>
                        alert("修改成功，请重新登录");
                        window.location.href="./login.php";
                    </script>';
                    exit;
                } else {
                    echo '<script>
                        alert("修改失败，请重新尝试");
                        window.location.href="./usersafe.php";
                    </script>';
                    exit;
                }
            } else {
                echo '<script>
                    alert("密码错误，修改失败，请重试");
                    window.location.href="./usersafe.php";
                </script>';
                exit;
            }
        break;
        case 'changeemail':
            // 接收数据
            $uid = $_SESSION['user']['id'];
            $oldemail = htmlspecialchars(trim($_POST['oldemail']));
            $newemail = htmlspecialchars(trim($_POST['newemail']));

            // 检测邮箱是否填写正确
            $sql = "select email from shop_user_details where uid={$uid} and email='{$oldemail}'";
            //echo $sql;
            $result = mysqli_query($link,$sql);
            if($result && mysqli_num_rows($result)>0){
                $sql = "update shop_user_details set email='{$newemail}' where uid={$uid}";
                $result = mysqli_query($link,$sql);
                if($result && mysqli_affected_rows($link)>0){
                    echo '<script>
                        alert("邮箱修改成功");
                        window.location.href="./usersafe.php";
                    </script>';
                    exit;
                } else {
                    echo '<script>
                        alert("邮箱修改失败，请重试");
                        window.location.href="./usersafe.php";
                    </script>';
                    exit;
                }
            } else {
                echo '<script>
                    alert("邮箱验证失败，请填写正确的绑定邮箱");
                    window.location.href="./usersafe.php";
                </script>';
                exit;
            }
        break;
        case 'forget':
            $username = htmlspecialchars(trim($_POST['username']));
            $email = htmlspecialchars(trim($_POST['email']));
            $sql = "select d.uid from shop_user u,shop_user_details d where d.email='{$email}' and u.status=1 and d.uid=u.id and u.username='{$username}'";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_num_rows($result)>0){
                $row = mysqli_fetch_assoc($result);
                // 有这个结果
                $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890!@&_-";
                $strlen = strlen($str);
                $randpwd = substr(str_shuffle($str),mt_rand(0,$strlen-7),6);

                // 更新用户数据
                $userpwd = md5($randpwd);
                $sql = "update shop_user set userpwd='{$userpwd}' where id={$row['uid']}";
                echo $sql;
                $result = mysqli_query($link,$sql);
                if($result && mysqli_affected_rows($link)){
                    echo '<script>
                        alert("密码重置成功，新密码为：'.$randpwd.'\n请及时修改密码！！");
                        window.location.href="./login.php";
                    </script>';
                } else {
                    echo '<script>
                        alert("找回密码失败");
                        window.location.href="./forget.php";
                    </script>';
                    exit;
                }
            } else {
                echo '<script>
                    alert("用户名或者邮箱错误，请重试");
                    window.location.href="./forget.php";
                </script>';
                exit;
            }
        break;
        case 'order':
            // 接收数据
            $uid = $_SESSION['user']['id'];
            $shopcar = $_SESSION['shopcar'];

            // foreach ($_POST['id'] as $id) {
            foreach ($shopcar as $id=>$order) {
                // 生成随机订单号
                $ordernum = date('YmdHis').mt_rand(10000,99999);
                // 判断库存是否满足
                $sql = "select goodsprice,goodsnum from shop_goods where id={$id} and status=1";
                $result = mysqli_query($link,$sql);
                if($result && mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
                    if($row['goodsnum']<$order['num']){
                        echo '<script>
                            alert("亲，《'.$order['goodsname'].'》库存不足，请谅解\n当前库存：'.$row['goodsnum'].'");
                            window.location.href="./shopcar.php";
                        </script>';
                        exit;
                    }
                }

                $num = $order['num'];

                // 扣除用户的金币
                $total = $row['goodsprice']*$num;
                $sql = "update shop_user_details set gold=gold-{$total} where uid={$uid}";
                $result = mysqli_query($link,$sql);
                if($result && mysqli_affected_rows($link)>0){
                    $sql = "insert into shop_order(ordernum,uid,gid,num) value({$ordernum},{$uid},{$id},{$num})";
                    // 执行插入
                    $result = mysqli_query($link,$sql);
                    if($result && mysqli_affected_rows($link)>0){
                        // 下单成功，修改订单状态
                        $sql = "insert into shop_order_status(ordernum) value({$ordernum})";
                        $result = mysqli_query($link,$sql);
                        if($result && mysqli_affected_rows($link)>0){
                            unset($_SESSION['shopcar'][$id]);
                            $sql = "update shop_shopcar_tmp set gid='',num='' where uid={$uid}";
                            $result = mysqli_query($link,$sql);
                        } else {
                            // 订单状态表添加失败，删除订单表中的数据
                            $sql ="delete from shop_order where ordernum={$ordernum}";
                            mysqli_query($link,$sql);
                            echo '<script>
                                alert("下单失败！请重试");
                                window.location.href="./shopcar.php";
                            </script>';
                            exit;
                        }
                    } else {
                        echo '<script>
                            alert("下单失败！请重试");
                            window.location.href="./shopcar.php";
                        </script>';
                        exit;
                    }
                } else {
                    echo '<script>
                        alert("扣款失败！数据错误");
                        window.location.href="./shopcar.php";
                    </script>';
                    exit;
                }
            }
            header('location:./order.php');
        break;
        case 'shouhuo': // 收货操作
            // 获取用户信息
            $uid = $_SESSION['user']['id'];
            // 获取订单信息
            $sid = $_GET['sid'];
            $sql = "update shop_order_status set status=2 where id={$sid}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                echo '<script>
                    alert("已确认收货");
                    window.location.href="./order.php?act=shou";
                </script>'; 
            } else {
                echo '<script>
                    alert("确认收货失败，请联系管理员");
                    window.location.href="./order.php?act=shou";
                </script>';
            }
        break;
        case 'tuihuo': // 退货操作
            // 获取用户信息
            $uid = $_SESSION['user']['id'];
            // 获取订单信息
            $sid = $_GET['sid'];
            $sql = "update shop_order_status set status=3 where id={$sid}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                echo '<script>
                    alert("已提交退货申请");
                    window.location.href="./order.php?act=ok";
                </script>'; 
            } else {
                echo '<script>
                    alert("退货申请失败，请联系管理员");
                    window.location.href="./order.php?act=ok";
                </script>';
            }
        break;
        case 'huanhuo': // 换货操作
            // 获取用户信息
            $uid = $_SESSION['user']['id'];
            // 获取订单信息
            $sid = $_GET['sid'];
            $sql = "update shop_order_status set status=4 where id={$sid}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                echo '<script>
                    alert("已提交换货申请");
                    window.location.href="./order.php?act=ok";
                </script>'; 
            } else {
                echo '<script>
                    alert("提交换货申请失败，请联系管理员");
                    window.location.href="./order.php?act=ok";
                </script>';
            }
        break;
        case 'links':   // 友情连接
            $linkname = htmlspecialchars(trim($_POST['linkname']));
            $linkurl = htmlspecialchars(trim($_POST['linkurl']));
            $sql = "insert into shop_friendlink(linkname,linkurl) value('{$linkname}','{$linkurl}')";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                echo '<script>
                    alert("已提交友链申请，请等待管理员审核");
                    window.location.href="./links.php";
                </script>';
                exit;
            } else {
                echo '<script>
                    alert("提交申请失败！请重试");
                    window.location.href="./links.php";
                </script>';
                exit;
            }
        break;
        case 'comment':
            // 接收数据
            $uid = $_SESSION['user']['id'];
            $gid = $_POST['gid'];
            $ordernum = $_POST['ordernum'];
            $content = addslashes(htmlspecialchars(trim($_POST['content'])));

            // 判断评论字数
            if(strlen($content)<10 || strlen($content)>255){
                echo '<script>
                    alert("评论成功失败，评论字数不符合条件");
                    window.location.href="./comment.php?ordernum='.$ordernum.'";
                </script>';
                exit;
            }

            // 设置发表时间
            $posttime = time();
            // 插入到评论表里
            $sql = "insert into shop_goods_comment(uid,gid,content,posttime) value({$uid},{$gid},'{$content}',{$posttime})";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                // 插入成功，修改订单状态
                $sql = "update shop_order_status set status=7 where ordernum={$ordernum}";
                $result = mysqli_query($link,$sql);
                if($result && mysqli_affected_rows($link)>0){
                    echo '<script>
                        alert("评论成功");
                        window.location.href="./goodsdetails.php?id='.$gid.'";
                    </script>';
                    exit;
                } else {
                    echo '<script>
                        alert("评论失败");
                        window.location.href="./comment.php?ordernum='.$ordernum.'";
                    </script>';
                }
                
            } else {
                echo '<script>
                    alert("提交评论失败！请重试");
                    window.location.href="./goodsdetails.php?id='.$gid.'";
                </script>';
                exit;
            }
        break;
        case 'shoucang':
            $gid = $_GET['id'];
            // 先判断用户是否登录
            if(empty($_SESSION['user'])){
                echo '<script>
                    alert("请先登录，再进行商品收藏");
                    window.location.href="./goodsdetails.php?id='.$gid.'";
                </script>';
                exit;
            }

            $uid = $_SESSION['user']['id'];

            // 获取商品的所有收藏用户
            $sql = "select shoucang from shop_goods where id={$gid}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_num_rows($result)>0){
                $row = mysqli_fetch_assoc($result);
                
                // 先判断商品是否被收藏过
                if(empty($row['shoucang'])){
                    // 没有被收藏过，则直接添加一个用户
                    $shoucang = $uid;
                } else {
                    // 被收藏过，则判断当前用户是否已经收藏该商品
                    $shoucanguser = explode(',',$row['shoucang']);
                    if(in_array($uid,$shoucanguser)){
                        echo '<script>
                            alert("亲，您已经收藏过了~~");
                            window.location.href="./goodsdetails.php?id='.$gid.'";
                        </script>';
                        exit;
                    }

                    // 没有收藏，则进行拼接
                    $shoucang = $row['shoucang'] . ',' . $uid;
                }

                // 进行更新数据
                $sql = "update shop_goods set shoucang='{$shoucang}' where id={$gid}";
                $result = mysqli_query($link,$sql);
                if($result && mysqli_affected_rows($link)>0){
                    echo '<script>
                        alert("收藏成功！感谢您的收藏");
                        window.location.href="./goodsdetails.php?id='.$gid.'";
                    </script>';
                    exit;
                } else {
                    echo '<script>
                        alert("亲，收藏失败了。。请重新尝试一下吧");
                        window.location.href="./goodsdetails.php?id='.$gid.'";
                    </script>';
                    exit;
                }

            } else {
                echo '<script>
                    alert("数据错误，请重试");
                    window.location.href="./goodsdetails.php?id='.$gid.'";
                </script>';
                exit;
            }
        break;
	}