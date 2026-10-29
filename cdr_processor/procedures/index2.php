<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<style>
	#dynamic_data{
		border: 1px solid gray;
		border-radius: 10px;
		padding: 10px;
		text-decoration:none;
		float:left;
		margin:4px;
		text-align:center;
		display: block;
		color: green;
	}
</style>
<script>
$(function () {
 
		//on page load  
		getAjaxData(1);
 
		//on changing select option
		$('#dynamic_data').change(function(){
			var val = $('#dynamic_data').val();
			getAjaxData(val);
		});
 
		function getAjaxData(id){
 
		//use getJSON to get the dynamic data via AJAX call
		$.getJSON('data.php', {id: id}, function(chartData) {
			$('#container').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Highcharts - Pulling data from PHP using Ajax'
				},
				xAxis: {
					categories: ['One', 'Two', 'Three']
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Value'
					}
				},
				series: chartData
			});
		});
	}
});
</script>
</head>
<body>
<h3><a href="http://blog.theonlytutorials.com/highcharts-pass-data-dynamically-jquery/">Go back to the Tutorial</a></h3>
<select id="dynamic_data">
	<option value="0">Select Data</option>
	<option value="1" selected>Data 1</option>
	<option value="2">Data 2</option>
	<option value="3">Data 3</option>
</select>
<div id="container" style="width: 50%;min-width: 310px; height: 400px; margin: 0 auto"></div>
</body>
</html>