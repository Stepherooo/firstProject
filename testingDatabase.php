<!DOCTYPE html>
<html lang="en">
<head>
	<title>Blah</title>
	<style>
		body {
			background-image: url('http://4.bp.blogspot.com/-HTvSYzA-pO4/UgQb4Zh_u0I/AAAAAAAAEuI/XwhtogT_1tA/s1600/3+cute2.jpg');
			background-repeat: no-repeat;
			background-size: cover;
		}
		td:nth-child(even){
			background-color: #cccccc;
			color: #000000;
			width: 400px;
		}
		
		td:nth-child(odd) {
			width: 50px;
		}
	</style>
</head>
<body>
	<table style="border: 1px solid black;">
		<tr><th>ID</th><th>Title</th></tr>
		<?php
			// Table class to make things pretty
			class TableRows extends RecursiveIteratorIterator {
				function __construct($it) {
					parent::__construct($it, self::LEAVES_ONLY);
				}
				
				function current() {
					return "<td style='text-align: center;
							border: 1px solid black;'>"
								. parent::current() . "</td>";
					
				}
				
				function beginChildren() {
					echo "<tr>";
				}
				
				function endChildren() {
					echo "</tr>";
				}
			}
			
		    $servername = "localhost";
			$dbname = "gan1832";
			$username = "gan1832";
			$password = "sleepyOwl12";
			
			try {
				$conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT movieID, title FROM movies");
				$stmt->execute();
				
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
					echo $v;
				}
			}
			
			catch(PDOException $e) {
				echo "Error!: " . $sql . "<br>" . $e->getMessage();
			}
			
			$conn = null;
		?>
	</table>
</body>
</html>