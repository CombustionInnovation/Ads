$(document).ready(function(){


   $('.chart').easyPieChart({
        animate: 2000,
		lineWidth:8,
		barColor: '#126C89',
		trackColor: '#303030',
		scaleColor: '#ffffff'
		
    });
	
	    $('.chart1').easyPieChart({
        animate: 2000,
		lineWidth:8,
		barColor: '#126C89',
		trackColor:'#202020',
		scaleColor: '#ffffff'
		
    });
	    $('.chart2').easyPieChart({
        animate: 2000,
		lineWidth:8,
		barColor: '#126C89',
		trackColor:'#303030',
		scaleColor: '#ffffff'
		
    });
	    $('.chart3').easyPieChart({
        animate: 2000,
		lineWidth:8,
		barColor: '#126C89',
		trackColor:'#202020',
		scaleColor: '#ffffff'
		
    });

	
	
	//getGenderData();
	createLineChart();
	
});


function getGenderData()
{


	$.post( "http://pinstantapp.com/admin/php/genderAnalytics.php", { func: "getNameAndTime" }, function( data ) {
	
		
		$("#theNumber").text(data.total);
		
			$("#males span").text(data.male + "%");
			$("#females span").text(data.female + "%");
			$("#unknowns span").text(data.unknown + "%");
	
		$('.chart').data('easyPieChart').update(data.male);
		$('.chart1').data('easyPieChart').update(data.female);
		$('.chart2').data('easyPieChart').update(data.unknown);

	}, "json");

}





function createLineChart(){

$.post( "http://combustionlaboratory.com/ads/php/adsViewedPerDay.php", { func: "getNameAndTime" }, function( data ) {
	//console.log(data.dates);
	var lineChartData = {
			labels : data.dates,
			datasets : [
				{
					fillColor : "rgba(43, 43, 43, 1)",
					strokeColor : "rgba(18,108,137,1)",
					pointColor : "rgb(214, 214, 214)",
					pointStrokeColor : "#ffffff",
					data : data.results,
				},
				{
					fillColor : "rgba(255,255,255,.7)",
					strokeColor : "rgb(137, 140, 144)",
					pointColor : "rgb(214, 214, 214)",
					pointStrokeColor : "#ffffff",
					data : data.clicked,
				},
			]

		}

	var myLine = new Chart(document.getElementById("newchart").getContext("2d")).Line(lineChartData);


	}, "json");

}




$(window).resize(function(){
	var width = $(document).width();
	//$("#newchart").width(width);

});