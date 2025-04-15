<?php
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png"))
    && ($_FILES["file"]["size"] < 40960000)
    && in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：： " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        $UploadPath = "./images/";
		$source_filename = $_FILES['file']['tmp_name'];
		$userid = $_POST['菜名'];
		$randname = time();
		$randname=date("Ymd_His",time());
		$newfilename = $userid . "_" . $randname;
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		$newfilename = $newfilename . "." . $extension;
		$dest_filename = $UploadPath . $newfilename;

		if (file_exists($dest_filename)) {
			echo $dest_filename . "已经存在,请重新命名再上传";
		} else {
			move_uploaded_file($source_filename, $dest_filename);
		}
    }
}
else
{
    echo "非法的文件格式";
}
?>
