<?php 


	session_start();
	$email = $password = "";
	$emailErr = $passwordErr = "";
	$con = mysqli_connect('localhost','root','','contact');

	if(isset($_SESSION['user_id']))
	{
		header('location:viewContact.php');
	}

	if (isset($_POST['login'])) 
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
	
		$sql_email = "select * from registration where email = '$email'";
		$email_data = mysqli_query($con,$sql_email);
		$check_email = mysqli_num_rows($email_data);
		
		if (empty($_POST["email"])) {
			$emailErr = "Email is required";
		} else if($check_email != 1) {
			$emailErr = "Email Is Not Registered Yet..";
		} else if($check_email == 1) {
			$row = mysqli_fetch_assoc($email_data);
			
			if($password == $row['password'])
			{
				$_SESSION['user_id'] = $row['id'];
				header('location:viewContact.php');
			} else {
				$passwordErr = "Invalid Password";
				$password = "";
			}
		}
	}

 ?>

<style>

       center
       {
          margin: 230px;
       }

       form 
       {  
        width: 50%;
        height: 50%;
        border: 3px solid #f1f1f1;
       }

       input[type=password], input[type=email]   
      {
        width: 100%;
        padding: 12px 20px; 
        margin: 8px 0;
        display: inline-block;
        border: 1px solid da;
        box-sizing: border-box;
      }

      button 
      {
        width: 50%;
        background-color: deepskyblue;
        color: black;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
      }

      .container 
      {
        padding: 16px;
      }

      span.psw 
      {
        float: right;
        padding-top: 16px;
      }
      h2
      {
      }
	.required{
		color: red;
	}
</style>


<center>

<h2>Login Form</h2>
<form method="post">

	<div class="container">
		<label for="email"><b>Email</b></label>
		<input type="email" placeholder="Enter Email Address" name="email" value="<?php echo $email;?>">
		<div align="left">
			<span class="required"> <?php echo $emailErr;?></span> 
		</div>	
		<label for="psw"><b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="password" value="<?php echo $password;?>">
		<div align="left">
			<span class="required"> <?php echo $passwordErr;?></span>	
		</div>
		<button type="submit" name="login" value="login">login </button>
	</div>

	<a href="registration.php">registration?</a>

   
</form>

</center>