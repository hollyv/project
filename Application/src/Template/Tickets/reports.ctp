 <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
        <div id= "current"><li><?= $this->Html->link(__('Reports'), ['controller' => 'Tickets','action' => 'allReports']) ?></li></div>
        <li><?= $this->Html->link('Tickets', ['controller' => 'Tickets','action' => 'users', $loguser = $this->request->session()->read('Auth.User.id'),]); ?></li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Analysts'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Priorities'), ['controller' => 'Priorities', 'action' => 'index']) ?></li>
     </ul>
</nav>
<div id="all"><?= $this->Html->link(__('All Reports'), ['controller' => 'Tickets', 'action' => 'allReports']) ?></h5></div>
<section>
<fieldset>
<h3 style="margin-left: 5%;">Anaylst Comparision </h3>

 	<div id="priority_kpi">
		<div id="ticket_title">Time bookings per analyst</div>
    <h5>Bookings for the past month (<?= date('d-M-y', strtotime('-30 days'))?>): </h5> 
  <?php foreach ($booking as $b=>$b_value): ?>

    <div id="singleUpdate">
    <?= h($b) ?>: 
    <?php if($b_value->time_booking == null): ?>
      0 </br>
    <?php elseif($b_value->time_booking > 60): ?>
    <?php $new = $b_value->time_booking / 60; ?>
    <?= round(h($new),2) ?> hr </br>
    <?php else: ?>
      <?= h($b_value->time_booking) ?> mins </br>
    <?php endif ?>   


</div>
  
  <?php  endforeach; ?>
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
            data.addColumn('number', 'Number of tickets');
            <?php $i = 0; ?>
            <?php foreach ($analysts as $a): ?>
            data.addRows([[ '<?= h($a->username) ?>', <?= h($numTickets[$i]) ?> ]]);
            // Create the data table.
            <?php $i = $i + 1; ?>
            <?php endforeach; ?>

            var data3 = new google.visualization.DataTable();
            data3.addColumn('string', 'Topping');    
            data3.addColumn('number', 'Number of tickets');
            <?php $i = 0; ?>
            <?php foreach ($avgTime as $avg=>$avg_value): ?>
            data3.addRows([[ '<?= h($avg) ?>', <?= h($avg_value) ?> ]]);
            // Create the data table.
            <?php $i = $i + 1; ?>
            <?php endforeach; ?>

            var data2 = new google.visualization.DataTable();
            data2.addColumn('string', 'Ticket Type');
            data2.addColumn('number', 'Number of tickets');
            data2.addRows([
              ['Business Systems', <?= h($bs) ?> ],
              ['DBA', <?= h($dba) ?> ],
              ['Functional Support', <?= h($fs) ?> ],
              ['Infrastructure', <?= h($infa) ?> ],
              ['Network Support', <?= h($ns) ?>],
              ['Projects and Admin', <?= h($ps) ?> ]
            ]);


            // Set chart options
            var options = {'title':'Number of tickets open per Analyst',
                           'width':500,
                           'height':340,
                           'sliceVisibilityThreshold' :0,
                           'vAxis': {title: 'Num of Tickets'},
                           'xAxis': {title: 'Department'},
                           'legend': {position: 'none'},
                           'colors': ['#029eea'],
                           'chartArea': {'width': '90%', 'height': '85%'}};

              var options2 = {'title':'Number of tickets open per Support Team ',
                           'width':500,
                           'height':340,
                           'is3D': true,
                           'sliceVisibilityThreshold' :0,
                           'chartArea': {'width': '60%', 'height': '60%'}};

              var options3 = {'title':'Average resolution time per analyst',
                           'width':500,
                           'height':340,
                           'sliceVisibilityThreshold' :0,
                           'vAxis': {title: 'Avg Time (Days)'},
                           'xAxis': {title: 'Analyst'},
                           'legend': {position: 'none'},
                           'colors': ['#029eea'],
                           'chartArea': {'width': '80%', 'height': '85%'}};

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.ColumnChart(document.getElementById('ticket_chart4'));
            chart.draw(data, options);

            var chart2 = new google.visualization.PieChart(document.getElementById('ticket_chart5'));
            chart2.draw(data2, options2);

            var chart3 = new google.visualization.ColumnChart(document.getElementById('ticket_chart1'));
            chart3.draw(data3, options3);

          }
        </script>
      </head>

      <body>
        <!--Divs that will hold the charts-->
        <div id="ticket_chart4"></div>
        <div id="ticket_chart5"></div>
        <div id="ticket_chart1"></div>

        
      </body>

    </html>
</fieldset> 
</section>