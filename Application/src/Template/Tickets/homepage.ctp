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
<h3>Welcome <?= h($this->request->session()->read('Auth.User.username')) ?> </h3>
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
          	['On Going', <?= h($myOngoing) ?> ],
        	  ['High',<?= h($myHigh) ?>],
        	  ['Medium', <?= h($myMed) ?>],
        	  ['Low', <?= h($myLow) ?>]
            ]);
          

            // Set chart options
            var options = {'title':'My Tickets by Priority',
                           'width':300,
                           'height':300,
                           'is3D': true,
                           'chartArea': {'width': '100%', 'height': '90%'}};

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);

          }
        </script>
      </head>

      <body>
        <!--Divs that will hold the charts-->
        <div id="priority_kpi">
        <div id="chart_div"></div>
        <b>Total Tickets Open: <?= h($mytotal) ?></b>
        </div>
        <!--<div id="chart_div3"></div>-->
        <div id="notifications">
        <div id="ticket_title">Notifications</div>
        </div>

        <div id="notifications">
        <div id="ticket_title">Needs Attention</div>
        </div>

        <div id="priority_kpi">
        <div id="ticket_title">Hot Issues</div>
        </div>

      </body>
    </html>
</fieldset> 
</section>