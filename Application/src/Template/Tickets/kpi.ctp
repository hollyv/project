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
<h3 style="margin-left: 5%;">Key Performance Indicators - Tickets </h3>

 	<div id="priority_kpi">
    <div id="ticket_title">Trending Issues</div>
    <div id="highTrending">
        <h5 >Most problematic ticket categories: </h5> 
        <div id="items_trending">
          <?php $i = 0; ?>
            <?php foreach ($cat as $c=>$c_value): ?>
              <?php if($i < 5): ?>
                <?= $c ?> (<?= $c_value ?> tickets) </br>
                <?php $i = $i + 1; ?>
              <?php endif ?>
            <?php endforeach; ?>
        </div>
        <div id="trendingIcon"> <?php echo $this->Html->image('redUp.png', array('alt' => 'Numatic Logo', 'border' => '0', 'data-src' => 'holder.js/100%x100', 'draggable' => 'false', 'style' => 'margin-left: 20px;')); ?></div>
      </div>
        <div id="lowTrending">
          <h5 >Least problematic ticket categories: </h5> 
          <div id="items_trending">
            <?php $i = 0; ?>
            <?php foreach ($cat2 as $c2=>$c2_value): ?>
              <?php if($i < 5): ?>
                <?= $c2 ?> (<?= $c2_value ?> tickets) </br>
                <?php $i = $i + 1; ?>
              <?php endif ?>
            <?php endforeach; ?>
          </div>
          <div id="trendingIcon"> <?php echo $this->Html->image('greenDown.png', array('alt' => 'Numatic Logo', 'border' => '0', 'data-src' => 'holder.js/100%x100', 'draggable' => 'false', 'style' => 'margin-left: 20px;')); ?></div>
        </div>
      </div>

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

            var data3 = new google.visualization.DataTable();
            data3.addColumn('string', 'Ticket Status');
            data3.addColumn('number', 'Number of tickets');
            data3.addRows([
              ['New', <?= h($new) ?> ],
              ['Pending', <?= h($pending) ?> ],
              ['Resolved', <?= h($resolved) ?> ]
            ]);

            var data4 = new google.visualization.DataTable();
            data4.addColumn('string', 'Ticket Status');
            data4.addColumn('number', 'Number of tickets');
            <?php foreach ($depInfo as $a=>$a_value): ?>
            data4.addRows([[ '<?= h($a) ?>', <?= h($a_value) ?> ]]);
            <?php endforeach ?>


            // Set chart options
            var options = {'title':'All Open Tickets by Priority',
                           'width':300,
                           'height':300,
                           'is3D': true,
                           'chartArea': {'width': '90%', 'height': '90%'}};
            // Set chart options
            var options2 = {'title':'All Open Tickets by Type',
                           'width':300,
                           'height':300,
                           'is3D': true,
                           'colors': ['#E67300', '#3B3EAC', '#329262', '#f3b49f', '#f6c7b6'],
                           'chartArea': {'width': '90%', 'height': '90%'}};
            // Set chart options
            var options3 = {'title':'All Open Tickets by Status',
                           'width':300,
                           'height':300,
                           'is3D': true,
                           'colors': ['#316395', '#66AA00', '#B82E2E', '#994499'],
                           'chartArea': {'width': '90%', 'height': '90%'}};

            var options4 = {'title':'All Open Tickets by Department',
                           'width':500,
                           'height':340,
                           'is3D': true,
                           'colors': ['#029eea', '#B82E2E', '#994499'],
                           'vAxis': {title: 'Num of Tickets'},
                           'xAxis': {title: 'Department'},
                           'legend': {position: 'none'},
                           'chartArea': {'width': '90%', 'height': '70%'}};
            
            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('ticket_chart1'));
            chart.draw(data, options);
            var chart2 = new google.visualization.PieChart(document.getElementById('ticket_chart2'));
            chart2.draw(data2, options2);
            var chart3 = new google.visualization.PieChart(document.getElementById('ticket_chart3'));
            chart3.draw(data3, options3);
            var chart4 = new google.visualization.ColumnChart(document.getElementById('ticket_chart4'));
            chart4.draw(data4, options4);

          }
        </script>
      </head>

      <body>
        <!--Divs that will hold the charts-->
        <div id="ticket_chart4"></div>
        <div id="ticket_chart1"></div>
        <div id="ticket_chart2"></div>
        <div id="ticket_chart3"></div>
        

      </body>
    </html>
</fieldset> 
</section>