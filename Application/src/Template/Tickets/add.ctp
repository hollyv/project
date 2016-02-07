<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tickets'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Priorities'), ['controller' => 'Priorities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Priority'), ['controller' => 'Priorities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Updates'), ['controller' => 'Updates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Update'), ['controller' => 'Updates', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tickets form large-9 medium-8 columns content">
    <?= $this->Form->create($ticket) ?>
    <fieldset>
        <legend><?= __('Add Ticket') ?></legend>
        <?php
            echo $this->Form->input('customer', ['options' => $customers, 'empty' => true]);
            echo 'Status';
            echo $this->Form->select(
                'status',
                ['Open' => 'Open', 'Pending' => 'Pending', 'Resolved' => 'Resolved', 'Closed' => 'Closed'],
                ['empty' => '(choose one)']
                );
            echo $this->Form->input('title');
            echo $this->Form->input('priority_id', ['options' => $priorities, 'empty' => true]);
            echo $this->Form->input('description');
            echo 'Category';
            echo $this->Form->select(
                'category',
                ['Hardware' => 'Hardware', 'Software' => 'Software'],
                ['empty' => '(choose one)']
                );
            echo $this->Form->input('analyst_id', ['options' => $users]);
            echo 'Ticket Type';
             echo $this->Form->select(
                'ticket_type',
                ['Incident' => 'Incident', 'Request' => 'Request', 'Problem' => 'Problem Management'],
                ['empty' => '(choose one)']
                );
            echo $this->Form->input('resolution_date', ['empty' => true, 'default' => '']);
            echo $this->Form->input('total_time');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>