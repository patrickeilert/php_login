<?php 

session_start();

require 'database.php';
if( isset($_SESSION['user_id']) ){
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    
    $user = NULL; 
    
    if( count($results) > 0){
        $user = $results;
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
</head>

<body>
   
    <?php if( !empty($user) ): ?>
    
        <br />Welcome. <?= $user['email']; ?>
        <br /><br />Youre logged in.
        
        <a href="logout.php">Logout</a>  
    
    <?php else: ?>
   
        <h1>Please login or register</h1>
        <a href="login.php">Login</a> or
        <a href="register.php">Register</a>
    
    <?php endif; ?>
    
</body>
</html>
