<?php
    include ('includes/connection.php');
    include ('includes/classes/Validation.php');
    $validationClass = new Validation($pdo);

    include("includes/apis/api-signup.php");
    include("includes/apis/api-login.php");

    if(isset($_SESSION['usernmae'])){
        header('Location: index.php');
    }

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/scripts/signup.js"></script>
    <title>Document</title>
</head>
<body>

<?php

if(isset($_POST['signupButton'])){
    echo "<script>
            $(document).ready(function(){
                $('#signupForm').show();
                $('#loginForm').hide();
            })
        </script>";
}else{
    echo "<script>
            $(document).ready(function(){
                $('#signupForm').hide();
                $('#loginForm').show();
            })
        </script>";
}

?>
    
    <form id="signupForm" method="post">
    <div class="errorMessage">
        <?php if(!empty($validationClass->errorArray)){
                    echo $validationClass->errorArray[0];
                } 
        ?>
       </div>
       <p>
        <label>username</label>
        <input type="text" value="<?php returnPreviousValue('signupUsername') ?>" name="signupUsername">
       </p>

       <p>
           <label>Email</label>
           <input type="email" value="<?php returnPreviousValue('signupEmail1') ?>" name="signupEmail1">
       </p>

       <p>
           <label>Confrim email</label>
           <input type="email" value="<?php returnPreviousValue('signupEmail2') ?>" name="signupEmail2">
       </p>

       <p>
           <label>first name</label>
           <input type="text" value="<?php returnPreviousValue('firstName') ?>" name="firstName">
       </p>

       <p>
           <label>last name</label>
           <input type="text" value="<?php returnPreviousValue('lastName') ?>" name="lastName">
       </p>

       <p>
           <label>CPR</label>
           <input type="text" value="<?php returnPreviousValue('cpr') ?>" name="cpr">
       </p>
        
       <p>
           <label>Address</label>
           <input type="text" value="<?php returnPreviousValue('address') ?>" name="address">
       </p>

       <p>
           <label>Phone Number</label>
           <input type="text" value="<?php returnPreviousValue('phoneNumber') ?>" name="phoneNumber">
       </p>

       <p>
           <label>password</label>
           <input type="text" name="signupPassword1">
       </p>

       <p>
           <label>confrim password</label>
           <input type="text" name="signupPassword2">
       </p>

       <p>
           <label>Do you want to upload your music?</label><br>
           <input type="checkbox" name="isMusician">I am a musician
       </p>

       <button type="submit" name="signupButton">register</button>
       <br>
       <span>Already a member? <a id="hideSignupForm">Login</a></span>
    </form>


    <form id="loginForm" method="post">
       <div class="errorMessage">
        <?php if(!empty($validationClass->errorArray)){
                    echo $validationClass->errorArray[0];
                } 
        ?>
       </div>
        <p>
           <label>username</label>
           <input type="text" name="loginUsername">
       </p>

       <p>
           <label>password</label>
           <input type="password" name="loginPassword">
       </p>

       <button type="submit" name="loginButton">log in</button>
       <br>
       <p>Not a member yet? <a id="hideLoginForm">Signup</a></p>
    </form>



</body>
</html>