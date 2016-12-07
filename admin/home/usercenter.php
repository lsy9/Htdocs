<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            个人中心
        </title>
        <meta charset="utf-8"/>
        <link href="./css/usercenter.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="tou">
            <div id="tou1">
                <a href="./index.php"><img id="xdl" src="./img/usercenter/xdl.jpg"></a>
                <ul>
                    <li><a href="">培训课程</a></li>
                    <li><a href="">论坛</a></li>
                    <li><a href="">兄弟连云课堂</a></li>
                    <li><a href="">更多<img src="./img/usercenter/down.png"></a></li>
                </ul>   
                <img  id="yonghu" src="./img/usercenter/yonghu.jpg">
            </div>
            
             <?php
               
                 if((!isset($_SESSION['flag'])) || ($_SESSION['flag'] != md5($_SESSION['user']['userName']))){
                     //echo 'header("location:./login.php")';
                        }else{
                            $id=$_SESSION['user']['id'];
                ?>

                        <div id="tou2">
            
                                欢迎您：<a href=""><?php echo $_SESSION['userDetail']['nickName'] ?><img src="./img/usercenter/down.png"></a>
                                <a href="./exit.php">退出</a></li>
                                <a href="./editPwd.php">修改密码</a>
                                <a href="./update.php?id=<?php echo $_SESSION['user']['id'] ?>">设置个人资料<img src="./img/usercenter/down.png"></a>
                         
                            <img id="caise" src="./img/usercenter/caise.jpg">
                        </div>

                <?php
                     }
                  ?>
                
        </div>

        <div id="shen">
            <div id="shentou">
                <img id="geren" src="./img/usercenter/gerenzhongxin.jpg">
                <img id="chuanzhaopian" src="./img/usercenter/chuanzhaopian.jpg">
            </div>        
            
            <div id="renwulan">
                <div id="renwulanshang">
                    <span><a href=""><img src="./img/usercenter/shouye.jpg">首页</a></span>
                    <span><a href=""><img src="./img/usercenter/pengyou.jpg">朋友</a></span>
                    <span><a href=""><img src="./img/usercenter/shoucang.jpg">收藏</a></span>
                </div>
                <div id="renwulanzhong">
                    <span><a href=""><img src="./img/usercenter/xinxianshi.jpg">新鲜事</a></span>
                    <span><a href=""><img src="./img/usercenter/xiangce.jpg">相册</a></span>
                    <span><a href=""><img src="./img/usercenter/tiezi.jpg">帖子</a></span>
                    <span><a href=""><img src="./img/usercenter/huodong.jpg">活动</a></span>
                    <span><a href=""><img src="./img/usercenter/zuqun.jpg">群组</a></span>
                    <span><a href=""><img src="./img/usercenter/renwu.jpg">任务</a></span>
                    <span><a href=""><img src="./img/usercenter/daoju.jpg">道具</a></span>
                    <span><a href=""><img src="./img/usercenter/xunzhang.jpg">勋章</a></span>
                </div>
                <div id="renwulanxia">
                    <span><a href="">管理</a></span>
                </div>
            </div>        
            
            <div id="zhuye">
                <div id="touxianglan">
                    <img src="./img/usercenter/baozhatou.jpg">
                    <textarea cols=50 rows=1 placeholder="有什么新鲜事想告诉大家？"></textarea>
                    <div id="touxiangli">
                        <a href="" class="touxiangli">表情</a>
                        <a href="" class="touxiangli">链接</a>
                        <a href="" class="touxiangli">话题</a>
                        <a href="" class="touxiangli">图片</a>
                        <div id="shuzi">0/255</div>
                    </div>
                    <div id="zhuyi">
                        使用帐号关联可一键登录社区，并可同步内容到新浪微博、腾讯微博等各大热门站点，快来设置吧！
                    </div>
                </div>
                <div id="xinxianshi">
                    <a href="" id="xinshi">新鲜事</a>
                    <a href="" class="qb">全部</a>
                    <a href="" class="qb">文字</a>
                    <a href="" class="qb">图片</a>
                    <a href="" class="qb">更多筛选<img src="./img/usercenter/down.png"></a>
                    <div><img src="./img/usercenter/445.jpg"></div>
                </div>
                <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>

                <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
				
                <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
               <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
                <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
                <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
               <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
                <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
                <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
             <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
				<div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
                <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
                <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
                <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
                <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
             <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
                <div class="zhuyelou">
                    <img src="./img/usercenter/houzi.jpg">
                    <span><a class="hu" href="">aaaa</a>：一期项目</span>
                    <div class="zhuyelouxia">
                        <div class="zhuyelouxia1">
                            新鲜事
                        </div>
                        <div class="zhuyelouxia2">
                            <a href="">转发</a>
                            <a href="">收藏</a>
                            <a href="">评论</a>
                        </div>
                    </div>                
                </div>
                <div id="zhuyeyema">
                    <a href="">1</a>
                    <a href="">2</a>
                </div>
            </div>        
            
        
            <div id="xinxi">
                <div id="bai">
                    <div id="bai1">李正佳</div>
                    <div id="bai2">
                        <div><a href="">2</a><br/>关注</div>
                        <div><a href="">2</a><br/>粉丝</div>
                        <div><a href="">1</a><br/>好友</div>
                    </div>
                    <div id="bai3">
                        <img src="./img/usercenter/fangzi.jpg">
                    </div>
                    <div id="bai4">
                        兄弟连粮票：<a href="">79</a><br/>
                        级别：<a href="">下士</a>
                    </div>
                    <div id="bai5">
                        <img src="./img/usercenter/tongyong.jpg">
                    </div>
                    <div id="bai6">热门话题</div>
                    <div id="bai7">
                        <img src="./img/usercenter/chaxinxianshi.jpg">
                    </div>
                </div>
                <div id="lan">
                    <div id="lan1">
                        <a href="" id="lan1a">可申请的任务</a>
                        <a href="" id="lan1b">更多</a>
                    </div>
                    <div id="lan2">
                        <a href="" id="lan2a">论坛每日红包</a>
                         <img src="./img/usercenter/jinbi.jpg">
                     </div>
                     <div id="lan3">
                        <a href="" id="lan3a">个人标签</a>
                        <a href="" id="lan3b">管理</a>
                    </div>
                    <div id="lan4">
                        贴上标签，展示个性，找到更多共同爱好的人！
                    </div>
                     <div id="lan5">
                        <a href="" id="lan5a">最近访客</a>
                        <a href="" id="lan5b">累计访客(6)</a>
                    </div>
                    <div class="lan6">
                        <div class="lan6a">
                            <img src="./img/usercenter/hongren.jpg"><br/>
                            <a href="">sss_g</a><br/>
                            01-05
                        </div>  
                        <div class="lan6a">
                            <img src="./img/usercenter/heiren.jpg"><br/>
                           <a href="">cccc_9</a><br/>
                            2014-12-15
                        </div>  
                      <div class="lan6a">
                            <img src="./img/usercenter/lanren.jpg"><br/>
                            <a href="">gggg_s</a><br/>
                            2014-12-14
                        </div>    
                    </div>
                     <div class="lan6">
                        <div class="lan6a">
                            <img src="./img/usercenter/ren1.jpg"><br/>
                            <a href="">ddd_8</a><br/>
                            2014-11-22
                        </div>  
                        <div class="lan6a">
                            <img src="./img/usercenter/dog.jpg"><br/>
                           <a href="">hhhh_96</a><br/>
                            2014-11-05
                        </div>  
                      <div class="lan6a">
                            <img src="./img/usercenter/ren2.jpg"><br/>
                            <a href="">kkk_8</a><br/>
                            2014-08-07
                        </div>    
                    </div>
                    <div id="lan7">
                        <a href="" id="lan7a">可能感兴趣的人</a>
                        <a href="" id="lan7b">更多</a>
                    </div>
                    <div class="lan8">
                        <img class="lan8a" src="./img/usercenter/gaoluofeng.jpg">
                        <div class="lan8b">
                            <a href="">高洛峰</a><br/>
                            学习PHP，并快乐着！<br/>
                            <img  src="./img/usercenter/guanzhu.jpg">
                        </div>    
                    </div>
                    <div class="lan8">
                        <img class="lan8a" src="./img/usercenter/liming.jpg">
                        <div class="lan8b">
                            <a href="">李明</a><br/>
                            让学习成为一种习惯<br/>
                            <img  src="./img/usercenter/guanzhu.jpg">
                        </div>    
                    </div>
                    <div class="lan8">
                        <img class="lan8a" src="./img/usercenter/tu1.jpg">
                        <div class="lan8b">
                            <a href="">海峰</a><br/>
                            个性签名<br/>
                            <img  src="./img/usercenter/guanzhu.jpg">
                        </div>    
                    </div>
                    <div id="lan9">
                        <a href=""><img src="./img/usercenter/yaoqing.jpg"></a>
                    </div>    
                    <div id="lan10">
                        <a href="" id="lan10a">好友生日</a><br/>
                        <div id="lan10b">最近没有好友过生日！</div>
                    </div>

                </div>
            </div>
        </div>


        <div id="foot">
            
            <div id="foot2">
                  <p>联系我们|无图版|手机浏览|清除Cookies </p>
				<p>Powered by phpwind v8.7 Certificate Copyright Time now is:03-20 15:09<br/>
					@2006-2015 LAMP兄弟连 版权所有Gzip disabled 京ICP备11018177号 Total 0.022546(s) query 0,
				<img src="./img/pic.gif" /></p>
            </div>
        </div>      


        
       
    </body>
</html>
