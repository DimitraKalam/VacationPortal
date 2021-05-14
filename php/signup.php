<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="../css/request_signup_style.css">
</head>
<body>
 <div class="go_back">
    <form action="main_admin.php">
        <input id="go_back" type="submit" href="main_admin.php" name='go_back' class="go_back" value="Go Back"> 
    </form>
    <br>
</div>
<div class='contact-title'>
    <h1>Please create a user</h1>
</div>
<div>
    <form method="POST" action="../includes/signup_inc.php">
    <input name="firstname" type="text" class="form-control" placeholder="First Name" required>
    <br>
    <input name="lastname" type="text" class="form-control" placeholder="Last Name" required>
    <br>
    <input name="email" type="email" class="form-control" placeholder="Email" required>
    <br>
    <input name="password" type="password" class="form-control" placeholder="Password" required>
    <br>
    <input name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" required>
    <br>
    <select name="admin_employee" class="form-control" style="height: 45px;" required>
        <option value="0" style="display:none"> -- Please select an option -- </option>
        <option value="admin">admin</option>
        <option value="employee">employee</option>
    </select>
    <br>
    <input type="submit" name="create_user_btn" class="form-control submit" value="Create"> 
</div>
</body>
</html>
