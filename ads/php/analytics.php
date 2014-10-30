<?
	class analytics{//set a class salled score
		function adsDisplayed(){
			include("account.php");
			$q = "SELECT sum(times_served) AS total FROM ads";
			$r = @mysqli_query($link, $q);
			$row = mysqli_fetch_array($r);
			return $row['total'];
		}
		
		function adsClicked(){
			include("account.php");
			$q = "SELECT sum(times_clicked) AS total FROM ads";
			$r = @mysqli_query($link, $q);
			$row = mysqli_fetch_array($r);
			return $row['total'];
		}
		
		function adsDisplayedSpecificDay($date){
			include("account.php");
			$q = "SELECT * FROM displayed WHERE created LIKE ('%$date%')";
			$r = @mysqli_query($link, $q);
			$ttl = mysqli_num_rows($r);
			return $ttl;
		}
		
		function adsClickedSpecificDay($date){
			include("account.php");
			$q = "SELECT * FROM click WHERE created LIKE ('%$date%')";
			$r = @mysqli_query($link, $q);
			$ttl = mysqli_num_rows($r);
			return $ttl;
		}
		
		function adsDisplayedTheMost($type){
			include("account.php");
			$q = "SELECT ads.* FROM ads WHERE banner_type='$type' ORDER BY times_served DESC";
			$r = @mysqli_query($link, $q);
				while($row =mysqli_fetch_array($r)) {
							$results []= array(
								'ad_id'=>$row['ad_id'],
								'banner_image'=>$row['banner_image'],
								'banner_desc'=>$row['banner_desc'],
								'times_served'=>$row['times_served'],
								'created'=>$row['created'],
								'last_clicked'=>$row['last_clicked'],
								);
				}
			return $results;
		}
		
		function whereAreAdsDisplayedTheMost()
		{
			include('account.php');
			$q="SELECT displayed.displayed_to,COUNT(*) AS TotalCount FROM displayed  GROUP BY displayed.displayed_to ORDER BY TotalCount DESC";
			$r = @mysqli_query($link, $q);
			while($row =mysqli_fetch_array($r)) {
							$results []= array(
								'displayed_to'=>$row['displayed_to'],
								'served'=>$row['TotalCount'],
								);
				}
			return $results;
		}
		
		function whereAreAdsClickedTheMost()
		{
			include('account.php');
			$q="SELECT click.click_from,COUNT(*) AS TotalCount FROM click GROUP BY click.click_from ORDER BY TotalCount DESC";
			$r = @mysqli_query($link, $q);
			while($row =mysqli_fetch_array($r)) {
							$results []= array(
								'total_clicks'=>$row['TotalCount'],
								'click_from'=>$row['click_from'],
								
								);
				}
			return $results;
		}
		
		function adsClickedTheMost($type){
			include("account.php");
			$q = "SELECT ads.* FROM ads WHERE banner_type='$type' ORDER BY times_clicked DESC";
			$r = @mysqli_query($link, $q);
				while($row =mysqli_fetch_array($r)) {
							$results []= array(
								'ad_id'=>$row['ad_id'],
								'banner_image'=>$row['banner_image'],
								'banner_desc'=>$row['banner_desc'],
								'times_clicked'=>$row['times_clicked'],
								'created'=>$row['created'],
								'last_clicked'=>$row['last_clicked'],
								);
				}
			return $results;
		}
		
		function adDisplayedPerDay($date,$ad_id){
			include("account.php");
			$q = "SELECT * FROM displayed WHERE ad_id='ad_id' AND created LIKE ('%$date%')";
			$r = @mysqli_query($link, $q);
			$ttl = mysqli_num_rows($r);
			return $ttl;
		}
		
		function adClickedPerDay($date,$ad_id){
			include("account.php");
			$q = "SELECT * FROM click WHERE ad_id='ad_id' AND created LIKE ('%$date%')";
			$r = @mysqli_query($link, $q);
			$ttl = mysqli_num_rows($r);
			return $ttl;
		}
		
		function getLastWeek(){
					$date = new DateTime( date('Y-m-d', time()));
					for($i=0;$i<7;$i++)
					{
						$array[$i]=$date->sub(new DateInterval('P1D'))->format('Y-m-d');
						//s$array[$i]->
					}
					return $array;
				}
				
		function amountOfAdsServedPerDay()
		{
			$array=$this->getLastWeek();
		
			for($i=0;$i<sizeof($array);$i++)
			{
				$numbers[$i]=$this->adsDisplayedSpecificDay($array[$i]);
				//echo $numbers[$i];
			}
			$x=sizeof($numbers)-1;
			for($i=0;$i<sizeof($array);$i++)
			{
				$rearranged[$i]=$numbers[$x];
				$datesRight[$i]=$array[$x];
				$x--;
			}
			$results['results']=$rearranged;
			$results['dates']=$datesRight;
			
			
			return $results;
		}
		
		function amountOfAdsClickedPerDay()
		{
			$array=$this->getLastWeek();
		
			for($i=0;$i<sizeof($array);$i++)
			{
				$numbers[$i]=$this->adsClickedSpecificDay($array[$i]);
				$dates[$i]=$array[$i];
			}
			$x=sizeof($numbers)-1;
			for($i=0;$i<sizeof($array);$i++)
			{
				$rearranged[$i]=$numbers[$x];
				$datesRight[$i]=$array[$x];
				$x--;
			}
			$results['clicked']=$rearranged;
			
			
			return $results;
		}
	}
?>