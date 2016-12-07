<?php
    /**
     * 获取用户等级
     * @param int $level 用户等级代码
     * @return string $level 用户等级
     */
    function getLevel($level){
        switch ($level) {
            case 0:
                $level = '注册会员';
            break;
            case 1:
                $level = '管理员';
            break;
            case 2:
                $level = '青铜会员';
            break;
            case 3:
                $level = '白银会员';
            break;
            case 4:
                $level = '黄金会员';
            break;
            case 5:
                $level = '钻石会员';
            break;
        }
        return $level;
    }

    /**
     * 获取会员性别的函数 getSex()
     * @param int $sex 性别代码
     * @return string $sex 性别
     */
    function getSex($sex){
        switch ($sex) {
            case 1:
                $sex = '男';
            break;
            case 2:
                $sex = '女';
            break;
            default:
                $sex = '保密';
            break;
        }
        return $sex;
    }

    /**
        定义一个文件上传函数 uploadFile(),实现文件上传
        @param array $file 文件上传后的信息 $file = $_FILES['userpic']
        @param string $path 指定文件上传后存放的路径
        @param array $allowType 允许上传的文件类型
        @param int $maxSize 允许上传的文件的大小 默认值为$maxSize=0,不限定文件大小
        @return array $info 上传成功时返回新文件名和成功的标志，失败时返回上传失败的原因和错误的标志
     */
    function uploadFile($file,$path,$allowType,$maxSize=0){
        // 设定$info
        $info = array(
            'isok' => false,	// 上传成功还是上传失败的标志
            'message' => ''		// 失败时接收错误原因，成功时返回新的文件名
        );

        // 处理存储的路径
        $path = rtrim($path,'/').'/';


        // 第一步 判断错误号 --- 是否上传成功
        if($file['error']!=0){
            // 使用switch()结构依次判断错误号
            switch($file['error']){
                case 1:
                    $info['message'] = '你的太大了，PHP受不了啊！';
                break;
                case 2:
                    $info['message'] = '太大了，连HTML都受不了了!';
                break;
                case 3:
                    $info['message'] = '进来了吗？---只有一点点!';
                break;
                case 4:
                    $info['message'] = '不上传文件，你干嘛来了!';
                break;
                default :
                    $info['message'] = '知道UFO吗--未知错误';
                break;
            }

            // 返回错误信息，终止程序
            return $info;
        }

        // 第二步 判断文件的类型
        // 如果用户没有限定类型
        if(empty($allowType)){
            // 当用户没有限定类型时，自动设定允许上传的类型为$allowType
            $allowType=array('image/jpeg','image/gif','image/png');
        }

        if(!in_array($file['type'],$allowType)){
            $info['message'] = '型号不对！';

            // 返回错误信息，终止程序
            return $info;
        }

        // 第三步 判断文件的大小 ---- 默认不限定大小
        if($maxSize!=0&&$file['size']>$maxSize){
            $info['message'] = '太大了，彭波一个人受不了啊！带上张朋吧！';

            // 返回错误信息，终止程序
            return $info;
        }

        // 第四步 判断文件是否是通过HTTP POST方式传递
        if(!is_uploaded_file($file['tmp_name'])){
            $info['message'] = '不允许走后门！';

            // 返回错误信息，终止程序
            return $info;
        }

        // 第五步 给文件生成一个随机文件名
        // 时间戳+随机数 + 后缀名
        $hz = pathinfo($file['name'],PATHINFO_EXTENSION);	// 获取后缀名
        do{
            $newname = date('YmdHis').rand(1000,9999).'.'.$hz;
        }while(file_exists($path.$newname));

        // 第步 移动文件到指定目录
        if(move_uploaded_file($file['tmp_name'],$path.$newname)){
            // 设定上传文件的标志 true
            $info['isok'] = true;

            // 获取新生成的文件名
            $info['message'] = $newname;

            // 返回成功的信息
            return $info;
        }else{
            // 错误原因
            $info['message'] = '移动文件失败';

            // 返回错误信息
            return $info;
        }
    }


    /**
        定义一个等比缩放图片函数 imageResize()
        @param string $pic 源图片
        @param tring $path 缩放后存放的路径
        @param int $w 缩放后的宽度
        @param int $h 缩放后的高度
        @param string $prefix 生成的缩放文件前缀
     */
    function imageResize($pic,$path,$w,$h,$prefix='s_'){
        // 第一步 获取$pic的图片类型
        $info = getimagesize($pic);

        // 第二步 根据图片类型$info['mime']创建源图片画布;
        switch($info['mime']){
            case 'image/jpeg':
                $im = imagecreatefromjpeg($pic);
            break;

            case 'image/png':
                $im = imagecreatefrompng($pic);
            break;

            case 'image/gif':
                $im = imagecreatefromgif($pic);
            break;
        }

        // 第三步 获取原图片的宽高
        $width = imagesx($im);
        $height = imagesy($im);

        // 第四步 获取缩放后的实际宽高
        if($width/$w>$height/$h){
            $h = $height*$w/$width;
        }else{
            $w = $width*$h/$height;
        }

        // 第五步 创建实际的目标画布
        $dst = imagecreatetruecolor($w,$h);

        imagecopyresampled($dst,$im,0,0,0,0,$w,$h,$width,$height);


        // 第六步 获取源图片的文件名
        $filename = pathinfo($pic,PATHINFO_BASENAME);

        // 第七步 处理目标存放路径
        $path = rtrim($path,'/').'/';

        // 第八步 输出保存图片
        imagejpeg($dst,$path.$prefix.$filename);
    }

