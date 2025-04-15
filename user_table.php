<?php
require_once("conn.php");
?>
<!doctype html>
<html>


<head>
    <meta charset="utf-8">
    <title>select </title>
    <style>
        table {
            width: 900px;
            border-collapse: collapse;
            margin: 0 auto;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        img {
            width: 60px;
            height: auto;
        }

        a {
            text-decoration: none;
            color: blue;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <table width="900" border="1">

        <?php
		$sql = "SELECT * FROM users";
		//$sql = "SELECT * FROM users  where username='1'";
		//$sql = "SELECT * FROM users  where id={$_SESSION['id']}";  
		$result = mysqli_query($conn, $sql);

		while ($row = mysqli_fetch_array($result)) {
		?>

        <tr>
            <td>
                <?php echo $row['userID']; ?>
            </td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['photo']; ?></td>
            <td><img src="<?php echo $row['photo']; ?>" width="60"></td>
            <td>
                <a href="userdelete2.php?id=<?php echo $row[ 'userID' ]; ?> ">删除</a>
            </td>
            <td>
				<a href="userupdate2.php?id=<?php echo $row[ 'userID' ]; ?> ">更新</a>
			</td>
        </tr>
        <?php
		}
		mysqli_close($conn);
		?>

    </table>
    <p><a href="userphoto.php">查看已有图片</a></p>
</body>

</html>