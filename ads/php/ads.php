<?
	class ads
	{
		function newAd($banner_type,$banner_image,$banner_link,$banner_desc)
		{
			include("account.php");	
			$charset = "UTF-8";
			mysqli_set_charset ($link, $charset);
			$str =  mysqli_real_escape_string ($link ,$banner_desc);//this chunck of code takes care of any apostrophy issues encountered before
			 $str = @trim($str);
			 if(get_magic_quotes_gpc()) 
				{
					$str = stripslashes($str);
				}	
			$curDate = date('Y-m-d H:i:s', time());//current date stamp is added to comments
			$q = "INSERT INTO ads(banner_type,banner_image,banner_link,banner_desc,created)VALUES('$banner_type','$banner_image','$banner_link','$str','$curDate')";
			$r = @mysqli_query($link, $q);
			mysqli_close($link);
			//echo $q;
		}
		
		function getAd($banner_type,$from)
		{
			include("account.php");
			$q = "SELECT * FROM ads WHERE banner_type = '$banner_type'";
			$r = @mysqli_query($link, $q);
			$ttl = mysqli_num_rows($r);
				while($row =mysqli_fetch_array($r)) {
						$results[]=array(
							'ad_id'=>$row['ad_id'],
							'banner_type'=>$row['banner_type'],
							'banner_image'=>$row['banner_image'],
							'banner_link'=>$row['banner_link'],
							'banner_desc'=>$row['banner_desc'],
							'times_served'=>$row['times_served'],
							'times_clicked'=>$row['times_clicked'],
							'created'=>$row['created'],
							'last_clicked'=>$row['last_clicked'],
						);
					}
			$number=rand(0,$ttl-1);
			//echo json_encode($results);
			//echo $number;
			mysqli_close($link);
			$this->adWasServed($results[$number]['ad_id'],$from);
			return $results[$number];
		}
		
		function adWasClicked($ad_id,$from)
		{
			$currentClicks=$this->numberAdHasBeenClicked($ad_id);
			$numberToUpdate=1+$currentClicks;

				include("account.php");
				$curDate = date('Y-m-d H:i:s', time());
				$stmt = $link->prepare("UPDATE ads SET times_clicked = '$numberToUpdate', last_clicked='$curDate' WHERE ad_id='$ad_id'");
				$stmt->execute(); 
				$stmt->close();
				$this->newClick($ad_id,$from);
				return 'one';
		
		}	
		
		function newClick($ad_id,$from)
		{
			include("account.php");	
			$charset = "UTF-8";
			mysqli_set_charset ($link, $charset);
			$str =  mysqli_real_escape_string ($link ,$banner_desc);//this chunck of code takes care of any apostrophy issues encountered before
			 $str = @trim($str);
			 if(get_magic_quotes_gpc()) 
				{
					$str = stripslashes($str);
				}	
			$curDate = date('Y-m-d H:i:s', time());//current date stamp is added to comments
			$q = "INSERT INTO click(ad_id,click_from,created)VALUES('$ad_id','$from','$curDate')";
			$r = @mysqli_query($link, $q);
			mysqli_close($link);
			//echo $q;
		}
		
		function adWasServed($ad_id,$from)
		{
			$currentServed=$this->numberAdHasBeenServed($ad_id);
			$numberToUpdate=1+$currentServed;
			//echo $ad_id;
			//echo $numberToUpdate;
				include("account.php");
				$stmt = $link->prepare("UPDATE ads SET times_served = '$numberToUpdate' WHERE ad_id='$ad_id'");
				$stmt->execute(); 
				$stmt->close();
				$this->adDisplayed($ad_id,$from);
				return 'one';
			
		}	
		
		function adDisplayed($ad_id,$from)
		{
			include("account.php");	
			$curDate = date('Y-m-d H:i:s', time());//current date stamp is added to comments
			$q = "INSERT INTO displayed(ad_id,displayed_to,created)VALUES('$ad_id','$from','$curDate')";
			$r = @mysqli_query($link, $q);
			mysqli_close($link);
		}
		
		function numberAdHasBeenClicked($ad_id)
		{
			include("account.php");
			$q = "SELECT * FROM ads WHERE ad_id='$ad_id'";
			$r = @mysqli_query($link, $q);
			$ttl = mysqli_num_rows($r);
			$row =mysqli_fetch_array($r);
			return $row['times_clicked'];
			
		}	
		
		function numberAdHasBeenServed($ad_id)
		{
			include("account.php");
			$q = "SELECT * FROM ads WHERE ad_id='$ad_id'";
			$r = @mysqli_query($link, $q);
			$ttl = mysqli_num_rows($r);
			$row =mysqli_fetch_array($r);
			return $row['times_served'];
			
		}
	}
?>