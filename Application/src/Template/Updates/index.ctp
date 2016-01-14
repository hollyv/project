<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Update'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Analysts'), ['controller' => 'Analysts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Analyst'), ['controller' => 'Analysts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="updates index large-9 medium-8 columns content">
    <h3><?= __('Updates') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('ticket_id') ?></th>
                <th><?= $this->Paginator->sort('update_text') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('analyst_id') ?></th>
                <th><?= $this->Paginator->sort('time_booking') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($updates as $update): ?>
            <tr>
                <td><?= $this->Number->format($update->id) ?></td>
                <td><?= $update->has('ticket') ? $this->Html->link($update->ticket->title, ['controller' => 'Tickets', 'action' => 'view', $update->ticket->id]) : '' ?></td>
                <td><?= h($update->update_text) ?></td>
                <td><?= h($update->created) ?></td>
                <td><?= $update->has('analyst') ? $this->Html->link($update->analyst->id, ['controller' => 'Analysts', 'action' => 'view', $update->analyst->id]) : '' ?></td>
                <td><?= $this->Number->format($update->time_booking) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $update->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $update->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $update->id], ['confirm' => __('Are you sure you want to delete # {0}?', $update->id)]) ?>
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
