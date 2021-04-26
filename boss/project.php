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


$p_title = '';
$budget = '';
$skill = '';
$image = '';
$p_detail   = '';


$msg = '';
$image_required = 'required';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from project where project_id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);

        $p_title = $row['p_title'];
        $budget = $row['budget'];

        $skill = $row['skill_req_1']+$row['skill_req_2']+$row['skill_req_1'];

        $p_detail = $row['p_detail'];
    } else {
        header('location:index.php');
        die();
    }
}

if (isset($_POST['submit'])) {

    $p_title = get_safe_value($con, $_POST['p_title']);
    $budget = get_safe_value($con, $_POST['budget']);
    $p_detail = get_safe_value($con, $_POST['p_detail']);


    $res = mysqli_query($con, "select * from product where p_title='$p_title'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
            } else {
                $msg = "Project already exist";
            }
        } else {
            $msg = "Project already exist";
        }
    }


    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $update_sql = "update project set p_title='$p_title',budget='$budget',p_detail='$p_detail' where project_id='$id'";
            mysqli_query($con, $update_sql);
        } else {
            mysqli_query($con, "insert into project(p_title,budget,p_detail,m_key_p,c_key_p) values('$p_title','$budget','$p_detail','$m_key_p','$c_key_p')");
        }
        header('location:index.php');
        die();
    }
}
?>
<?php require('bossnav.php');?>

    <div class="card">
        <div><strong>Project</strong><small> Form</small></div>
        <form method="post" enctype="multipart/form-data">
            <div>


                <div class="form-group">
                    <label for="categories" class=" form-control-label">Name</label>
                    <input type="text" name="p_title" placeholder="Enter project name" class="form-control" required value="<?php echo $p_title ?>">
                </div>

                <div class="form-group">
                    <label for="categories" class=" form-control-label">BUDGET</label>
                    <input type="text" name="budget" placeholder="Enter budget" class="form-control" required value="<?php echo $budget ?>">
                </div>


                <div class="form-group">
                    <label for="categories" class=" form-control-label">Description</label>
                    <textarea name="p_detail" placeholder="Enter project description" class="form-control" required><?php echo $p_detail ?></textarea>
                </div>




                <button name="submit" type="submit">
                    <span>Submit</span>
                </button>
                <div class="field_error"><?php echo $msg ?></div>
            </div>
        </form>
    </div>




    <div class="footer">

        <p><a href="index.php">ADMIN</a></p>


    </div>


</body>

</html>