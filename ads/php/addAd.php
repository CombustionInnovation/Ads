<?
//this controller adds a comment as parameters it uses the comment itself and a pin ID 
//http://combustioninnovation.com/luis/pinstant/php/addCommentFromBrowser.php?comment=(insert comment here)&pin_id=(insert pin id here)
header('Content-Type: application/json');
	require("ads.php");
	$ads_class= new ads;
	$banner_type = $_REQUEST['banner_type'];
	$banner_image = $_REQUEST['banner_image'];
	$banner_link = $_REQUEST['banner_link'];
	$banner_desc = $_REQUEST['banner_desc'];
	if(isset($banner_type)&&isset($banner_image)&&isset($banner_link)&&isset($banner_desc))
	{
		$status = 'two';
		if($banner_type==0 ||$banner_type==1 ||$banner_type==2)
		{
			$ads_class->newAd($banner_type,$banner_image,$banner_link,$banner_desc);
			$status = 'one';
		}
	}
	else
	{
		$status = 'two';
	}
	
	$output = array(
							'status' =>  $status,
						);
	echo json_encode($output);
	
?>