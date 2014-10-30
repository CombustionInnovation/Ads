<?
	header('Content-Type: application/json');
	require('analytics.php');
	$analytics_class=new analytics;
	$result=$analytics_class->amountOfAdsServedPerDay($ad_id,$from);
	$click=$analytics_class->amountOfAdsClickedPerDay($ad_id,$from);
	$result = array_merge($result, $click);
	echo json_encode($result);
?>