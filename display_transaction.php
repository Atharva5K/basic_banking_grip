<?php
	require 'db_connection.php';
?>

<html>
	<head>
		<title>Customer</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	    <style type="text/css">
		<style type="text/css">
	    	
	    	table 
	    		{
				  border-collapse: collapse;
				  width: 50%;
				}

			th, td 
				{
				  padding: 8px;
				  text-align: left;
				  border-bottom: 1px solid #ddd;
				}

			tr:hover {background-color:#f5f5f5;}

			body 
				{
				  background-color: rgb(240, 240, 240);
				  margin-left: 80px;
				}
	    </style>
	</head>

	<body>

		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand">GRIP</a>
		    </div>
		    <ul class="nav navbar-nav">
		      <li><a href="home.php">Home</a></li>
		      <li class="active"><a href="display_customer.php">Display all transactions</a></li>
		    </ul>
		  </div>
		</nav>

		<h4>Customer List</h4>

		<?php
			
			session_start();
			$conn=connect_db();
			$sql='Select * from transfer';
			$result=$conn->query($sql);
			$row=$result->fetch_assoc();

			if($sql)
			{
				echo "<table>";
            	echo "<tr>";
            	echo "<th> Transaction Number </th>";
                echo "<th> Transaction from </th>";
                echo "<th> Transaction to </th>";
                echo "<th> Value of transaction </th>";
                echo "<th> Status </th>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>".$row['transaction_number']."</td>";
                echo "<td>".$row['from_name']."</td>";
                echo "<td>".$row['to_name']."</td>";
                echo "<td>".$row['value_trand']."</td>";
                echo "<td>".$row['STATUS']."</td>";
                echo "</tr>";
                while($row=$result->fetch_assoc()) 
                {
                	echo "<tr>";
	                echo "<td>".$row['transaction_number']."</td>";
	                echo "<td>".$row['from_name']."</td>";
	                echo "<td>".$row['to_name']."</td>";
	                echo "<td>".$row['value_trand']."</td>";
	                echo "<td>".$row['STATUS']."</td>";
                	echo "</tr>";
                	//$row=$result->fetch_assoc();
                }

                
                echo "</table>";
			}
			
		?>

		<footer class="text-center text-white fixed-bottom" style="background-color: #21081a;">
		  <div class="container p-4"></div>
		  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); color: white;">
		    © 2021 Copyright, Atharva Keskar
		  </div>
		</div>
		</footer>

	</body>
</html>