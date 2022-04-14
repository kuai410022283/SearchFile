<?php
/*
*$_GET['name'];//文件名字 [附带了参数值：true:显示全部]
*$_GET['value'];//文件json值得属性["name","extension","Size","Url","Create Date"]
*$_GET['dir'];//目录名称
*$_GET['search'];//搜索文件
*$_GET['type'];//类型,扩展名
*/
//显示json所有数据
//header('Content-type:text/json');
//获取文件名字
$filename = $_GET['name'];
//文件json属性
$value = $_GET['value'];//获取的值
$type=$_GET['$type'];//获取扩展名参数

//目录名称
$dir=$_GET['dir'];
//不建议dir使用空值,这样会默认使用根目录,导致外网连接不可用;
$root=dirname(__FILE__);//指向程序文件所在的根目录
//定义外网连接(网站域名或IP,带http/s);
$urlhost="https://xxx.xxxx.com/";

if ($dir=='.' || $dir=='..' || $dir=='/' ){
    die("无dir参数或参数错误。");
}else{
    
    if ($dir=="" ){
        $dir='file';
        //$dirroot=1;
    }
    //显示json所有数据
    header('Content-type:text/json');
    if ($filename <> "" or $filename <> null) {
    	//echo "<pre>";
    	$arr = my_scandir($dir);
    	//文件路径即可
    	//过滤数组为空的值
    	if ($arr != null){
    	    $arr_file = filelist($arr, 99);
    	}
    } else {
    	die("未找到到文件信息!");
    }
}
//过滤遍历数据后的数组
function filelist($arr, $key) {
    $z=count($arr);
    if (!is_numeric ($z)){
        $z=1;
    }
	for ($i = 0;$i <= $z;$i++) {
		if (is_array($arr[$i]) == true) {
			filelist($arr[$i], 99);
		} else {
			$x = json_file($arr[$i]);
			//print_r ($arr_name);
		}
	}
	if ($x <> $key) {
		$i = $z + 1;
	}
}

//输出json值
function json($json){
    foreach ($json as $key => $value) {
                        
    $json[$key] = urlencode($value);
    				    
    }
    			    
    echo urldecode(json_encode($json));
    			    
  $jsonx = 999;
  return $jsonx;
}

