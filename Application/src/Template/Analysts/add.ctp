<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Analysts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Updates'), ['controller' => 'Updates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Update'), ['controller' => 'Updates', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Watched Tickets'), ['controller' => 'WatchedTickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Watched Ticket'), ['controller' => 'WatchedTickets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="analysts form large-9 medium-8 columns content">
    <?= $this->Form->create($analyst) ?>
    <fieldset>
        <legend><?= __('Add Analyst') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('password');
            echo $this->Form->input('firstname');
            echo $this->Form->input('lastname');
            echo $this->Form->input('role');
            echo $this->Form->input('Support Team','supportteam');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
