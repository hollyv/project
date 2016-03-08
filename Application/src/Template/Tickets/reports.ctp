 <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <div id= "current"><li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets','action' => 'homepage']) ?></li></div>
        <li><?= $this->Html->link(__('Reports'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
        <li><?= $this->Html->link('Tickets', ['controller' => 'Tickets','action' => 'users', $loguser = $this->request->session()->read('Auth.User.id'),]); ?></li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Analysts'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Priorities'), ['controller' => 'Priorities', 'action' => 'index']) ?></li>
     </ul>
</nav>
<section>
<fieldset>
<h1>Anaylst Comparision </h1>

 	<div id="priority_kpi">
		<h4>Time bookings per analyst</h4>
	<table>
		<tr>
			<th>Anaylst</th>
			<th>Time booking</th>
		</tr>
		<tr>
			<td>High:</td>
			<td></td>
		</tr>
	</table>
	</div>	

 <html>
 <?php 
 foreach ($analysts as $a) {
   echo $a;
   echo $a->id;
 }


 // $current = date('d/m/Y H:i:s', time());
 // echo $current;
 //   echo date($current, strtotime("+2 weeks"));
 //   echo '||' . date('d-m-Y', strtotime("-1 day"));
   
 //    foreach ($query as $q) {
 //   echo $q;
 //   echo $analystsTime['hollyv'];
 //}
?>
 
      <head>
      	
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">

          // Load the Visualization API and the piechart package.
          google.load('visualization', '1.0', {'packages':['corechart']});

          // Set a callback to run when the Google Visualization API is loaded.
          google.setOnLoadCallback(drawChart);

          // Callback that creates and populates a data table,
          // instantiates the pie chart, passes in the data and
          // draws it.
          function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');    
            data.addColumn('number', 'Slices');
            <?php foreach ($analysts as $a): ?>
            <?php $name = $a->username;?>
            data.addRows([[ '<?= h($a->username) ?>', <?= h($a->id) ?> ]]);
            // Create the data table.
            <?php endforeach; ?>
            // Set chart options
            var options = {'title':'Number of tickets open per Analyst',
                           'width':600,
                           'height':500};

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);


          }
        </script>
      </head>

      <body>
        <!--Divs that will hold the charts-->
        <div id="chart_div"></div>
        <div id="chart_div2"></div>
        <!--<div id="chart_div3"></div>-->
      </body>
    </html>
</fieldset> 
</section>