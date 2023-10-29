<?php
    $email = $_POST['email'];
	$upswd2 = $_POST['upswd2'];   

    // Database connection
    if(isset($_POST['email'])){
	$con = new mysqli('localhost','root','','test');
    if($con->connect_error){
		echo "$con->connect_error";
		die("Connection Failed : ".$con->connect_error);
	} else {
        $stmt = $con->prepare("select * from registrationguvi where email= ?");
        $stmt ->bind_param("s",$email);
        $stmt->execute();
        $stmt_result = $stmt ->get_result();
        if($stmt_result ->num_rows > 0){
            $data = $stmt_result ->fetch_assoc();
            if($data['upswd2'] === $upswd2){
                echo "<div class='alert alert-success'>Login Successfully</div>";                
            }else {
                echo "<div class='alert alert-danger'>Password does not match</div>";
            }
        }
        else{
            echo "<div class='alert alert-danger'>Invalid Email or Password</div>";
        }
    }
}
    ?>