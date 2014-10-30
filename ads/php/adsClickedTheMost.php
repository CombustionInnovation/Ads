<?
	header('Content-Type: application/json');
	require('analytics.php');
	$analytics_class=new analytics;
	$result=$analytics_class->whereAreAdsClickedTheMost();
	echo json_encode($result);
?>