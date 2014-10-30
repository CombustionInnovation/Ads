<?
	header('Content-Type: application/json');
	require('ads.php');
	$ads_class=new ads;
	$ad_id=$_REQUEST['ad_id'];
	$from=$_REQUEST['from'];
	$ads_class->adWasClicked($ad_id,$from);
	$output=array(
		'status'=>'one',
	);
	//echo json_encode($output);
?>