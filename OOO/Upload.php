<?php
//自定义文件上传类

class Upload
{
    public $fileInfo = null; //上传文件信息
    public $path;
    public $typeList=array();
    public $maxSize;
    public $saveName;
    public $error = "未知错误！";

    public function __construct($filename)
    {
			 /*  var_dump($filename);
			  var_dump($_FILES);die; */
        $this->fileInfo = $_FILES[$filename]; //获取上传文件信息
			 
		//初始化上传信息
		$this->path="../../public/uploads/"; //上传储存路径
		$this->typeList = array("image/jpeg","image/png","image/gif"); //设置允许上传类型
		$this->maxSize =0; //允许上传大小
		
    }
      
    //判断上传错误号
    private function checkError()
    {
        if($this->fileInfo['error']>0){
            switch($this->fileInfo['error']){
                case 1: $info = "上传大小超出php.ini的配置！"; break; 
                case 2: $info = "上传大小超出表单隐藏域大小！"; break; 
                case 3: $info = "只有部分文件上传！"; break; 
                case 4: $info = "没有上传文件！"; break; 
                case 6: $info = "找不到临时存储目录！"; break; 
                case 7: $info = "文件写入失败！"; break; 
                default: $info = "未知错误！"; break;
            }
            $this->error = $info;
            return false;
        }
        return true;
    }
    //判断上传文件类型
    private function checkType()
    {
        if(count($this->typeList)>0){
            if(!in_array($this->fileInfo['type'],$this->typeList)){
                $this->error = "上传文件类型错误!";
                return false;
            }
        }
        return true;
    }
    //判断过滤上传文件大小
    private function checkMaxSize()
    {
        if($this->maxSize>0){
            if($this->fileInfo['size']>$this->maxSize){
                $this->error = "上传文件大小超出限制！";
                return false;
            }
        }
        return true;
    }

    //随机上传文件名称
    private function getName()
    {
        $ext = pathinfo($this->fileInfo['name'],PATHINFO_EXTENSION);//获取上传文件的后缀名
        do{
           $this->saveName = date("Ymdhis").rand(1000,9999).".".$ext;//随机一个文件名
        }while(file_exists($this->path.$this->saveName)); //判断是否存在
        return true;
    }
    //执行上传文件处理（判断加移动）
    private  function move()
    {
        //var_dump($this->fileInfo['tmp_name']);die;
        if(is_uploaded_file($this->fileInfo['tmp_name'])){
           
            if(move_uploaded_file($this->fileInfo['tmp_name'],$this->path.$this->saveName)){
				return true;
            }else{
                $this->error = "移动上传文件错误！";
            }
        }else{
            $this->error = "不是有效上传文件！";
        }
        return false;
    }
    
		 //执行上传
    public function doUpload()
    {
        $this->path = rtrim($this->path,'/')."/";//格式化路径
		
		
        return $this->checkError() && $this->checkType() && $this->checkMaxSize() && $this->getName() && $this->move() ;//
    
	}
}



//自定义图片处理类

class Image{
   private $info = array(); //被处理的图片信息
   private $srcim = null; //被处理的画布资源
   private $dstim = null; //目标画布资源（处理后的画布）
    
   //初始化方法
   public function open($pic){
        $this->info = getimagesize($pic); //获取被处理的图片信息
        //根据图片类型，使用对应的函数创建画布源。
        switch($this->info[2]){
            case 1: //gif格式
                $this->srcim = imagecreatefromgif($pic);
                break;
            case 2: //jpeg格式
                $this->srcim = imagecreatefromjpeg($pic);
                break;
            case 3: //png格式
                $this->srcim = imagecreatefrompng($pic);
                break;
           default:
                throw new Exception("无效的图片格式");
                break;
        }
        return $this;
   }
   
   //执行缩放方法
   public function thumb($maxWidth,$maxHeight){
        //获取原图片的宽和高
        $width = $this->info[0];
        $height= $this->info[1];
        // 计算缩放后的图片尺寸
        if($maxWidth/$width<$maxHeight/$height){
            $w = $maxWidth;
            $h = ($maxWidth/$width)*$height;
        }else{
            $w = ($maxHeight/$height)*$width;
            $h = $maxHeight;
        }
        //创建目标画布
        $this->dstim = imagecreatetruecolor($w,$h); 

        //5. 开始绘画(进行图片缩放)
        imagecopyresampled($this->dstim,$this->srcim,0,0,0,0,$w,$h,$width,$height);
        
        return $this;
   }
   
   //另存为
   public function save($saveFile){
        //输出图像另存为
        switch($this->info[2]){
            case 1: //gif格式
                imagegif($this->dstim,$saveFile);
                break;
            case 2: //jpeg格式
                imagejpeg($this->dstim,$saveFile);
                break;
            case 3: //png格式
                imagepng($this->dstim,$saveFile);
                break;
        }
   }
}



//实例化上传对象

//$upfile = new Upload("upic");
//$img = new Image();


//执行文件上传
//$res = $upfile->doUpload();//没有比例缩放前文件的上传
//$res1 = $upfile->path.$upfile->saveName;//获取没有缩放的文件地址
//$path = $upfile->path.$upfile->saveName;
//$saveFile = $upfile->path.'s_'.$upfile->saveName;

//执行比例缩放文件的上传
//$img->open($path)->thumb(300,300)->save($saveFile);


 //判断输出
/* if($res){
    echo  "上传成功！".$upfile->saveName;
}else{
    echo "上传失败！原因：".$upfile->error;
}  
 */


?>