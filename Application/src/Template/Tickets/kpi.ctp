 <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <div id= "current"><li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets','action' => 'homepage']) ?></li></div>
        <li><?= $this->Html->link(__('Reports'), ['controller' => 'Tickets','action' => 'reports']) ?></li>
        <li><?= $this->Html->link('Tickets', ['controller' => 'Tickets','action' => 'users', $loguser = $this->request->session()->read('Auth.User.id'),]); ?></li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Analysts'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Priorities'), ['controller' => 'Priorities', 'action' => 'index']) ?></li>
     </ul>
</nav>
<section>
<fieldset>
<h3>Ticket Key Performance Indicators </h3>

 	<div id="priority_kpi">
		<h5>Current most problematic departments</h5>
    <?php foreach ($depInfo as $a=>$a_value): ?>
    <?= h($a) ?> (<?= h($a_value) ?> Tickets) </br>

  
  <?php endforeach; ?>

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
            data.addColumn('string', 'Priority');    
            data.addColumn('number', 'Number of tickets');
            data.addRows([
          	  ['On Going', <?= h($ongoing) ?> ],
        	  ['High',<?= h($high) ?>],
        	  ['Medium', <?= h($medium) ?>],
        	  ['Low', <?= h($low) ?>]
            ]);
            // Create the data table.
            var data2 = new google.visualization.DataTable();
            data2.addColumn('string', 'Ticket Type');
            data2.addColumn('number', 'Number of tickets');
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
            var options = {'title':'All Tickets by Priority',
                           'width':350,
                           'height':350,
                           'is3D': true,
                           'chartArea': {'width': '90%', 'height': '90%'}};
            // Set chart options
            var options2 = {'title':'All Tickets by Type',
                           'width':350,
                           'height':350,
                           'is3D': true,
                           'chartArea': {'width': '90%', 'height': '90%'}};
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