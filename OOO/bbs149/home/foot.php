		<?php
			//1. 连接数据库，并判断
			$link = mysqli_connect("localhost","root","") or die("数据库连接失败！");
	
			//2. 设置字符集
			mysqli_set_charset($link,"utf8");
		
			//3. 选择数据库
			mysqli_select_db($link,"bbs");
			
			//4.定义sql语句，发送并执行
			$sql = "select * from config";
			$result = mysqli_query($link,$sql);
			
			//5.解析结果集
			if($result && mysqli_num_rows($result)>0){
				
				$row = mysqli_fetch_assoc($result);
				
			}
		?>
		
		<div id="footer">
			<center>
				<p>
					联系我们|无图版|手机浏览|清除Cookies<br/>
					Powered by phpwind v8.7 Certificate Copyright Time now is:02-17 19:40 <br/>
					<?php echo $row['copy']?> 版权所有 Gzip disabled 京ICP备11018177号 Total 0.072194(s) query 3,<img src="../public/home/img/pic.gif"/>京公网安备11011402000177
				</p>
			</center>
		</div>