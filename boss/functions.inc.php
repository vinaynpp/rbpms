<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}
function get_safe_value($con, $str)
{
	if ($str != '') {
		$str = trim($str);
		return mysqli_real_escape_string($con, $str);
	}
}

function get_product($con,$limit='',$product_id='',$search='',$cat_id=''){
	$sql="select * from product ";


	if($product_id!=''){
		$sql.=" where product.id=$product_id ";
	}	
	if($search!=''){
		$sql.="WHERE (`name` LIKE '%".$search."%') OR (`description` LIKE '%".$search."%')" ;
	}
	if($limit!=''){
		$sql.=" limit $limit";
	}
	$res=mysqli_query($con,$sql);
	$data=array();
	while($row=mysqli_fetch_assoc($res)){
		$data[]=$row;
	}
	return $data;
}
?>