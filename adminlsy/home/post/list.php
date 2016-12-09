<?php session_start(); 
	// echo "<pre>";
	// var_dump($_SESSION);
	// echo "</pre>";
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			论坛
		</title>
		<meta charset="utf-8"/>
		<link href="../css/list.css" rel="stylesheet" type="text/css"/>
	</head>
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
                //var_dump($_SESSION);
                 if((!isset($_SESSION['flag'])) || ($_SESSION['flag'] != md5($_SESSION['user']['userName']))){

                     echo "<form method='post' action='../dologin1.php'>
                            <input type='text' name='userName' shuru='输入用户名'/>&nbsp;
                            <input type='checkbox' name='status' value='1' checked/>记住登录&nbsp;<a href=''>找回密码</a>
                            <input type='password' name='password' shuru='密码' id='dd'/>&nbsp;
                            <div>
                                <a href='../login.php'><img src='../img/denglu1.jpg'/ '></a>
                                <a href='../register.php'><img src='../img/zhuce1.jpg'/></a>
                            </div>
                            </from>";

                        }else{
                           $allauth=array(0=>'普通用户',1=>'管理员');
                                ?>
                                   <span style="position:relative;top:5px;">欢迎您，尊贵的会员：<?php echo $_SESSION['userDetail']['nickName']; ?></span><img src="../img/imgtype17.png" style="float:right;width:50;height:50px;"><br/>
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
			
			<?php
				$pid=$_GET['pid'];//每个版块所属那个分区的id；
				$id=$_GET['id'];//每个版块的id
				$fname=$_GET['fname'];
				$bname=$_GET['bname'];
				$ingName=$_GET['ingName'];
			?>
                <img src="../img/ssss.jpg">
                <form action="../sousuo.php" method="get">
                    <input type="text" name="title" value='' id="search">
                    <input type="hidden" name="pid" value='<?php echo $pid ?>' id="search">
                    <input type="hidden" name="id" value='<?php echo $id ?>' id="search">
                    <input type="hidden" name="fname" value='<?php echo $fname ?>' id="search">
                    <input type="hidden" name="bname" value='<?php echo $bname ?>' id="search">
                    <input type="hidden" name="ingName" value='<?php echo $ingName ?>' id="search">
					
                    <select name="" id="tie">
                        <option value="0">
                            帖子
                        </option>
                    </select>
                    <input type="image" src="../img/sousuo.jpg" name="sousuo" id="sou">
                </form>
            </div>
			<div id="hang2b">热搜：<a href="">php</a>&nbsp;<a href="">php视频</a>&nbsp;<a href="">php教程</a></div>
			<div id="hang2c"><img src="../img/tu1.png"/></div>
        </div>
        <?php  
      
            $arrlist=array();
            $arrlist['pid']=$pid;
            $arrlist['id']=$id;
            $arrlist['fname']=$fname;
            $arrlist['bname']=$bname;
            $arrlist['ingName']=$ingName;
            $_SESSION['list']=$arrlist;
            
            $idata='';
            $arr2 = array();
			$arr2[] = "pid=".$pid;
            $arr2[] = "id=".$id;
            $arr2[] = "fname=".$bname;
            $arr2[] = "bname=".$bname;
            $arr2[] = "ingName=".$ingName;
             
			 
			
			$arr1 = array();
			$arr1[] = "pid=".$pid;
            $arr1[] = "id=".$id;
            $arr1[] = "fname='".$bname."'";
            $arr1[] = "bname='".$bname."'";
            // $arr1[] = "ingName='".$ingName."'";
			 
			 
			 
			 
             if(!empty($arr1)){
	                //组合条件
                        $where = " and ".implode(" and ",$arr1);
                        $idata = implode("&",$arr2);
                    }
            $idata = implode("&",$arr2);
            // echo $where;
			
            
            ?> 

        <div id="hang3">
            <img id="jiantou001" src="../img/home.gif"/>
            <span>
            <a href=""><?php echo $fname; ?></a>&nbsp;&gt;
                <a href=""><?php echo $bname; ?></a>&nbsp;
                <img id="bbs" src="../img/2547.jpg">
            </span>
        </div>
        <?php
				//连库
				$link=mysqli_connect('localhost','root','');
				
				//选库
				mysqli_select_db($link,'test');
		
				mysqli_set_charset($link,'utf8');   
                
                    //获得版块下的所有非禁用主题数目
                $SQLZ="select count(*) as total from post where recycle=1 and tid={$id}";
                $resz=mysql_query($SQLZ);
                $arrz=mysql_fetch_assoc($resz);

                    //获得版块下可看的所有回复的条数
                $SQLH="select count(*) as tot from post,reply where post.id=reply.pid and post.recycle=1 and post.tid={$id}";
                $resh=mysql_query($SQLH);
                $arrh=mysql_fetch_assoc($resh);

                    //获得今天版块下可看的所有回复的条数
                $time=strtotime(date('Y-m-d'));
                $jtime=strtotime(date('Y-m-d'))+24*60*60;
                $SQLJ="select count(*) as tots from post,reply where post.id=reply.pid and post.recycle=1 and post.tid={$id} and reply.ctime>{$time} and reply.ctime<{$jtime}";
                $resj=mysql_query($SQLJ);
                $arrj=mysql_fetch_assoc($resj);


        ?>
                


        <div id="zhutihuifu">
            <div id="php">
                <div id="phpshang">
                    <div id="shang1"><?php echo $bname; ?><img src="../img/xing.png"/></div>
                    <div id="shang2">版主：You&nbsp;and&nbsp;Me</div>
                </div>
                <div id="phpxia">
                    <img src="../img/xing.png<?php //echo $ingName; ?>">
                    <ul>
                    <li>今日：<span><?php echo $arrj['tots']; ?></span></li>
                        <li>主题：<span><?php echo $arrz['total']; ?></span></li>
                        <li>帖数：<span><?php echo $arrh['tot']; ?></span></li>
                    </ul>
                    <br/>
                    <div id="phpxiaspan">PHP基础编程、疑难解答、学习和开发过程中的经验总结等。</div>
                </div>

                <div class="yema">
                    <div class="yemayou">
                    <a href="./add.php?tid=<?php echo $id; ?>"><img src="../img/030.jpg"/></a>
                    </div>
                </div>
            </div>

            <div id="hang4">
                <span><a href="">全部</a></span>
                <span><a href="">精华</a></span>
                <span><a href="">投票</a></span>
                <span><a href="">悬赏</a></span>
                <span><a href="">商品</a></span>
            </div>

            <div id="hang5">
                <div>
                    <ul>
                        <li><a href="" id="qb0">全部</a></li>
                        <li><a href="" class="qb1">已解决</a></li>
                        <li><a href="" class="qb1">我要提问</a></li>
                        <li><a href="" class="qb1">PHP</a></li>
                        <li><a href="" class="qb1">其他</a></li>
                        <li><a href="" class="qb1">经验技巧</a></li>
                    </ul>
                </div>
            </div>

            <div id="hang6">
                <div id="hang6a">
                    排序：<a href="" id="zuixin">最新发帖</a>|<a href="" id="zuihou">最后发帖</a>
                </div>
                <div id="hang6b">
                    <div>最后发表</div>
                    <div>回复</div>
                    <div>作者</div>
                </div>
            </div>

            <div id="huifutietou">
                <div id="huifutietou1">
                    <img src="../img/anc.gif">&nbsp;站点公告:<a href="">[视频教程]兄弟连2015版视频发布声明</a>&nbsp;2011-07-13&nbsp;10:38
                </div>
                <div id="huifutietou2"> 
                    海峰
                </div>        
            </div>
            
            <?php  
                date_default_timezone_set('PRC');
            
                $pagesize= 5;//每页所包含的条数；   
                $pagenum=1;//第一次默认页面所显示第几页；
            
            //获取当前显示的页数；   
                if($_GET){            
	                if(!empty($_GET['pagenum'])){
		                $pagenum=$_GET ["pagenum"];
	                }
                }
				
				$SQL1="select count(*) as total,post.top,post.elite,post.ctime,post.title,post.uid,userDetail.nickName from post,userDetail where userDetail.id=post.uid and post.recycle=1 and post.tid='{$id}' ";
				// echo $SQL1;

				$result1=mysql_query($SQL1); 
				
                $row1=mysql_fetch_assoc($result1);
				
                $totals=$row1['total'];
                
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

                //置顶贴的遍历
                //$SQL2="select post.id,post.top,post.elite,post.ctime,post.title,post.uid,userDetail.name from post,userDetail where userDetail.id=post.uid and post.recycle=1 and post.top=1 and post.tid='{$id}'";
				$SQL2="select * from post where tid={$id}";
				$res2=mysql_query($SQL2);
                //if($res2 && mysql_num_rows($res2)>0){
                    while($arr2=mysql_fetch_assoc($res2)){
                         //找到每个贴子的发帖人的账户名
                         $USQL2="select userName from user where id=".$arr2['uid'];
                        $ures2=mysql_query($USQL2);
                        $uarr2=mysql_fetch_assoc($ures2);
                        
                        //找到最后的发帖时间
                        $SQL5="select ctime from reply where pid={$arr2['id']} order by ctime desc limit 1";
                        $res5=mysql_query($SQL5);
                        $arr5=mysql_fetch_assoc($res5);

                        //获得最后发帖和现在的时间差
                        $ctime=$arr5['ctime'];
                        $a=time()-$ctime;

                        //获得每个主题下的回复有多少
                        $SQL7="select count(*) as zong from reply where pid={$arr2['id']}";
                        $res7=mysql_query($SQL7);
                        $arr7=mysql_fetch_assoc($res7);

                        //获得每个主题下今天的回复有多少
                        $time=strtotime(date('Y-m-d'));
                        $jtime=strtotime(date('Y-m-d'))+24*60*60;
                        $SQL8="select count(*) as today from reply where pid={$arr2['id']} and ctime>{$time} and ctime<{$jtime}";
                        $res8=mysql_query($SQL8);
                        $arr8=mysql_fetch_assoc($res8); 
            ?>       
            <div class="huifutietouxia">
                <div class="huifutietouxia1">
				<!--   需要判断是否置顶  -->
					<?php
						$img = '<img src="../img/topicnew.gif">';
                        if($arr2['elite']==1){
                            $img = '<img src="../img/topichot.jpg">';
                        }
						if($arr2['top']==1){
                            $img = '<img src="../img/shangjiantou.jpg">';
                        }
						echo $img;
                    ?>
				
					&nbsp;
					<a href="../reply/detail.php?title=<?php echo $arr2['title']; ?>&fname=<?php echo $fname; ?>&bname=<?php echo $bname; ?>&pid=<?php echo $arr2['id']; ?> "><?php echo $arr2['title']; ?></a>
                </div>
                <div class="huifutietouxia2"> 
                <div><?php echo $uarr2['userName']; ?> </br>

                    <?php
                        //输出最后发帖距今天的时间
                        if($a<60){
                            echo $a.'秒前';
                        }else if($a<3600 && $a>=60){
                            echo floor($a/60).'分钟前';
                        }else if($a<(24*60*60) && $a>=3600){
                            echo floor($a/3600).'小时前';
                        }else if($a<(4*60*60*24) && $a>=(24*60*60)){
                            echo floor($a/(24*60*60)).'天前';
                        }else if($a>=(4*60*60*24)){
                            echo date('Y-m-d',$time);
                        }
                    ?>
                </div>
                    <div><?php echo $arr8['today'].'/'.$arr7['zong']; ?></div>
                    <div><?php echo $uarr2['userName'];?><br/><?php echo date('Y-m-d H:i:s',$arr2['ctime']); ?>
                    </div>
                </div>        
            </div>
           
            <?php                    
                    }
                //}
                
				 $sql="select post.id,post.top,post.elite,post.ctime,post.title,post.uid,userDetail.nickName from post,userDetail where userDetail.id=post.uid and post.recycle=1 and post.top=1 and post.tid='{$id}' limit ".($pagenum-1)*$pagesize.','.$pagesize;
                  $res=mysql_query($sql);
					if(mysql_num_rows($res)>0){
                    
                    while($arr=mysql_fetch_assoc($res)){
                       
                        
                         //找到最后的发帖时间
                        $SQL6="select ctime,uid from reply where pid={$arr['id']} order by ctime desc limit 1";
                        $res6=mysql_query($SQL6);
                        $arr6=mysql_fetch_assoc($res6);
                       
                        //获得最后发帖和现在的时间差
                        $btime=$arr6['ctime'];
                        $b=time()-$btime;
                        
                        //找到每个贴子的发帖人的账户名
                        //有回复的显示最后一个发帖人，没有的显示无回复；
                        $USQL="select userName from user where id=".$arr6['uid'];
                        $ures=mysql_query($USQL);
                        if($ures && mysql_num_rows($ures)>0){
                            $uarr=mysql_fetch_assoc($ures);
                        }else{
                            $uarr['userName']='无回复';
                        }
                        
                        //获得每个主题下的回复有多少
                        $SQL9="select count(*) as hzong from reply where pid={$arr['id']}";
                        $res9=mysql_query($SQL9);
                        $arr9=mysql_fetch_assoc($res9);

                        //获得每个主题下今天的回复有多少
                        $time=strtotime(date('Y-m-d'));
                        $jtime=strtotime(date('Y-m-d'))+24*60*60;
                        $SQL10="select count(*) as htoday from reply where pid={$arr['id']} and ctime>{$time} and ctime<{$jtime}";
                        $res10=mysql_query($SQL10);
                        $arr10=mysql_fetch_assoc($res10);



                ?>            
            <div class="huifutie1">
                <div class="huifutie1a">
                <?php      
                        //精华帖子循环
                    if($arr['elite']==2){
                        echo "<img src='../img/topichot.gif'>";
                        //非精华帖子循环
                    }else{
                        echo "<img src='../img/topicnew.gif'>";
                    }
                ?>
                <a href="../reply/detail.php?title=<?php echo $arr['title']; ?>>
				&fname=<?php echo $fname; ?>&bname=<?php echo $bname; ?>
				&pid=<?php echo $arr['id']; ?>"><?php echo $arr['title']; ?></a>
				
                </div>
                <div class="huifutie1b"> 
                    <div><?php echo $uarr['userName']; ?><br/>
                     <?php
					// var_dump($arr);
                        //输出最后发帖距今天的时间
                        if($b<60){
                            echo $b.'秒前';
                        }else if($b<3600 && $b>=60){
                            echo floor($b/60).'分钟前';
                        }else if($b<(24*60*60) && $b>=3600){
                            echo floor($b/3600).'小时前';
                        }else if($b<(4*60*60*24) && $b>=(24*60*60)){
                            echo floor($b/(24*60*60)).'天前';
                        }else if($b>=(4*60*60*24)){
                            echo date('m-d',$btime);
                        }
                    ?>

                    </div>
                    <div><?php echo $arr10['htoday'].'/'.$arr9['hzong']; ?></div>
                    <div><?php echo $arr['nickName']; ?><br/><?php echo date('Y-m-d',$arr['ctime']); ?>
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
                        <a href="./add.php?tid=<?php echo $id; ?>"><img src="../img/030.jpg"/></a>
                    </div>
                 </div>
           
        
        
        <div id="foot">
			<div id="foot2">     
			<p>联系我们|无图版|手机浏览|清除Cookies </p>
				<p>Powered by phpwind v8.7 Certificate Copyright Time now is:<?php echo date('m-d H:i:s',time()); ?><br/>
					@2006-2015 LAMP兄弟连 版权所有Gzip disabled 京ICP备11018177号 Total 0.022546(s) query 0,
				<img src="../img/pic.gif" /></p>
			</div>
        </div>       

        <?php mysql_close(); ?>
    </div>
    </body>
</html>
