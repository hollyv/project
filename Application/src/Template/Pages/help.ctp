 <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
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
<div id="help"> <h1> Help </h1></div>
    <?php echo $this->Html->image('help.png', array('alt' => 'Numatic Logo', 'border' => '0', 'data-src' => 'holder.js/100%x100', 'draggable' => 'false', 'style' => 'margin-left: 20px;')); ?>
</br></br>
<h5> To reset your password please contact your manager. </h5> 
<h5> To see the system's user guide: <?= $this->Html->link('click here','/pdf/userGuide.pdf'); ?></h5>

<h5> For further queries please contact the IS helpdesk team on ext. 245</h5>
</fieldset> </section>