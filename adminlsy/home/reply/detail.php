<?php session_start();  ?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			回复讨论
		</title>
		<meta charset="utf-8"/>
        <link href="../css/detail.css" rel="stylesheet" type="text/css"/>

	</head>
	 <?php
             date_default_timezone_set('PRC');
				$where='';
				$idata='';
				$arr1=array();
				$arr2=array();
				
				if(!empty($_POST['title'])){
					$arr1[] = "post.title like '%".$_POST['title']."%'";
					$arr2[] = "title=".$_POST['title'];
				}
				
				$title=$_GET['title'];
                $fname=$_GET['fname'];
                $bname=$_GET['bname'];
                $pid=$_GET['pid'];
                $detail=array();
                $detail['pid']=$pid;
                $detail['title']=$title;
                $detail['fname']=$fname;
                $detail['bname']=$bname;
                $_SESSION['detail']=$detail;
					
	?>
	<body>
		<div id="zuishang">
			<div id="shouhang">
				<div id="sheweishouye"><a href="">设为首页</a>&nbsp;<a href="">收藏LAMP兄弟连</a></div>
				<div id="sousuo">
					<ul>
						<li><a href="">搜索</a></li>
						<li><a href="">统计排行</a></li>
						<li><a href="">会员列表</a></li>
						<li><a href="">社区服务</a></li>
						<li><a href="">精华区</a></li>
						<li><a href="">最新帖子</a></li>
						<li><a href="">社区应用</a></li>
						<li><a href="">推广链接</a></li>
							<li id="bang"><a href="">帮助</a></li>
					</ul>
				</div>
			</div>
		</div>	
		<div>
			<div id="hang1">
                <div id="hang1a">
                    <a href="../index.php"><img src="../img/logo.png"></a>
				</div>
				<div id="hang1b"><img src="../img/wxdbjc.gif">
				</div>
				<div id="hang1c"><img src="../img/QQdenglu.jpg">
				</div>
				<div id='hang1d'>
                    <?php
                     if((!isset($_SESSION['flag'])) || ($_SESSION['flag'] != md5($_SESSION['user']['userName']))){

                     echo "<form method='post' action='dologin 1.php'>
                            <input type='text' name='userName' shuru='输入用户名'/>&nbsp;
                            <input type='checkbox' name='zhuangtai' value='1' checked/>记住登录&nbsp;<a href=''>找回密码</a>
                            <input type='password' name='passwd' shuru='密码' id='dd'/>&nbsp;
                            <div>
                                <input type='image' src='.../img/denglu1.jpg'/ '></a>
                                <a href='./register.php'><img src='../img/zhuce1.jpg'/></a>
                            </div>
                            </from>";

                        }else{
                            $allauth=array(0=>'普通用户',1=>'管理员');
                ?>
                                    <span style="position:relative;top:5px;">欢迎您，尊贵的会员：<?php echo $_SESSION['userDetail']['nickName']; ?></span><img src="../img/<?php echo $_SESSION['userDetail']['photo']; ?>"  width="50PX" height="50px" style="float:right;" ><br/>
                                   <span style="position:relative;top:8px;"><a href="../usercenter.php?id=<?php echo $_SESSION['user']['id']; ?>">个人中心</a> | <a href="../exit.php">退出</a> | <a href="../register.php">注册 </a> | <a href="../../admin/index.php">后台管理</a></span><br/>
                            <span style="position:relative;top:10px;">身份：<?php echo $allauth[$_SESSION['user']['auth']]; ?> 积分：<?php echo $_SESSION['userDetail']['score']; ?></span>
                            
                <?php
                     }
                  ?>
                </div>
			</div>
		</div>
		<div id="zhucaidan">
			<div id="nei">
				<ul>
					<li><a href="">培训课堂</a></li>
					<li><a href="">论坛</a></li>
					<li><a href="">兄弟连云课堂</a></li>
					<li><a href="">PHP视频</a></li>
					<li><a href="">Android视频</a></li>
					<li><a href="">Lunux视频</a></li>
					<li><a href="">Cocos视频</a></li>
					<li><a href="">战地日记</a></li>
					<li><a href="">在线自测</a></li>
					<li>
						<select id="kuai" name="kuaijietongdao">
							<option value="0">
							快捷通道
							</option>
						</select>
					</li>
				</ul>
			</div>
        </div>
        <div id="body">
            <div id="hang2">
                <div id="hang2a">
                    <img src="../img/ssss.jpg">
                    
                </div>
                <div id="hang2b">热搜：<a href="">php</a>&nbsp;<a href="">php视频</a>&nbsp;<a href="">php教程</a></div>
                <div id="hang2c"><img src="../img/tu1.png"/></div>
            </div>
           
  
        <?php
            
                $arr2[] = "pid=".$pid;
                $arr2[] = "fname=".$bname;
                $arr2[] = "bname=".$bname;
                $arr2[] = "title=".$title;
             
             if(!empty($arr1)){
	                //组合条件
                        $where = " and ".implode("and ",$arr1);
                        $idata = implode("&",$arr2);
                    }
            $idata = implode("&",$arr2);


                ?>


            <div id="hang3">
                <img src="../img/home.gif"/>
                <span>
                    <a href=""><?php echo $fname; ?></a>&nbsp;&gt;
                    <a href="../post/list.php?<?php echo "pid={$_SESSION['list']['pid']}&id={$_SESSION['list']['id']}&fname={$_SESSION['list']['fname']}&bname={$_SESSION['list']['bname']}&ingName={$_SESSION['list']['ingName']}"?>"><?php echo $bname; ?></a>&nbsp;&gt;
                    <a href=""><?php echo $title; ?></a>
                </span>
            </div>
            
            <div class="yema">
                        
                 <div style="width:150px;float:left;margin-left:10px;"><a href="../post/list.php?<?php echo "pid={$_SESSION['list']['pid']}&id={$_SESSION['list']['id']}&fname={$_SESSION['list']['fname']}&bname={$_SESSION['list']['bname']}&ingName={$_SESSION['list']['ingName']}"?>">返回上一级</a></div>
                <!--发帖回复按钮-->
                <div class="yemayou">  
                    <a href="../post/add.php?tid=<?php echo $_SESSION['list']['id']; ?>"><img src="../img/030.jpg"/></a>
                    <a href="#huifukuang"><img src="../img/029.jpg"/></a>
                </div>
            
            </div>
            <?php
                date_default_timezone_set('PRC');   
                //链接数据库
				mysql_connect('localhost','root','');

				//选择数据库
				mysql_select_db('lamp111');

				mysql_set_charset('utf8');
            
                $pagesize= 3;//每页所包含的条数；   
                $pagenum=1;//第一次默认页面所显示第几页；
            
				//获取当前显示的页数；   
                if($_GET){            
	                if(!empty($_GET['pagenum'])){
		                $pagenum=$_GET ["pagenum"];
	                }
                }
            
            
                $SQL5="select count(*) as total from reply where pid={$pid}".$where;
                $res5=mysql_query($SQL5); 
                //var_dump($res5);
                //echo $SQL5;
                $arr5=mysql_fetch_assoc($res5);
                $totals=$arr5['total'];
                 //echo $totals;  

                //获得总显示页数
                if($totals%$pagesize==0){
                    $totalpage=$totals/$pagesize;
                }else{
                    $totalpage=ceil($totals/$pagesize);
                }
                
                //获取当前请求页的url地址；
                $url=$_SERVER['REQUEST_URI'];
                $url=parse_url($url);
                $url=$url['path'];


                //定义权限的名称
                $rname=array('1'=>'司令','0'=>'小兵');

                //获得帖子的内容
                $SQL1="select content,uid,ctime from post where id={$pid}";
                $res1=mysql_query($SQL1);
                $arr1=mysql_fetch_assoc($res1);
                $content=$arr1['content'];
                
                //获得发帖人得名称
                $SQL2="select userDetail.nickName,userDetail.photo,user.auth from userDetail,user where  user.id=userDetail.id and user.id='{$arr1['uid']}'";
                $res2=mysql_query($SQL2);
				
                $arr2=mysql_fetch_assoc($res2);
                $name=$arr2['nickName'];
				// ECHO $SQL2;
				// exit;
            ?>



            <div id="yilou">
                <div id="yiloutou">
                    <div id="yiloutou1">
                        <div><span>30001</span><br/><span>阅读</span></div>
                        <div><span><?php echo $totals; ?></span><br/><span>回复</span></div>
                    </div>
                    <div id="yiloutou2">
                        <span id="zi1"><a href=""><?php echo $title; ?></a></span>
                        <span id="zi2"><a href="">[复制链接]</a></span>
                        <img src="../img/2222.jpg"/>
                    </div>
                </div>
                <div id=yilouneirong>
                    <div id="yilouneirong1">
                        <span><img src="../img/18.gif"/><?php echo $name; ?></span><br/>
                        <img id='zhuangsi' src="../img/<?php echo $arr2['photo']; ?>"/><br/>
                        <span><?php echo $rname[$arr2['auth']]; ?></span><br/>
                        <img id="rongyu" src="../img/rongyu.jpg"/><br/>
                        <img id="jiaguanzhu" src="../img/jiaguanzhu.jpg"/><br/>
                    </div>
                    <div id="yilouneirong2">
                        <div id="yilouneirong2a">
                            <span id="yilouaaaa"><span>楼主</span>&nbsp;发表于：<?php echo date('Y-m-d',$arr1['ctime']); ?></span> 
                            <div id="yiloubbbb"><a href="">只看楼主</a>&nbsp;<a href="">倒序阅读</a>&nbsp;<a href="">使用道具</a>
                            </div> 
                        </div>
                        <div id="yilouwenben">
                            <span><?php echo $content; ?></span>
                            <img src="../img/guanggao.jpg"/>
                            </div>
                            <div id="yiloufenxiang">
                                <img src="../img/00001.jpg">
                                <span id="weibo">&nbsp;<a href="">分享到微博</a>&nbsp;</span>
                                <span id="kongjian"><a href="">分享到QQ空间</a></span>
                                    <span id="QQ">&nbsp;<a href="">分享到QQ</a>&nbsp;</span>
                                    <span id="weixin">&nbsp;<a href="">分享到微信</a>&nbsp;</span>
                            </div>
                            <div id="huifushezhi">
                                <img src="../img/dengpao.jpg"/>
                                <span>附件设置隐藏，需要回复后才能看到！</span>
                            </div>
                            <div class="huifu">
                                <img src="../img/xin.jpg"><a href="#huifukuang">回复</a>
                                <span><a href>举报</a></span>
                            </div>
                            <div id="yilouxia">
                                <img src="../img/090.jpg">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $SQL3="select * from reply where pid={$pid}".$where." order by id limit ".($pagenum-1)*$pagesize.','.$pagesize;
                     // echo $SQL3;
               
					$res3=mysql_query($SQL3);
                    if($res3 && mysql_num_rows($res3)>0 ){     
                           // exit;
						   $i=1;
                           while($arr3=mysql_fetch_assoc($res3)){
                                $i++;
                                $b=$i+($pagenum-1)*$pagesize;
                            
                                $SQL4="select userDetail.nickName as name,userDetail.photo as photo,user.auth as auth from userDetail,user where user.id=userDetail.id and user.id='{$arr3['uid']}'";   
                                $res4=mysql_query($SQL4);
                                $arr4=mysql_fetch_assoc($res4);
								// var_dump($SQL4);
								// exit;
                                
                ?>
                        
                <div class="erlou">
                    <div class=erlouneirong>
                        <div class="erlouneirong1">
                            <span><img src="../img/18.gif"/><?php echo $arr4['name']; ?></span><br/>
                            <img class='touxiang' src="../img/<?php echo $arr4['photo']; ?>"/><br/>
                            <span><?php echo $rname[$arr4['auth']]; ?></span><br/>
                            <img class='rongyu1' src="../img/fangzi.jpg"/><br/>
                            <img class="jiaguanzhu" src="../img/jiaguanzhu.jpg"/><br/>
                        </div>
                        <div class="erlouneirong2">
                            <div class="erlouneirong2a">
                            <span class="erlouaaaa"><span>
                                <?php 
                                    //特色楼层展示；
                                    if($b==2){        
                                        echo "沙发";
                                    } 
                                    if($b==3){
                                        echo "板凳";
                                    } 
                                    if($b==4){
                                        echo "地板";
                                    }
                                    if($b!=2&&$b!=3&&$b!=4){
                                        echo $b."楼";
                                    }

                             ?></span>&nbsp;发表于：<?php echo date('Y-m-d',$arr3['ctime']);?></span> 
                                <div class="erloubbbb"><a href="">只看该作者</a>
                                </div> 
                            </div>
                            
                            <div class="erlouwenben">
                                <span><?php echo $arr3['content']; ?></span>
                                <img src="../img/guanggao.jpg"/>
                            </div>
                            <div class="qianbi"><img src="../img/qianbi.jpg"></div>
                            <div class="huifushang"> 功名不求盈满，做人恰到好处</div>
                            <div class="huifu">
                                <img src="../img/xin.jpg"><a href="#huifukuang">回复</a>
                                <span><a href="">举报</a></span>
                            </div>
                        </div>
                    </div>
                </div>



                <?php  
                        }
                    }
           
                ?>



                 <div class="yema">
                     <?php echo "[共".$totals."条数据]"; ?>&nbsp;&nbsp;<?php echo $pagenum."/".$totalpage."页" ?>&nbsp;&nbsp;
                    <?php 
                        if($pagenum==1){
                            echo "[首页]&nbsp;[上一页]";    
                        }else{
                            echo "[<a href='{$url}?pagenum=1&{$idata}'>首页</a>]&nbsp;[<a href='$url?pagenum=".($pagenum-1)."&{$idata}'>上一页</a>]";
                        } 
                         
                    
                        if($pagenum==$totalpage){
                            echo "[下一页]&nbsp;[尾页]";    
                        }else{
                            echo '[<a href="'.$url.'?pagenum='.($pagenum+1).'&'.$idata.'">下一页</a>]&nbsp;[<a href="'.$url.'?pagenum='.$totalpage.'&'.$idata.'">尾页</a>]';
                        }