// ================ 数据库函数 =====================

    /**
     * getAll  获取所有查询结果
     * @param  result $link   mysqli连接资源
     * @param  string $table  数据表
     * @param  array  $fields 要查询的字段，默认为所有字段
     * @param  string $where  查询条件
     * @return mixed          返回查询结果
     */
    function getAll($link,$table,$fields='*',$where='',$order='',$limit=''){
        // 判断是否存在where条件
        if(!empty($where)){
            $where  = ' where ' . $where;
        }
        
        // 判断是否存在排序
        if(!empty($order)){
            $order  = ' order by ' . $order;
        }

        // 判断是否存在limit
        if(!empty($limit)){
            $limit  = ' limit ' . $limit;
        }

        // 拼接sql语句
        $sql = 'select ' . $fields . ' from ' . $table . $where . $order . $limit;

        // echo $sql;
        $result = mysqli_query($link,$sql);

        // 接收数据
        $all = array();

        // 检查是否查询成功
        if($result && mysqli_num_rows($result)>0){
            while ($row = mysqli_fetch_assoc($result)) {
                $all[] = $row;
            }
            // 返回结果
            return $all;
        } else {
            return null;
        }
    }

    /**
     * getRow  获取一条查询结果
     * @param  result $link   mysqli连接资源
     * @param  string $table  要查询的数据表
     * @param  array  $fields 要查询的字段
     * @param  string $where  要查询的条件
     * @return mixed          查询的结果
     */
    function getRow($link,$table,$fields='*',$where='',$order='',$limit=''){
        // 判断是否存在where条件
        if(!empty($where)){
            $where  = ' where ' . $where;
        }
        
        // 判断是否存在排序
        if(!empty($order)){
            $order  = ' order by ' . $order;
        }

        // 判断是否存在limit
        if(!empty($limit)){
            $limit  = ' limit ' . $limit;
        }

        // 拼接sql语句
        $sql = 'select ' . $fields . ' from ' . $table . $where;
        $result = mysqli_query($link,$sql);

        // 检查是否查询成功
        if($result && mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            // 返回结果
            return $row;
        } else {
            return null;
        }
    }

    /**
     * getOne  查询一个值
     * @param  result $link  mysqli连接资源
     * @param  string $table 要操作的表名
     * @param  string $field 要查询的字段
     * @param  string $where 要查询的条件
     * @return mixed         查询的结果
     */
    function getOne($link,$table,$field,$where='',$order='',$limit=''){
        // 判断是否存在where条件
        if(!empty($where)){
            $where  = ' where ' . $where;
        }
        
        // 判断是否存在排序
        if(!empty($order)){
            $order  = ' order by ' . $order;
        }

        // 判断是否存在limit
        if(!empty($limit)){
            $limit  = ' limit ' . $limit;
        }

        // 拼接sql语句
        $sql = 'select ' . $field . ' from ' . $table . $where;
        $result = mysqli_query($link,$sql);

        // 检查是否查询成功
        if($result && mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);

            // 返回结果
            $row = array_values($row);
            return $row[0];
        } else {
            return null;
        }
    }

    /**
     * getTree 获取家谱树
     * @param  resource $link   mysqli连接资源 
     * @param  int      $tid    指定栏目id
     * @return array    $tree   查询结果
     */
    function getTree($link,$tid){
        $tree=array();
        $row = getRow($link,'shop_types','id,typename,pid',"id={$tid}");

        if($row['pid']!=0){
         $tree[] = $row;
         $tree=array_merge(getTree($link,$row['pid']),$tree);
        } else {
         $tree[] = $row['typename'];
        }
        return $tree;
    }

    /**
     * getCateTree     获取子孙树
     * @param  resource  $link  mysqli连接资源
     * @param  array     $arr   要进行查询的所有商品
     * @param  integer   $id    分类id
     * @param  integer   $level 分类级别
     * @return           最终保留结果
     */
    function getCateTree($arr,$id=0,$level=0){
        $tree = array();
        // var_dump($arr);
        // 遍历输出分类
        foreach($arr as $value){
            if($value['pid'] == $id){
                $value['level'] = $level;   // 设置分类级别

                $tree[] = $value;
                $tree = array_merge($tree,getCateTree($arr,$value['id'],$level+1));
            }
        }

        return $tree;
    }

// ================ 数据库函数结束 =================