//配合筛查数据,对数组进行逐级处理
function json_file($file) {
	if ($file != "") {

		//$url="./";内连接
		//外部路径链接
		if ($GLOBALS['dirroot']==1){
		    $urls =  $file;
		}else{
    		//外连接
    		$url = $GLOBALS['urlhost']; 
    		//$url = "https://api.laoknas.com/"; 
    		$urls = $url . $file;
		}

		$arr_file_info = pathinfo($file);
		//文件名(不带扩展名);
		$name = $arr_file_info["filename"];
		//文件名(带扩展名);
		$names=$arr_file_info["basename"];
		//获取文件大小
		$size = trans_byte(filesize($file));
		//获取文件创建时间
		$create_date = date("Y-m-d H:i:s", filectime($file));
		//定义json数组信息
		//$extension扩展名
		$extension=$arr_file_info["extension"];
		
		//name=true时,进行判断
		if ($_GET['name'] == "true"){
		    
            //判断type是否有值
    		if ($_GET['type'] == null){
    		    // value≠null;
    		    if ($_GET['value']<>null){
    		    
    		        switch ($_GET['value']) {
            				case "name":
            				                    echo $names."\n";  //只输出名字
            				break;
            				case "extension":
            				                    echo $extension."\n"; //只输出扩展名
            				break;
            				case "size":
            				                    echo $size."\n"; //只输出大小
            				break;
            				case "url":
            				                    echo $urls."\n"; //只输出连接
            				break;
            				case "date":
            				                    echo $create_date."\n"; //只输出创建日期
            				break;
            				default:
                                			    //无输出
                                			    //$json = array("Name" => $names, "Extension" => $extension, "Size" => $size, "Url" => $urls, "Create Date" => $create_date);
            	    }
            	//value=null; 
                }else{
            	     $json = array("Name" => $names, "Extension" => $extension, "Size" => $size, "Url" => $urls, "Create Date" => $create_date);
    			     $jsonx=json($json);
            	}
    		//type≠null;  
    		}else{
    		    //value≠null;
    		    if ($_GET['value']==null){
    		        
                    //判断类型
    		        //echo $_GET['type'];
    		        if ($extension==$_GET['type']){
                        $json = array("Name" => $names, "Extension" => $extension, "Size" => $size, "Url" => $urls, "Create Date" => $create_date);
    			        $jsonx=json($json);
    			    }
    		    // value≠null;  
                }else{
    		        
    		        if ($extensione==$_GET['type']){
    		    
    		            switch ($_GET['value']) {
            				case "name":
            				                    echo $names."\n";  //只输出名字
            				break;
            				case "extension":
            				                    echo $extension."\n"; //只输出扩展名
            				break;
            				case "size":
            				                    echo $size."\n"; //只输出大小
            				break;
            				case "url":
            				                    echo $urls."\n"; //只输出连接
            				break;
            				case "date":
            				                    echo $create_date."\n"; //只输出创建日期
            				break;
            				default:
                                			   echo '无输出';
                                			    //$json = array("Name" => $names, "Extension" => $extension, "Size" => $size, "Url" => $urls, "Create Date" => $create_date);
            	        }
            	    
            	    }
    		    
    		    }
    		}
        // name≠true;    
		}else{ //name不为true时
    			//value读取属性值
    			if ($names == $_GET['name']) { //匹配带有扩展名的文件名
        			if ($_GET['value']<>""){
            			switch ($_GET['value']) {
            				case "name":
            				                    echo $names;  //只输出名字
            				break;
            				case "extension":
            				                    echo $extension; //只输出扩展名
            				break;
            				case "size":
            				                    echo $size; //只输出大小
            				break;
            				case "url":
            				                    echo $urls; //只输出连接
            				break;
            				case "date":
            				                    echo $create_date; //只输出创建日期
            				break;
            				default:
                                			    //无输出
                                			    //$json = array("Name" => $names, "Extension" => $extension, "Size" => $size, "Url" => $urls, "Create Date" => $create_date);
            			}
    			    }else{
    			        
    			        $json = array("Name" => $names, "Extension" => $extension, "Size" => $size, "Url" => $urls, "Create Date" => $create_date);
    			        $jsonx=json($json);
    			        
    			    }
    		} 

		} //name不为true时  
	}
	return $jsonx;
}
//获取文件大小
function trans_byte($byte) {
	$KB = 1024;
	$MB = 1024 * $KB;
	$GB = 1024 * $MB;
	$TB = 1024 * $GB;
	if ($byte < $KB) {
		return $byte . "B";
	} elseif ($byte < $MB) {
		return round($byte / $KB, 2) . "KB";
	} elseif ($byte < $GB) {
		return round($byte / $MB, 2) . "MB";
	} elseif ($byte < $TB) {
		return round($byte / $GB, 2) . "GB";
	} else {
		return round($byte / $TB, 2) . "TB";
	}
}
//遍历目录文件
function my_scandir($dir) {
	//定义一个数组
	$files = array();
	//检测是否存在文件
	if (is_dir($dir)) {
		//打开目录
		if ($handle = opendir($dir)) {
			//返回当前文件的条目
			while (($file = readdir($handle)) !== false) {
				//去除特殊目录
				if ($file != "." && $file != ".." && $file != "@eaDir" && $file != ".php" && $file != "文档资料" && $file != ".js" && $file != ".sh"  && $file != ".css"  && $file != ".html") {
					//判断子目录是否还存在子目录
					if (is_dir($dir . "/" . $file)) {
						//递归调用本函数，再次获取目录
						//$files[$file] = my_scandir($dir . "/" . $file);
						//my_scandir($dir."/".$file);
						$arr[] = my_scandir($dir . "/" . $file);
					} else {
						//获取目录数组
						$arr[] = $dir . "/" . $file;
					}
				}
			}
			//关闭文件夹
			closedir($handle);
			//返回文件夹数组
			return $arr;
		}
	}
}
?>