?>              
                    <div class="yemayou">
                        <a href="../post/add.php?tid=<?php echo $_SESSION['list']['id']; ?>"><img src="../img/030.jpg"/></a>
                        <a href="#huifukuang"><img src="../img/029.jpg"/></a>
                    </div>
                </div>
                
           
               
                    <div id="huifuloutou"><span>快速回复</span></div>
                    <div id="huifulou1"><img src="../img/default.jpg"/></div>
                    <div id="huifulou2">
                        <form action="./reply.php" method="post" enctype="multipart/form-data">
                             
                             <a name='huifukuang'><div id="enen">请输入回复内容：</div><br/>  </a>
                            <textarea name="content" cols=60 rows=10></textarea> <br/> 
                            <input type="hidden" name="pid" value='<?php echo $pid; ?>' />
                            <input type="hidden" name="uid" value='<?php echo $_SESSION['user']['id']; ?>' />
                            <div id="fabu">    
                                <input type="image" src="../img/fabu.jpg">
                            </div>
                        </form>
                    </div>
                <?php  mysql_close(); ?>


            <div id="foot">
                <div id="foot1">
                    <ul>
                        <li class="xiamiande"><a href="">联系我们</a></li>
                        <li class="xiamiande"><a href="">无图版</a></li>
                        <li class="xiamiande"><a href="">手机浏览</a></li>
                        <li><a href="">清除Cookies</a></li>
                    </ul>
                </div>
                <div id="foot2">
                    Powered by phpwind v8.7 Certificate Copyright Time now is:<?php echo date('m-d H:i:s',time()); ?><br/>
                &copy;2006-2015 LAMP兄弟连版权所有 Gzip disble 京ICP备11018177号 Total 0.022546(s) query 0,<img src="../img/pic.gif">
                </div>
            </div>      
            
        </div>
    </body>
</html>
