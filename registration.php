<?php 



	$con = mysqli_connect('localhost','root','','contact');
	
 
	
	$nameErr = $emailErr = $passwordErr = $cityErr = $genderErr = $contactErr = "";
	$name = $email = $password = $city = $gender  = $contact =  "";	
	if(isset($_POST['register']))
	{
		
		$name = input($_POST['name']);
		$email = input($_POST['email']);
		$password =  input($_POST['password']);
		$city =  input($_POST['city']);
		$contact =  input($_POST['contact']);
		
		if(!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
			$sql = "select * from registration where email = '$email'";
			$email_data = mysqli_query($con,$sql);
			
			$check_email = mysqli_num_rows($email_data);
		}
		
			
		if (empty($_POST["name"])) {
			$nameErr = "Name is required";
		} else if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["name"])) {
			$nameErr = "Only letters and white space allowed";
		} else if (empty($_POST["email"])) {
			$emailErr = "Email is required";
		} else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
		} else if($check_email > 0) {
			$emailErr = "Already Registered this email";
		} else if (empty($_POST["password"])) {
			$passwordErr = "Password Is Required";
		} else if(!preg_match("#[0-9]+#",$_POST["password"])) {
			$passwordErr = "At Least 1 Number !";
		} else if(!preg_match("#[A-Z]+#",$_POST["password"])) {
			$passwordErr = "At Least 1 Capital Letter !";
		} else if(!preg_match("#[a-z]+#",$_POST["password"])) {
			$passwordErr = "At Least 1 Lowercase Letter !";
		} else if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["password"])) {
			$passwordErr = "At Least 1 Special Character !";
		} else if (empty($_POST["city"])) {
			$cityErr = "City is required";
		} else if("No matches found" === $_POST["city"]) {
			$cityErr = "Select the city";
			$city = "";
		}  else if (empty($_POST["contact"])) {
			$contactErr = "Contact Number is required";
		} else if(!preg_match('/^[0-9]{10}+$/',$_POST["contact"])) {
			$contactErr = "Invalid Contact Number";
		} else if (empty($_POST["gender"])) {
			$genderErr = "Gender is required";
		} else {
			
				
					$gender =  input($_POST['gender']);
					$sql = "INSERT INTO registration (name, email, password, city, gender, contact) VALUES ('$name', '$email', '$password', '$city', '$gender', '$contact')";
			
					mysqli_query($con,$sql);
					header('location:index.php');
					
					
			
		}
	}
	echo $statusMsg; 
	
	
	function input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}	
?>
<style type="text/css">
		
	input[type=text] , input[type=email] , input[type=password] {
		width: 100%;
		height: 32px;
        padding: 5px 10px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #CCCCCC;
		border-radius: 4px;
		box-sizing: border-box;
		font-size: 14px;
	}
	
	input[type=radio] {
		display: inline-block;
		border: 1px solid #CCCCCC;
		border-radius: 4px;
		box-sizing: border-box;
	}

	input[type=submit] {
		width: 100%;
		background-color: #04AA6D;
		color: white;
		padding: 14px 20px;
		margin: 25px 7px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}

	input[type=submit]:hover {
		background-color: #45a049;
	}

	table {
		border: 1px solid black;
		margin: 5% 0px;
		padding: 10px;	
		width: 35%;
        height: 50%;
        border: 3px solid #f1f1f1;		
	}
	
	.required {
		color: red;
	}

	.d1-th {
		padding:0rem 1.2rem; 
		font-size:	1.2rem;
	}
	
	.search-box {
        width: 100%;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
	
    .search-box input[type="text"] {
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
	
    .result {
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
	
    .search-box input[type="text"], .result {
        width: 100%;
        box-sizing: border-box;
    }
	
    .result p {
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
		background: #f2f2f2;
    }
	
    .result p:hover {
        background: #f2f2f2;
    }	
	
</style>
<center>
	
	<form method="post" enctype="multipart/form-data">
	<h2>Registration Form</h2>		
		<table>
			<td class="required">* required</td>
		
			<tr>
				<td class="d1-th">Name :</td>
				<td>
					<input type="text" name="name" placeholder="Enter Name" minlength="2" maxlength="30" value="<?php echo $name;?>">
				</td>
				<td>
					<span class="required">*</span>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<span class="required"> <?php echo $nameErr;?></span>
				</td>
			</tr>
			<tr>
				<td class="d1-th">Email :</td>
				<td>
					<input type="email" name="email"  placeholder="Enter Email-address" value="<?php echo $email;?>">
				</td>
				<td>
					<span class="required">*</span>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<span class="required"> <?php echo $emailErr;?></span>
				</td>
			</tr>
			<tr>
				<td class="d1-th">Password :</td>
				<td>
					<input type="password" name="password"  placeholder="Enter Password" value="<?php echo $password;?>">
				</td>
				<td>
					<span class="required">*</span>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<span class="required"> <?php echo $passwordErr;?></span>
				</td>
			</tr>
			<tr>
				<td class="d1-th">City :</td>				
				<td class="search-box">
					<input type="text" autocomplete="off" placeholder="Search city..." name="city" value="<?php echo $city;?>"/>
					<div class="result"></div>
				</td>
				<td>
					<span class="required">*</span>
				</td>				
			</tr>
			<tr>
				<td></td>
				<td>
					<span class="required"> <?php echo $cityErr;?></span>
				</td>
			</tr>
			
			<tr>
				<td class="d1-th">Contact No. :</td>
				<td>
					<input type="text" name="contact" maxlength="10" placeholder="Enter Contact Number" value="<?php echo $contact;?>">
				</td>
				<td>
					<span class="required">*</span>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<span class="required"> <?php echo $contactErr;?></span>
				</td>
			</tr>
			<tr>
				<td class="d1-th">Gender :</td>
				<td>
					<input type="radio" name="gender" value="Male"> 
					<span> Male</span>
					<input type="radio" name="gender" value="Female"> 
					<span> Female</span>
					<input type="radio" name="gender" value="other"> 
					<span> Other</span>
				</td>
				<td>
					<span class="required">*</span>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<span class="required"> <?php echo $genderErr;?></span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit"  name="register" value="register" >
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<p align="center">If you alredy Registered then. <a href="index.php">Log in</a></p>				
				</td>
			</tr>
			
		</table>
	</form>
</center>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function()
{
    $('.search-box input[type="text"]').on("keyup input", function()
	{
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length)
		{
            $.get("backend-search.php", {term: inputVal}).done(function(data)
			{
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } 
		else
		{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function()
	{
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
		
    });
});
</script>	
<script>
var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};
</script>	



