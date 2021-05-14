<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/login_style.css">
</head>
<body>
<div class='title'>
    <h1>Login</h1>
    <h2>Please login with your credentials</h2>
</div>
<div>
    <form method="POST" action="../includes/login_inc.php">
    <input name="email" type="email" class="form-style" placeholder="Email" required>
    <br>
    <input name="password" type="password" class="form-style" placeholder="Password" required>
    <br>
    <input type="submit" name="login_btn" class="form-style submit" value="Login"> 
</div>
</body>
</html>