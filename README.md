# SearchFile
是一个遍历服务器文件的程序，输出json格式数据。
<h3>简单说明</h3>
我们把SearchFile.php文件放到已配置好的php服务器环境下。访问他。
通过GET传递参数，进行查找服务器中的文件。
这里已经有了注释
*$_GET['name'];//文件名字 [附带了参数值：true:显示全部]
*$_GET['value'];//文件json值得属性["name","extension","Size","Url","Create Date"]
*$_GET['dir'];//目录名称
*$_GET['search'];//搜索文件
*$_GET['type'];//类型,扩展名

//定义外网连接(网站域名或IP,带http/s);
$urlhost="https://xxx.xxxx.com/";   这里要修改成你可以外网访问到的地址，当然局域网也可以是IP。


<h3>使用方法</h3>
举例：我们访问 https://xxx.xxxx.com/SearchFile.php?dir=image&name=true

传递进去了2个参数，分别是dir，name
dir默认是“\” 一般默认为根目录，当然如果要指定目录，也可以修改。

上面的连接中 dir=image 指的是 在image目录下 搜索所有文件名  也就是 name=true   这里包括该文件夹下的所有子目录及文件。

结果以json格式数据显示在浏览器中。
name=true  也可以等于已知的文件名，当然一定要完整的文件名称，包括文件扩展名在内。

如图所示：
图1
![image](https://user-images.githubusercontent.com/66707076/163385403-b0990846-d1a1-480d-9883-99a8ba0d37d1.png)

图2
![image](https://user-images.githubusercontent.com/66707076/163385515-ea6f3407-be23-42ec-bc15-4616614410e2.png)

*$_GET['value'];在value参数中是可以单独显示json输出对象中的某个值，也就是["name","extension","Size","Url","Create Date"]
https://xxx.xxxx.com/SearchFile.php?dir=image&name=xxx.png&value=Url 
这样就会只显示出Url的值。
![image](https://user-images.githubusercontent.com/66707076/163386927-dfc34c0d-f7f1-4d56-9b87-1737aa7e54dc.png)

*$_GET['type'];//类型,扩展名.方法与上面的都类似。
![image](https://user-images.githubusercontent.com/66707076/163387353-f00275d4-05c2-4d2d-b3d5-b278df21d220.png)

更多使用方法和玩法，自己去看源码吧~
也可以通过以上的源码，更完善一些功能。



