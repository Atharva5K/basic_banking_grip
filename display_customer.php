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

			.button 
				{
				  background-color: #4CAF50; /* Green */
				  border: none;
				  color: white;
				  padding: 16px 32px;
				  text-align: center;
				  text-decoration: none;
				  display: inline-block;
				  font-size: 16px;
				  margin: 4px 2px;
				  transition-duration: 0.4s;
				  cursor: pointer;
				}

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
		      <li class="active"><a href="display_customer.php">Display all customers</a></li>
		    </ul>
		  </div>
		</nav>

		<div class='content'>
		<h4>Customer List</h4>

		<?php
			
			session_start();
			$conn=connect_db();
			$sql='Select * from customer';
			$result=$conn->query($sql);
			$row=$result->fetch_assoc();

			if($sql)
			{
				echo "<table>";
            	echo "<tr>";
            	echo "<th> Account Number </th>";
                echo "<th> Name </th>";
                echo "<th> Email id </th>";
                echo "<th> Current Balance </th>";
                echo "<th> View Profile </th>";
                echo "</tr>";
                for($i=0;$i<10;$i++)
                {
                	echo "<tr>";
                	echo "<td>".$row['acc_no']."</td>";
                	echo "<td>".$row['name']."</td>";
                	echo "<td>".$row['email']."</td>";
                	echo "<td>".$row['curr_balance']."</td>";
                	echo "<td><form action='view_profile.php' method='POST'><button type='submit' value='".$row['acc_no']."' name='SUBMIT'>View details</button></form> </td>";
                	echo "</tr>";
                	$row=$result->fetch_assoc();
                }

                
                echo "</table>";
			}
			
		?>
	</div>

	<footer class="text-center text-white fixed-bottom" style="background-color: #21081a;">
		  <div class="container p-4"></div>
		  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); color: white;">
		    © 2021 Copyright, Atharva Keskar
		  </div>
		</footer>
	</body>
</html>