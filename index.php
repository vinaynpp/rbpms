<?php
require('boss/connection.inc.php');
require('boss/functions.inc.php');

if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] != '') {
} else {
  header('location:andar.php');
  die();
}


?>

<?php

$e_name=$_SESSION['USER_USERNAME'];
$sql = "select employee.* from employee,project where e_name='$e_name'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$project_id = $row['p_key_e'];
$manager_id = $row['m_key_e'];
$company_id = $row['c_key_e'];

$sql1 = "select * from project where  project_id = '$project_id'";
$res1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($res1);
$p_title = $row1['p_title'];
$p_detail = $row1['p_detail'];
$budget = $row1['budget'];
$time_req = $row1['time_req'];

$sql2 = "select * from manager where  manager_id = '$manager_id'";
$res2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_assoc($res2);
$m_name = $row2['m_name'];

$sql3 = "select * from company where  company_id = '$company_id'";
$res3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_assoc($res3);
$c_name = $row3['c_name'];


?>

<?php require('nav.php'); ?>


<div class="header">
  <h1 style="font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"> <img src="AVATAR.PNG" alt="" height="60px"> RBPMS - <?php echo $c_name  ?></h1>
  <h5>logged in as  <strong><?php echo $e_name?></strong> working under <strong> <?php echo $m_name?> </strong> for <strong> <?php echo $c_name?> </strong></h5>

</div>

<div class="dabba">


<div class="card">

  <h1><?php echo $p_title ?></h1>

  <H4 class="price"><?php echo "DETAILS : ";echo  $p_detail ?></H4>

  <H3><?php echo "BUDGET : ";echo "₹ ";echo $budget ?></H3>


  <H3><?php echo "DEADLINE IN ";echo $time_req ;echo " DAYS " ?></H3>

  <h4><br><br></h4>
</div>

</div>





</body>

</html>