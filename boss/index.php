<?php
require('connection.inc.php');
require('functions.inc.php');

if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] != '') {
} else {
	header('location:bossandar.php');
	die();
}


$m_name=$_SESSION['ADMIN_USERNAME'];

$sql2 = "select * from manager where  m_name = '$m_name'";
$res2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_assoc($res2);
$manager_id = $row2['manager_id'];
$m_key_p = $manager_id;
$company_id = $row2['c_key_m'];
$c_key_p = $company_id;

$sql3 = "select * from company where  company_id = '$company_id'";
$res3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_assoc($res3);
$c_name = $row3['c_name'];

$sql4 = "select employee.e_name from employee where  m_key_e = 1";
$res4 = mysqli_query($con, $sql4);
$row4 = mysqli_fetch_assoc($res4);
$e_name = $row4['e_name'];
 



if (isset($_GET['type']) && $_GET['type'] != '') {
	$type = get_safe_value($con, $_GET['type']);
	if ($type == 'p_status') {
		$operation = get_safe_value($con, $_GET['operation']);
		$id = get_safe_value($con, $_GET['id']);
		if ($operation == 'active') {
			$status = '1';
		} else {
			$status = '0';
		}
		$update_status_sql = "update project set p_status='$status' where project_id='$id'";
		mysqli_query($con, $update_status_sql);
	}

	if ($type == 'delete') {
		$id = get_safe_value($con, $_GET['id']);
		$delete_sql = "delete from project where project_id='$id'";
		mysqli_query($con, $delete_sql);
	}
}

$sql = "select project.* from project order by project.project_id desc";
$res = mysqli_query($con, $sql);
$sql1 = "select * from employee,project where p_key_e = project_id ";
$res1 = mysqli_query($con, $sql1);

?>

<?php require('bossnav.php');?>


<div class="header">
  <h1 style="font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"> <img src="../AVATAR.PNG" alt="" height="60px"> RBPMS - <?php echo $c_name  ?></h1>
  <h5>logged in as  <strong><?php echo $m_name?></strong> working for <strong> <?php echo $c_name?> </strong></h5>

</div>
	<table style="width: 100%;  background: #ddd;">
		<tr>
			<th>TITLE</th>
			<th>EMPLOYEES WORKING</th>
			<th>BUDGET</th>
			<!-- <th>SKILLS REQUIRED</th>-->
			<th>DETAIL</th>
			<th>ACTIVATION</th>
			<th>EDIT</th>
			<th>DELETE</th>
		</tr><?php
				$i = 1;
				while ($row = mysqli_fetch_assoc($res)) {
				?><tr>
									<td>
					<h5><?php echo $row['p_title'] ?></h5>
				</td>
				<td>
				<h5><?php echo  mysqli_fetch_assoc(mysqli_query($con, "select employee.* from employee,project where p_key_e =".$row['project_id']))['e_name'] ?></h5>
				

					<!--  <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image'] ?>" alt="product images" style="width: 60px;">-->
				</td>

				<td>
					<H4><?php echo "₹";
						echo  $row['budget'] ?></H4>
				</td>
			<!--	<td> <?php echo $row['skill_req_1'] ,', ', $row['skill_req_2'],', ', $row['skill_req_3'] ?></td>-->
				<td style="width: 30%;"><?php echo "DETAIL : ";
										echo $row['p_detail'] ?></td>
				<td><?php if ($row['p_status'] == 1) {
						echo "<span ><a href='?type=p_status&operation=deactive&id=" . $row['project_id'] . "'>Active</a></span>&nbsp;";
					} else {
						echo "<span ><a href='?type=p_status&operation=active&id=" . $row['project_id'] . "'>Deactive</a></span>&nbsp;";
					}           ?></td>
				<td><?php
					echo "<span ><a href='project.php?id=" . $row['project_id'] . "'>Edit</a></span>&nbsp;";
					?></td>
				<td><?php
					echo "<span ><a href='?type=delete&id=" . $row['project_id'] . "'>Delete</a></span>";
					?></td>
				<td></td>
			</tr><?php } ?>
	</table>
	<div class="footer">

		<p> <a href="project.php">ADD NEW</a></p>
	</div>
	<?php echo '<pre>'; print_r($e_name); echo '</pre>';
	 ?>
	<script src="bs.js"></script>
</body>

</html>