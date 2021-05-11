<?php
// // $sql="SELECT * from request_form where user_id = '".$_GET["sequence"]."' ";
// require_once '../includes/db_connection.php';
// require_once '../includes/functions.php';
// $sql="SELECT * from request_form where request_id = '1' ";
// $rs= mysqli_query($con,$sql) or die(mysqli_error());
// $result=mysqli_fetch_array($rs);

// echo '<table>
// <tr>
// <td>Start</td>
// <td>end</td>
// </tr>
// <tr>
// <td>'.$result["start_date"].'</td>
// <td>'.$result["end_date"].'</td>
// </tr>
// </table>';


///////
// require_once '../includes/db_connection.php';
// require_once '../includes/functions.php';
// $sql="SELECT * from request_form ";
// $result= mysqli_query($con,$sql) or die(mysqli_error());
// $rs=mysqli_fetch_array($result);

// if($result)
// {

//     echo "<table width ='340' align='left'>
//           <tr color ='#5D9951>";
//     $i=0;
    
//         If(mysql_num_rows($result)>0)
//         {
//              //here you fetch the data from the database and print it in the respective columns   
//             while($i<mysql_num_fields($result))
//             {    
//                  echo "<th>".mysql_field_name($result, $i)."</th>";
//                  $i++;
//             }
//             echo "</tr>";
    
//             $color=1;
    
//             while($rs)
//             {    
//                 If ($color==1){
//                     echo "<tr color='#'#cccccc'>";
    
//                     foreach ($rows as $data){
//                         echo "<td align='center'>".$data. "</td>";
//                     }
    
//                     $color=2;
//                 }
//                 $color=1;
//             }
//          }else {
//             echo"no results found";
//             echo "</table>";}

// }
// require_once '../includes/db_connection.php';
// require_once '../includes/functions.php';
// $sql="SELECT * from request_form ";
// $result= mysqli_query($con,$sql) or die(mysqli_error());
// $rs=mysqli_fetch_array($result);
// if(!$con)
// {
//     die('not connected');
// }
// $con=  mysqli_query($con, "select * from request_form");

// while($row=  mysqli_fetch_array($con))
// {
//     echo '<table>
//     <tr>
//     <td>Forename</td>
//     <td>Surname</td>
//     </tr>
//     <tr>
//     <td>'.$row['request_id'].'</td>
//     <td>'.$row['start_date'].'</td>
//     </tr>
//     </table>';
//     //  '<tr>
//     //     <td>'<.$row['request_id'].>'</td>
//     //     <td>'<.$row['start_date'].>'</td>
//     //     <td>'<.$row['end_date'].>'</td>
//     //     <td>'<.$row['reason'].>'</td>
//     //     <td>'<.$row['req_status'].>'</td>
//     //     <td>'<.$row['user_id'].>'</td>
//     //     <td>'<.$row['date_created'].>'</td>
//     //     </tr>';

// }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Main Employee</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <style>
        table {
        border-collapse: collapse;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        height: 70px;
        }
        table, th, td 
        {
        border: 1px solid white;
        color: white;
        }
        th {
        background-color: #4CAF50;
        color: white;
        height: 70px;
        }
        td {
        height: 50px;
        }
    </style>
</head>
<body>
    <div class="logout">
        <form id='contact-form' action="logout.php">
            <input type="submit" href="logout.php" name='logout_btn' class="logout_btn" value="Logout"> 
        </form>
    </div>
    <div class="submit_request">
        <form id='contact-form' action="request_form.php">
            <input type="submit" name='submit_request' class="submit_request" value="Submit Request"> 
        </form>
    <br>
    </div>
    <div>
    <?php
        require_once '../includes/db_connection.php';
        require_once '../includes/functions.php';
        $sql="SELECT * from request_form ";
        $result= mysqli_query($con,$sql) or die(mysqli_error());
        $rs=mysqli_fetch_array($result);
        if(!$con)
       {
           die('not connected');
       }
        $con=  mysqli_query($con, "select * from request_form");
       ?>
        <div class="request_table">
         <table>
            <th>Request id</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Reason</th>
            <th>Request status</th>
            <th>User id</th>
            <th>Date created</th>

            </tr>

        <?php

             while($row=  mysqli_fetch_array($con))
             {
                 ?>
            <tr>
                <td><?php echo $row['request_id']; ?></td>
                <td><?php echo $row['start_date']; ?></td>
                <td><?php echo $row['end_date']; ?></td>
                <td><?php echo $row['reason'] ;?></td>
                <td><?php echo $row['req_status'] ;?></td>
                <td><?php echo $row['user_id'] ;?></td>
                <td><?php echo $row['date_created'] ;?></td>
            </tr>
        <?php
             }
             ?>
             </table>
    </div>
</body>
</html>