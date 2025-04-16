<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>select </title>
</head>

<body>
	<table width="900" border="1">
		<tbody>
			
			<?php
			$conn = mysqli_connect( "localhost", "root", "" );
			if ( !$conn ) {
				die( '不能连接数据库: ' . mysqli_error() );
			}
			mysqli_select_db( $conn, "my_db" );
			$result = mysqli_query( $conn, "SELECT * FROM 商家" );

			while ( $row = mysqli_fetch_array( $result ) ) {
				?>

			<tr>
				<td>
					<?php echo $row[ '用户名' ]; ?>
					
				</td>
				<td><?php echo $row[  '密码' ]; ?></td>
			</tr>
				<?php
			}
			mysqli_close( $conn );
			?>


