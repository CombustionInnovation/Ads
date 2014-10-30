<?
	//header('Content-Type: application/json');
	require('ads.php');
	$ads_class=new ads;
	$banner_type=$_REQUEST['banner_type'];
	$from=$_REQUEST['from'];
	$ad=$ads_class->getAd($banner_type,$from);
	
?>
<html>
	<head>
	<script type= "text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	</head>
	
	<body style='padding:0px; margin:0px;'>
		<?echo '<a target="_blank" href="'.$ad['banner_link'].'"><img id="'.$ad['ad_id'].'" src="'.$ad['banner_image'].'" alt="'.$ad['banner_desc'].'" style="width:100%; left:0px;"/></a>';?>
		<script>
			$('#<?echo $ad['ad_id'];?>').on('click',function(){
				$.post('http://combustionlaboratory.com/ads/php/adWasClicked.php?ad_id=<?echo $ad['ad_id'];?>&from=<?echo $from;?>',
							function(data) {
							});
			});
		</script>
	</body>
</html>