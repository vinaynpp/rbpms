<?php
require('boss/connection.inc.php');
require('boss/functions.inc.php');

$msg="";
if(isset($_POST['submit'])){
	$e_name=get_safe_value($con,$_POST['e_name']);
    $e_password=get_safe_value($con,$_POST['e_password']);
    
	$sql="select * from employee where e_name='$e_name' and e_password='$e_password'";
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
	if($count>0){
		$_SESSION['USER_LOGIN']='yes';
		$_SESSION['USER_USERNAME']=$e_name;
		header('location:index.php');
		die();
	}else{
		$msg="Please enter correct login details";	
	}
	
}
?>



<?php require('nav.php');?>
    <div class="card" >
    <div class="andar">

        <form  method="post">
            <div class="imgcontainer">
                <img src="AVATAR.PNG" alt="Avatar" style="width:100%;" class="avatar">
            </div>

            <div class="container">
                <div>
                    <label for="e_name">
                        <h1>
                            USERNAME
                        </h1>
                    </label>
                    <input type="text" name="e_name" id="" placeholder="username" required>

                </div>

                <div>
                    <label for="e_password">
                        <h1>
                            PASSWORD
                        </h1>
                    </label>
                    <input type="password" name="e_password" id="" placeholder="password" required>
                </div>
                <div>
                    <button type="submit" name="submit">
                        <h2>
                            SIGN IN
                        </h2>
                    </button>
                    <?php echo $msg?>

                </div>
                <div>

                </div>
            </div>
        </form>


    </div>

    </div>


</body>

</html>