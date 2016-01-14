<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Watched Ticket'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Analysts'), ['controller' => 'Analysts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Analyst'), ['controller' => 'Analysts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="watchedTickets index large-9 medium-8 columns content">
    <h3><?= __('Watched Tickets') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('analyst_id') ?></th>
                <th><?= $this->Paginator->sort('ticket_id') ?></th>
                <th><?= $this->Paginator->sort('comment') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($watchedTickets as $watchedTicket): ?>
            <tr>
                <td><?= $this->Number->format($watchedTicket->id) ?></td>
                <td><?= $watchedTicket->has('analyst') ? $this->Html->link($watchedTicket->analyst->id, ['controller' => 'Analysts', 'action' => 'view', $watchedTicket->analyst->id]) : '' ?></td>
                <td><?= $watchedTicket->has('ticket') ? $this->Html->link($watchedTicket->ticket->title, ['controller' => 'Tickets', 'action' => 'view', $watchedTicket->ticket->id]) : '' ?></td>
                <td><?= h($watchedTicket->comment) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $watchedTicket->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $watchedTicket->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $watchedTicket->id], ['confirm' => __('Are you sure you want to delete # {0}?', $watchedTicket->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
