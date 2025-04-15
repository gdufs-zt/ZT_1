<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>

<body>


    <p>文件夹下的所有图片显示<a href="user_table.php">返回</a> </p>

    <?php
    $path = './image/';
    $n = 0;
    if ($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {

                echo "<img src='{$path}$file'  width='200' height='150'>{$file}   \n";
                $n++;
                if ($n % 3 == 0)
                    echo "<p>";
            }
        }
        closedir($handle);
    }
    ?>

</body>

</html>