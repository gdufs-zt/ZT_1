<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>


<p>如何把文件夹下的每个图片显示出来,增加几幅图到image文件夹，查看效果,<a href="菜单table.php">上传图片</a> </p>

<?php
$path='./images/';
$n=0;
if ($handle = opendir($path)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            echo "<img src='{$path}$file'  width='200' height='150'>     \n";
            $n++;
            if ($n%3==0)
                echo "<p>";

        }
    }
    closedir($handle);
}
?>

</body>
</html>