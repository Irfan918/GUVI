<?php


	$name = $_POST['name'];	
	$email = $_POST['email']; 
	$password = $_POST['password'];
	$upswd2 = $_POST['upswd2'];

	$passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($name) OR empty($email) OR empty($password) OR empty($upswd2)) {
            array_push($errors,"All fields are required");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 charactes long");
           }
           if ($password!==$upswd2) {
            array_push($errors,"Password does not match");
		   }

	// Database connection	
	$conn = new mysqli('localhost','root','','test');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		if(isset($_POST['email'])){
		$sql = "SELECT * FROM registrationguvi WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email already exists!");
           } 
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           
		}else{
		$stmt = $conn->prepare("insert into registrationguvi 
		(name, email, password, upswd2 ) values(?, ?, ?, ?)");
		$stmt->bind_param("ssss", $name, $email, $password, $upswd2);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
		}
}
	}
?>