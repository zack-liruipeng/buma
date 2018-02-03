<!--	to be used on statistics page	-->
<!--<link href="css/stat/ace.min.css" rel="stylesheet"/>-->
<link href="css/stat/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="css/stat/ace-responsive.min.css" />
<link rel="stylesheet" href="css/stat/ace-skins.min.css" />
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<!--	=============================	-->

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
	var data = google.visualization.arrayToDataTable([
	  ['Month', 'Budget', 'Used'],
	  ['January',  1000,      400],
	  ['February',  1170,      460],
	  ['March',  660,       1120],
	  ['May',  1030,      50],
	  ['June',  1030,      40],
	  ['July',  800,      560],
	  ['August',  400,      540],
	  ['September',  500,      740],
	  ['October',  300,      640],
	]);

	var options = {
	  title: 'My year summary'
	};

	var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
	chart.draw(data, options);
	
	var data2 = google.visualization.arrayToDataTable([
	  ['Spent', 'MONEY'],
	  ['Residence& housing',     500],
	  ['Eat',      400],
	  ['Hobbies',  500],
	  ['Clothes', 20],
	  ['Others',    60]
	]);
	
	var option = {
	  title: 'My Actual spent money'
	};

	var chart2 = new google.visualization.PieChart(document.getElementById('piechart'));
	chart2.draw(data2, option);
  }
  
 
 
</script>

<h1 class="page-title">Overview & Stats</h1>

<!--Set up ס��-->
<!--<div class="right">
	<div class="clearfix" float:"center">
	<h3>Section</h3>
    <div class="infobox infobox-green">
        <div class="infobox-icon"><i class="icon-comments"></i></div>
            <div class="infobox-data">
                <span class="infobox-data-number">32</span>
                <span class="infobox-content">Residence& housing</span>
            </div>
    <div class="stat stat-success">8%</div>
</div>-->

<!--set up hobbies-->
<!--<div class="infobox infobox-black">
    <div class="infobox-icon"><i class="icon-comments"></i></div>
        <div class="infobox-data">
            <span class="infobox-data-number">80</span>
            <span class="infobox-content">Hobbies</span>
        </div>
<div class="stat stat-success">40%</div>
</div>

<!--Set up ʳ��-->
<!--<div class="infobox infobox-blue">
    <div class="infobox-icon"><i class="icon-twitter"></i></div>
        <div class="infobox-data">
            <span class="infobox-data-number">11</span>
            <span class="infobox-content">Food</span>
        </div>
    <div class="stat stat-success">+32%</div>
</div>

<!--Set up �·�-->
<!--<div class="infobox infobox-pink">
    <div class="infobox-icon"><i class="icon-shopping-cart"></i></div>
        <div class="infobox-data">
            <span class="infobox-data-number">8</span>
            <span class="infobox-content">Clothes</span>
        </div>
    <div class="stat stat-important">4%</div>
</div>

<!--Set up ����-->
<!--<div class="infobox infobox-red">
    <div class="infobox-icon"><i class="icon-beaker"></i></div>
        <div class="infobox-data">
            <span class="infobox-data-number">7</span>
            <span class="infobox-content">Others</span>
        </div>
    <div class="stat stat-important">9%</div>
</div>
<!--Set up ʣ�µ�-->
<!--<div class="infobox infobox-blue2">
    <div class="infobox-progress">
        <div id="remain" ><span class="percent">42</span>%
        </div>
    </div>

    <div class="infobox-data">
        <span class="infobox-text">Money used</span>
        <span class="infobox-content"><span class="approx">~</span> Budget remaining</span>
    </div>
</div>

</div><!--clearfix-->

<br/>
<h3>Pie chart</h3>
<div class="hr hr32 hr-dotted"></div>
     <div id="piechart" ></div>
     
<h3>Summary</h3>
<div class="hr hr32 hr-dotted"></div>
<div id="chart_div"></div>