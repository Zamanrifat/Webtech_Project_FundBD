<?php 

session_start();

	include("employeeConnection.php");
	include("EmployeeFunctions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(!empty($username) && !empty($password) && !is_numeric($username))
		{

			//read from database
			$query = "select * from employee where username = '$username' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$employee_data = mysqli_fetch_assoc($result);
					
					if($employee_data['password'] === $password)
					{

						$_SESSION['employee_id'] = $employee_data['employee_id'];
						header('location: ../../View/Employee/employeeDashboard.html');
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>