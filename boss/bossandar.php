<?php
require('connection.inc.php');
require('functions.inc.php');

$msg="";
if(isset($_POST['submit'])){
	$m_name=get_safe_value($con,$_POST['m_name']);
    $m_password=get_safe_value($con,$_POST['m_password']);
    
	$sql="select * from manager where m_name='$m_name' and m_password='$m_password'";
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
	if($count>0){
		$_SESSION['ADMIN_LOGIN']='yes';
		$_SESSION['ADMIN_USERNAME']=$m_name;
		header('location:index.php');
		die();
	}else{
		$msg="Please enter correct login details";	
	}
	
}
?>



<?php require('bossnav.php');?>
    <div class="card" >
    <div class="andar">

        <form  method="post">
        <div class="imgcontainer">
                <img src="../AVATAR.PNG" alt="Avatar" style="width:100%;" class="avatar">
            </div>


            <div class="container">
                <div>
                    <label for="m_name">
                        <h1>
                            USERNAME
                        </h1>
                    </label>
                    <input type="text" name="m_name" id="" placeholder="username" required>

                </div>

                <div>
                    <label for="m_password">
                        <h1>
                            PASSWORD
                        </h1>
                    </label>
                    <input type="password" name="m_password" id="" placeholder="password" required>
                </div>
                <div>
                    <button type="submit" name="submit">
                        <h2>
                            SIGN IN
                        </h2>
                    </button>
                    <?php echo $msg?>
                </div>
            </div>
        </form>


    </div>

    </div>








</body>

</html>