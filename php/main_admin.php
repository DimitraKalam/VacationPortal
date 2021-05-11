<?php
if(isset($_POST['create_btn'])){
    header("Location: signup.php");
exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administration page</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">

</head>
<body>
    <div class="admin_page">
        <form action="signup.php" method="POST">
            <input type="submit" name='create_btn' class="create_button" value="Create a user"> 
    </div>
    <div class="logout">
        <input type="submit" name='create_btn' class="create_button" value="Create a user"> 
    </div>
</body>
</html>