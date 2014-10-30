<?
	header('Content-Type: application/json');
	require('analytics.php');
	$analytics_class=new analytics;
	$result=$analytics_class->amountOfAdsClickedPerDay($ad_id,$from);
	echo json_encode($result);
?>