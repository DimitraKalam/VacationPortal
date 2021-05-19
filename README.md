# VacationPortal

A portal where employees can request their vacation online, the supervisor receives a notification to approve or reject this request through email. After the supervisor  has selected to approve or decline the request, an email goes out to the employee informing them about the outcome of their request. 
In the administrator page a table appears, with the existing users, with the following fields: user first name, user last name, user email, user type (employee/admin).  On top of the page there is a button to create a user. Clicking on it takes the administrator to the user creation page, which includes a form with the following fields: first name, last name, email, password, confirm password, user type (drop down,admin/employee). By clicking on "Create a user" button a new row in the 'users' table is added. 
In the employee page a table appears, with the past applications for vacation, sorted by submission date (descending) including the following fields: date submitted, dates requested (vacation start - vacation end), days requested, status (pending/approved/rejected). On top of the page there is a "Submit Request" button to submit a new request. Clicking on it takes the employee to the submission page, which includes a form with the following fields: date from (vacation start), date to (vacation end), reason. By clicking on "Submit" button a new row in the 'request_form' table is added.

DEVELOPMENT TOOLS
'Visual Studio code' was used to write code (version: 1.56.2).

TECHNICAL SPECIFICATIONS
1. The portal has been created using PHP 7.4.19.
2. The portal has been based on MySQL for the data storage.
3. The portal’s source code is hosted on github in the following link: https://github.com/DimitraKalam/VacationPortal.git  .
4. XAMPP Control Panel (v3.3.0) has been installed and used, functioning as a local test system.
5. To make the mailing process possible the following changes should be implemented:
  
    a) Locate the “php.ini” in the directory “..\xampp\php”
	
    b) Open it using notepad or any text editor and find the [mail function].
	
    c) Copy and paste the following code:
    [mail function]
    ; For Win32 only.
    ; http://php.net/smtp
    SMTP=smtp.gmail.com
    ; http://php.net/smtp-port
    smtp_port=587

    ; For Win32 only.
    ; http://php.net/sendmail-from
    sendmail_from =  example_username@gmail.com

    ; For Unix only.  You may supply arguments as well (default: "sendmail -t -i").
    ; http://php.net/sendmail-path
    sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"

    ; Force the addition of the specified parameters to be passed as extra parameters
    ; to the sendmail binary. These parameters will always replace the value of
    ; the 5th parameter to mail().
    ;mail.force_extra_parameters =

    ; Add X-PHP-Originating-Script: that will include uid of the script followed by the filename
    mail.add_x_header=Off

    ; The path to a log file that will log all mail() calls. Log entries include
    ; the full path of the script, line number, To address and headers.
    ;mail.log =
    ; Log mail to syslog (Event Log on Windows).
    ;mail.log = syslog
    
	  d) Locate the “sendmail.ini” in the directory “xampp\sendmail”
	  e) Open it using notepad or any text editor and find the [sendmail].
	  f) Copy and paste the following code:
    [sendmail]

    ; you must change mail.mydomain.com to your smtp server,
    ; or to IIS's "pickup" directory.  (generally C:\Inetpub\mailroot\Pickup)
    ; emails delivered via IIS's pickup directory cause sendmail to
    ; run quicker, but you won't get error messages back to the calling
    ; application.

    smtp_server=smtp.gmail.com

    ; smtp port (normally 25)

    smtp_port=587

    ; SMTPS (SSL) support
    ;   auto = use SSL for port 465, otherwise try to use TLS
    ;   ssl  = alway use SSL
    ;   tls  = always use TLS
    ;   none = never try to use SSL

    smtp_ssl=tls

    ; the default domain for this server will be read from the registry
    ; this will be appended to email addresses when one isn't provided
    ; if you want to override the value in the registry, uncomment and modify

    ;default_domain=mydomain.com

    ; log smtp errors to error.log (defaults to same directory as sendmail.exe)
    ; uncomment to enable logging

    error_logfile=error.log

    ; create debug log as debug.log (defaults to same directory as sendmail.exe)
    ; uncomment to enable debugging

    debug_logfile=debug.log

    ; if your smtp server requires authentication, modify the following two lines

    auth_username= example_username@gmail.com
    auth_password=example_password

    ; if your smtp server uses pop3 before smtp authentication, modify the 
    ; following three lines.  do not enable unless it is required.

    pop3_server=
    pop3_username=
    pop3_password=

    ; force the sender to always be the following email address
    ; this will only affect the "MAIL FROM" command, it won't modify 
    ; the "From: " header of the message content

    force_sender= example_username@gmail.com

    ; force the sender to always be the following email address
    ; this will only affect the "RCTP TO" command, it won't modify 
    ; the "To: " header of the message content

    force_recipient=

    ; sendmail will use your hostname and your default_domain in the ehlo/helo
    ; smtp greeting.  you can manually set the ehlo/helo name if required

    hostname=localhost

