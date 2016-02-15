 <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <div id= "current"><li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets','action' => 'homepage']) ?></li></div>
        <li><?= $this->Html->link(__('Reports'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
        <li><?= $this->Html->link(__('Tickets'), ['controller' => 'Tickets','action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Analysts'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Priorities'), ['controller' => 'Priorities', 'action' => 'index']) ?></li>
     </ul>
</nav>
<section>
<fieldset>
<h1>Key Performance Indicators </h1>

 	<div id="priority_kpi">
		<h4>My Tickets by Priority</h4>
	<table>
		<tr>
			<th>Priority</th>
			<th>Number of Tickets</th>
		</tr>
		<tr>
			<td>High:</td>
			<td><?= h($myHigh) ?></td>
		</tr>
		<tr>
			<td>Medium:</td>
			<td><?= h($myMed) ?></td>
		</tr>
		<tr>
			<td>Low:</td>
			<td><?= h($myLow) ?></td>
		</tr>
		<tr>
			<td>On Going:</td>
			<td><?= h($myOngoing) ?></td>
		</tr>
		<tr>
			<td>Total:</td>
			<td><?= h($mytotal) ?></td>
		</tr>
	</table>
	</div>	

 <html>

 
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
            data.addRows([
          	  ['On Going', <?= h($ongoing) ?> ],
        	  ['High',<?= h($high) ?>],
        	  ['Medium', <?= h($medium) ?>],
        	  ['Low', <?= h($low) ?>]
            ]);
            // Create the data table.
            var data2 = new google.visualization.DataTable();
            data2.addColumn('string', 'Topping');
            data2.addColumn('number', 'Slices');
            data2.addRows([
              ['Incident', <?= h($incident) ?> ],
              ['Request', <?= h($request) ?> ],
              ['Problem', <?= h($problem) ?> ]
            ]);
            /**
            var data3 = new google.visualization.DataTable();
            data3.addColumn('string', 'Year');
            data3.addColumn('number', 'Sales');
            data3.addColumn('number', 'Expenses');
            data3.addRows([
              ['2004', 1000, 400],
              ['2005', 1170, 460],
              ['2006',  860, 580],
              ['2007', 1030, 540]
            ]);**/

            // Set chart options
            var options = {'title':'Tickets by Priority',
                           'width':400,
                           'height':300};
            // Set chart options
            var options2 = {'title':'Ticket Type',
                           'width':400,
                           'height':300};
            /** Set chart options
            var options3 = {'title':'Line chart',
                           'width':400,
                           'height':300};
            **/
            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
            var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
            chart2.draw(data2, options2);
            //var chart3 = new google.visualization.LineChart(document.getElementById('chart_div3'));
            //chart3.draw(data3, options3);

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