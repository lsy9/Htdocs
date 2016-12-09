<?php
session_start();
     //匹配替换
     header('content-type:text/html;charset=utf-8');
	
/**检查上传文件错误****************************************************************/
	
	 $error = $_FILES['upload']['error'];
    //判断上传的错误号
    switch($error){
        case 1:
        case 2:
        case 3:
        case 6:
        case 7:
            exit('文件上传失败');
        break;
        case 4:
            exit('没有文件被上传');
        break;
    }

    //判断mime类型
    $mime = $_FILES['upload']['type'];
    $allowMime = array('image/jpeg','image/png','image/gif');

    if(!in_array($mime,$allowMime)){
        exit('文件类型不对');
    }
    //判断后缀名
    $type = explode('.',$_FILES['upload']['name']);
    $type = array_pop($type);//获得文件的后缀名

    $allowTypes = array('jpeg','jpg','png','gif');

    if(!in_array($type,$allowTypes)){
        exit('文件格式不对');
    }
    //判断他的大小
    $size = $_FILES['upload']['size'];//文件的大小
    $maxSize = 500000000;//设定的最大的文件的大小  (大小任意调节)

    if($size > $maxSize){
        exit('文件不符合大小');
    }
	//组合文件名
    $name = './'.$_FILES['upload']['name'];
    //将文件名进行转码
    $fileName = iconv('utf-8','GBK',$name);
    //最核心的一步就是使用move_uploaded_file将临时文件移动到你想到的地方就可以了。
    //判断是否通过http post方法上传上来的
    if(is_uploaded_file($_FILES['upload']['tmp_name'])){
        //获取一个随机文件名
        $newFileName = 'logo.png';

        move_uploaded_file($_FILES['upload']['tmp_name'],'../../home/img/'.$newFileName);

    
		
			//var_dump($SQL2);
			header('location:../include/main.php');
		}
	

 

	

	
?>