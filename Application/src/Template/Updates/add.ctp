<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Updates'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Analysts'), ['controller' => 'Analysts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Analyst'), ['controller' => 'Analysts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="updates form large-9 medium-8 columns content">
    <?= $this->Form->create($update) ?>
    <fieldset>
        <legend><?= __('Add Update') ?></legend>
        <?php
            echo $this->Form->input('ticket_id', ['options' => $tickets]);
            echo $this->Form->input('update_text');
            echo $this->Form->input('analyst_id', ['options' => $analysts]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
