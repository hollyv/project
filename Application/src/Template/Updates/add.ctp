 <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
        <li><?= $this->Html->link(__('Reports'), ['controller' => 'Tickets','action' => 'allReports']) ?></li>
        <div id= "current"><li><?= $this->Html->link('Tickets', ['controller' => 'Tickets','action' => 'users', $loguser = $this->request->session()->read('Auth.User.id'),]); ?></li></div>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Analysts'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Priorities'), ['controller' => 'Priorities', 'action' => 'index']) ?></li>
     </ul>
</nav>
<div class="updates form large-9 medium-8 columns content">
    <?= $this->Form->create($update) ?>
    <fieldset>
        <legend><?= __('Add Update') ?></legend>
        <?php
            //echo $this->Form->input('ticket_id', ['options' => $tickets]);
            echo $this->Form->hidden('ticket_id', ['value' => $id]);
            echo $this->Form->input('update_text');
            $loguser = $this->request->session()->read('Auth.User.id');
            echo $this->Form->hidden('analyst_id', ['value' => $loguser]);
            echo $this->Form->label('time Booking (mins)');
            echo $this->Form->input('time_booking',array('label' => false));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
