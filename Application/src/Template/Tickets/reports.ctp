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
    
    <?php foreach ($analysts as $a): ?>
		<tr>
			<td><?= h($a->username) ?></td>
			<td><?= h($dba) ?></td>
		</tr>
  
  <?php endforeach; ?>
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
            <?php $i = 0; ?>
            <?php foreach ($analysts as $a): ?>
            <?php $name = $a->username;?>
            data.addRows([[ '<?= h($a->username) ?>', <?= h($numTickets[$i]) ?> ]]);
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
                           'width':440,
                           'height':440,
                           'is3D': true
                            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div1'));
            chart.draw(data, options);

            var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
            chart2.draw(data2, options);


          }
        </script>
      </head>

      <body>
        <!--Divs that will hold the charts-->
        <div id="chart_div1"></div>
        <div id="chart_div2"></div>
        <!--<div id="chart_div3"></div>-->

        
      </body>

    </html>
</fieldset> 
</section>