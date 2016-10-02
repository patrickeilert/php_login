<?php 

session_start();

if( isset($_SESSION['user_id']) ){
    header("Location: index.php");
}

require 'database.php';

$message = '';

if(!empty($_POST['email']) && !empty($_POST['password'])):
    
    // Enter the new user in the database
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

    if($stmt->execute()):
        $message = 'Succesfully created new user';
    else:
        $message = 'Sorry there has been an error';
    endif;        

endif;


?>



<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    
    <?php if(!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>    
    
    <h1>Register</h1>
    
    <form action="register.php" method="post">
        
            <input type="text" placeholder="Enter your email" name="email">
            <input type="password" placeholder="and password" name="password">
            <input type="password" placeholder="confirm password" name="confirm_password">
            
            <input type="submit">
         
         
     </form>
    
</body>
</html>
