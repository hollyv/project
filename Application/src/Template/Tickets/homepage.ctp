 <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <div id= "current"><li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets','action' => 'homepage']) ?></li></div>
        <li><?= $this->Html->link(__('Reports'), ['controller' => 'Tickets','action' => 'allReports']) ?></li>
        <li><?= $this->Html->link('Tickets', ['controller' => 'Tickets','action' => 'users', $loguser = $this->request->session()->read('Auth.User.id'),]); ?></li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Analysts'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Priorities'), ['controller' => 'Priorities', 'action' => 'index']) ?></li>
     </ul>
</nav>
<section>
<fieldset>
<h3 style="margin-left: 5%;">Welcome <?= h($this->request->session()->read('Auth.User.firstname')) ?> </h3>
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
            var options = {'title':'Your Tickets by Priority',
                           'width':300,
                           'height':260,
                           'is3D': true,
                           'sliceVisibilityThreshold' :0,
                           'chartArea': {'width': '100%', 'height': '85%'}};

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);

          }
        </script>
      </head>

      <body>
        <!--Divs that will hold the charts-->
        <div id="priority_kpi">
          <div id="margin">
            <div id="chart_div"></div></br>
          <b>Number of tickets you have open: <?= h($mytotal) ?></b>
          </div>
        </div>
        <!--<div id="chart_div3"></div>-->
        <div id="notifications">
          <div id="ticket_title">Latest Notifications</div>
          <?php foreach ($sysUpdates as $s): ?>
            <div id='singleUpdate'>
            <h5 style="text-align:left;float:left;"><?=  ' Ticket (id: ' .$this->Html->link($s->ticket_id,['controller' => 'Updates', 'action' => 'ticket', $s->ticket_id]) . ') was assigned to you' ?></h5>
            <h5 style="text-align:right;float:right;"><?= $s->created->format('d-M-y H:i') ?></h5>
            </br> 
            </div>
            <?php endforeach; ?>
          </div>
  
        <div id="notifications">
          <div id="ticket_title">Tickets Requiring Your Attention</div>
            <?php if($overdueTickets == null): ?>
               <?php foreach ($results as $r): ?>
                  <div id='nonOverdueItems'>
                  <h5 ><?= $r->title ?></h5>
                          Within SLA - Created: <?= $r->created->format('d-M-y') ?> 
                  </div>
               <?php endforeach; ?>
               <div id="overdueText">
              <p ><?= $this->Html->link('View all your tickets',['controller' => 'Tickets', 'action' => 'assigned', $this->request->session()->read('Auth.User.id') ]) ?></p>  
            <?php else: ?>
               <?php foreach ($overdueTickets as $t): ?>
                  <div id='overdueItems'>
                  <h5 ><?= $t->title . ' (id: ' .$this->Html->link($s->ticket_id,['controller' => 'Updates', 'action' => 'ticket', $s->ticket_id]) . ')' . '  ' . $t->priority->name . ' Priority' ?></h5>
                          Overdue - Created: <?= $t->created->format('d-M-y') ?> 
                  </div>
               <?php endforeach; ?>
              <div id="overdueText">
              <p ><?= $this->Html->link('View all overdue tickets',['controller' => 'Tickets', 'action' => 'overdue']) ?></p>  
            <?php endif ?>
          </div>
        </div>
     
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
      </body>
    </html>
</fieldset> 
</section>