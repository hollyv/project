 <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
        <div id= "current"><li><?= $this->Html->link(__('Reports'), ['controller' => 'Tickets','action' => 'homepage']) ?></li></div>
        <li><?= $this->Html->link('Tickets', ['controller' => 'Tickets','action' => 'users', $loguser = $this->request->session()->read('Auth.User.id'),]); ?></li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Analysts'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Priorities'), ['controller' => 'Priorities', 'action' => 'index']) ?></li>
     </ul>
</nav>
<section>
<fieldset>

  <div id="greyContent">
  <h3> All Reports: </h3>

  <div id="reportLink">
    <div id="linkImage">
      <?php echo $this->Html->image('stats.png', array('alt' => 'Numatic Logo', 'border' => '0', 'data-src' => 'holder.js/100%x100', 'draggable' => 'false', 'style' => 'margin-left: 20px;')); ?></div>
    <h3><?= $this->Html->link(__('Tickets Summary'), ['controller' => 'Tickets', 'action' => 'kpi']) ?>  </h3>
    <h5>General ticket statistics</h5>
  </div>
  
  <div id="reportLink">
    <div id="linkImage">
      <?php echo $this->Html->image('people.png', array('alt' => 'Numatic Logo', 'border' => '0', 'data-src' => 'holder.js/100%x100', 'draggable' => 'false', 'style' => 'margin-left: 20px;')); ?>
    </div>
   <h3><?= $this->Html->link(__('Analyst Comparision'), ['controller' => 'Tickets', 'action' => 'reports']) ?>  </h3> 
   <h5>Comparision of analysts performance</h5>
 </div>
  
  <div id="reportLink">
    <div id="linkImage">
      <?php echo $this->Html->image('user.png', array('alt' => 'Numatic Logo', 'border' => '0', 'data-src' => 'holder.js/100%x100', 'draggable' => 'false', 'style' => 'margin-left: 20px;')); ?>
    </div>
   <h3><?= $this->Html->link(__('Individual Analyst Timebookings'), ['controller' => 'Tickets', 'action' => 'index']) ?></h3> 
   <h5>Individual analyst timebookings and updates</h5>
  </div>
  
   <div id="reportLink">
    <div id="linkImage">
      <?php echo $this->Html->image('avatar.png', array('alt' => 'Numatic Logo', 'border' => '0', 'data-src' => 'holder.js/100%x100', 'draggable' => 'false', 'style' => 'margin-left: 20px;')); ?>
    </div>
   <h3><?= $this->Html->link(__('My Timebookings'), ['controller' => 'Updates', 'action' => 'analyst']) ?></h3> 
   <h5>My timebookings and updates</h5>
  </div>

  </div>

</fieldset> 
</section>