You also need to visit the following link https://myaccount.google.com/lesssecureapps?pli=1&rapt=AEjHL4Ng_BOft15x8zWCoqeX84t7sHJF7JKFpFOkR_Hgey4XQgI-mRQDeZqkjwPbiQrGuzmUISTJUL_mw-xZ5bx9PfyWk6OGvw and turn Allow less secure apps on.

Then in functions.php find the send_email() function and replace the variable $to_email with the example_username@gmail.com, which is the email of the supervisor.
In accept_request.php and in reject_request.php  you need to replace the variable $to_email with the email of the employee.

PROJECT DIRECTORIES

  css:
  
  •	login_style.css 
    
    Is used to format the layout of login.php.

  •	main_style.css 
    
    Is used to format the layout of main_admin.php and main_employee.php.

  •	request_signup_style.css 
  
    Is used to format the layout of request_form.php and signup.php.
  
  
  includes:
  
  •	db_connection.php
  
    Opens up a connection to the database.

  •	functions.php
  
    Contains functions used in other php files.

  •	login_inc.php
  
    After the user clicks the login button that appears in login.php the system checks if the user filled all the fields, otherwise an error occurs in the url link. It also checks if the user exists and if yes if the password matches the email given from the user.  According to if the user is an administrator or an employee the the corresponding page is shown.

  •	request_inc.php
  
    After the user clicks the Submit Request button that appears in main_employee.php page the system redirects to the request_form.php page. In this page there is a button with the value Submit, by clicking on it a function sends the data from the submission form the the 'request_form' table in the database. Another function is responsible for sending the email to the portal administrator. 

  •	signup_inc.php
  
    After the administrator clicks the Create a user button that appears in main_admin.php page the portal redirects to the signup.php page. In this page there is a button with the value Create, by clicking on it if the administrator hasn't fill in the fields or the passwords don’t match an error occurs in the url link. An error also occurs if the email that the administrator submitted has already been used, so that there won’t be any duplication. If no error arises then the portal creates a user by inserting the data that the administrator filled, into 'users' table in the database.
  
  
  php
  
  •	accept_request.php 
  
    This page is only shown if the supervisor who got an email after a user submitted an application clicks on the 'click here to approve the application' link. The page contains a message that informs the administrator that the email has been successfully sent to the employee and the application has been approved. 

  •	login.php
    
    Contains html code for the login page.

  •	logout.php
    
    If the logout button is clicked the session is ended and the user is redirected to login.php.

  •	main_admin.php
  
    Contains html code for the main administrator page. It also contains php code for fetching the user’s data from the 'users' table and displaying it in a table. Each user email is clickable, clicking on it takes the administrator to the user properties page(user_properties.php) the link contains the email of the user that the administrator clicked on.

  •	main_employee.php
    
    Contains html code for the main employee page. It also contains php code for fetching the past applications from the 'request_form' table and displaying it in a table. 

  •	reject_request.php 
    
    This page is only shown if the supervisor who got an email after a user submitted an application clicks on the 'click here to reject the application' link. The page contains a message that informs the administrator that the email has been successfully sent to the employee and the application has been rejected. 

  •	request_form.php 
    
    Contains html code for the submission form page.

  •	signup.php
    
    Contains html code for user creation page.

  •	user_properties.php
    
    Contains html code for the user properties page. It also contains php code for fetching the data of the user that the administrator clicked on. Also, if the administrator clicks on Update button the user’s properties in 'users' table are updated.


Every user logs in with their email and password. It is important to mention that email is a unique feature of each user. That’s why when an administrator is creating a user if the email is already used the system prevents them from creating a user and the signup page reloads with an error message in the url link. Email is used as a variable session and as a way to recognize which user is logged in.  To access any page the system checks if there the session variable email isn’t empty, otherwise the user is redirected to the login page. 

DATABASE

The database name is: «vacation_db» and contains two tables, with the names: 'users', 'request_form'.

'users' table has the following the columns:

    • firstname [varchar(200)] -> User’s first name
    • lastname [varchar(200)] -> User’s last name
    • email [varchar(200)] -> User’s email
    • password [varchar(300)] -> User’s password
    • user_type [varchar(200)] -> The user can be an administrator or an employee
    o primary key is email
  
  
'request_form' table has the following columns:

    • request_id [int(11)] -> Every submission has a unique auto increment id
    • request_email [varchar(200)] -> User’s email who submitted an application
    • start_date [date] -> Date from (vacation start)
    • end_date [date] -> Date to (vacation end)
    • reason [varchar(200)] -> Reason the user submitted an application
    • req_status [varchar(200)] -> Submission status (pending/approved/rejected)
    • date_created [date] -> Date the application was submitted
    o primary key is request_id
    o the request_email references to the primary key email in 'users' table
