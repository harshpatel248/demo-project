<?php 
require 'conn.php';

if(!isset($_SESSION['username'])){
  header('location:sign-in.php');
}

	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		
		$sql = "DELETE FROM `slider` where id='".$id."' ";
		$result = mysqli_query($con,$sql);

		if($result){
			$_SESSION['message'] =  'Data Deleted Successfully';
			header('location:home.php');
		}
	}
 ?>