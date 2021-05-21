<?php
	if(isset($_POST['auth']))
	{	
		require 'db_connection.php';
		session_start();
		$conn=connect_db();

		

		$account_number_receiver=$_POST['number'];
		echo $account_number_receiver;
		$already_account_number=$_SESSION['acc_no'];
		echo $already_account_number;
		$transfer=$_POST['balance'];
		echo $transfer;
		$sql="Select curr_balance from customer where acc_no='$already_account_number'";
		$result=$conn->query($sql);
		$row=$result->fetch_assoc();

		$sql1=1;
		$status=0;

		if($row['curr_balance']>=$transfer)
		{
			$status=1;

			$sql="update customer set curr_balance=curr_balance-'$transfer' where acc_no='$already_account_number'";
			$sql=$conn->query($sql);

			$sql1="update customer set curr_balance=curr_balance+'$transfer' where acc_no='$account_number_receiver'";
			$sql1=$conn->query($sql1);

			$already_account_number=$already_account_number*10+1;
		}
		else
			$already_account_number=$already_account_number*10;

		$_SESSION['acc_no']=$already_account_number;
		if($sql && $sql1)
		{
			$temp=($already_account_number-$already_account_number%10)/10;
			$sql="Select name from customer where acc_no='$temp'";
			$sql_new=$conn->query($sql);
			$row=$sql_new->fetch_assoc();
			$row=$row['name'];

			$sql1="Select name from customer where acc_no='$account_number_receiver'";
			$sql1_new=$conn->query($sql1);
			$row1=$sql1_new->fetch_assoc();
			$row1=$row1['name'];

			if($status==1)
				$status_string="Success";
			else
				$status_string="Failed";


			echo $status_string;
			$sql="insert into transfer (from_name,to_name,value_trand,STATUS) values ('$row','$row1','$transfer','$status_string')";
			$sql=$conn->query($sql);

			header('location:view_profile.php');
		}
		else
			echo "Error occured";
	}
	else
		echo "Access denied";

?>