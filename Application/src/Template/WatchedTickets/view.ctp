<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Watched Ticket'), ['action' => 'edit', $watchedTicket->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Watched Ticket'), ['action' => 'delete', $watchedTicket->id], ['confirm' => __('Are you sure you want to delete # {0}?', $watchedTicket->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Watched Tickets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Watched Ticket'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Analysts'), ['controller' => 'Analysts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Analyst'), ['controller' => 'Analysts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="watchedTickets view large-9 medium-8 columns content">
    <h3><?= h($watchedTicket->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Analyst') ?></th>
            <td><?= $watchedTicket->has('analyst') ? $this->Html->link($watchedTicket->analyst->username, ['controller' => 'Analysts', 'action' => 'view', $watchedTicket->analyst->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Ticket') ?></th>
            <td><?= $watchedTicket->has('ticket') ? $this->Html->link($watchedTicket->ticket->title, ['controller' => 'Tickets', 'action' => 'view', $watchedTicket->ticket->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Comment') ?></th>
            <td><?= h($watchedTicket->comment) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($watchedTicket->id) ?></td>
        </tr>
    </table>
</div>
