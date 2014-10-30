<?
	header('Content-Type: application/json');
	require('ads.php');
	$ads_class=new ads;
	$banner_type=$_REQUEST['banner_type'];
	$from=$_REQUEST['from'];
	$ad=$ads_class->getAd($banner_type);
	echo json_encode($ad);
?>