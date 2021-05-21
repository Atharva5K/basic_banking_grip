<?php
	require 'db_connection.php';
?>

<html>
	<head>
		<title>Customer detail</title>
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
		      <li class="active"><a>View Profile</a></li>
		      <li><a href="display_customer.php">Show all customers</a></li>
		    </ul>
		  </div>
		</nav>

		<?php

			$conn=connect_db();
			session_start();
			if(isset($_POST['SUBMIT']) || isset($_SESSION['acc_no']))
			{
				if(isset($_POST['SUBMIT']))
				{
					$acc_search=$_POST['SUBMIT'];
					$status=2;
				}
				else
				{
					$acc_search=$_SESSION['acc_no'];
					$status=$acc_search%10;
					$acc_search=($acc_search-$status)/10;
				}

				$_SESSION['acc_no']=$acc_search;
				$sql="Select * from customer where acc_no='$acc_search'";
				$result=$conn->query($sql);
				$row=$result->fetch_assoc();
				echo "<p><h4>Name - ".$row['name']."</h4>";
				echo "<p><h4>Email id - ".$row['email']."</h4>";
				echo "<p><h4>Account number - ".$row['acc_no']."</h4>";
				echo "<p><h4>Current balance - ".$row['curr_balance']."</h4>";
				
				if($status==1) 
					echo "<p><h3 style='color:green'>Transaction successfull</h3>";
				else if($status==0)
					echo "<p><h3 style='color:red'>Transaction failed not enough balance</h3>";
			}
			else
				echo "Access denied";

			
			
			echo "<form action='transaction.php' method = 'POST'>";
			echo "<br><br><label for='balance'>Enter the amount you want to transfer - </label><input required type='text' id='balance' name='balance'><br>";

			$sql="Select acc_no,name from customer";
			$result=$conn->query($sql);
			$row=$result->fetch_assoc();

			echo "<table>";
            	echo "<tr>";
            	echo "<th> Account Number </th>";
                echo "<th> Name </th>";
                echo "<th> Select </th>";
                echo "</tr>";

                for($i=1;$i<11;$i++)
                {
                	if($i==$acc_search)
                	{
                		$row=$result->fetch_assoc();
                		continue;
                	}
                	else
                	{
	                	echo "<tr>";
	                	echo "<td>".$row['acc_no']."</td>";
	                	echo "<td>".$row['name']."</td>";
	                	echo "<td> <input required type='radio' id='number' name='number' value='".$row['acc_no']."'></td>";
	                	//echo "<td> <button value='Select' name='".$row['acc_no']."'>Select</button> </td>";
	                	echo "</tr>";
	                	$row=$result->fetch_assoc();
                	}
                	
                }
            echo "</table>";

            echo "<button type='submit' name='auth' value='<?php $acc_search ?>'>SUBMIT</button> ";
		?>

		<footer class="text-center text-white " style="background-color: #21081a;">
		  <div class="container p-4"></div>
		  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); color: white;">
		    © 2021 Copyright, Atharva Keskar
		  </div>
		</div>
		</footer>

	</body>

</html>

