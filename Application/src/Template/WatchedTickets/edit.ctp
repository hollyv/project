<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $watchedTicket->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $watchedTicket->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Watched Tickets'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="watchedTickets form large-9 medium-8 columns content">
    <?= $this->Form->create($watchedTicket) ?>
    <fieldset>
        <legend><?= __('Edit Watched Ticket') ?></legend>
        <?php
            echo $this->Form->input('analyst_id', ['options' => $users]);
            echo $this->Form->input('ticket_id', ['options' => $tickets]);
            echo $this->Form->input('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
