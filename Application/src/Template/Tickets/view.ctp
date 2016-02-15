<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
        <li><?= $this->Html->link(__('Reports'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
        <div id= "current"><li><?= $this->Html->link(__('Tickets'), ['controller' => 'Tickets','action' => 'index']) ?></li></div>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Analysts'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Priorities'), ['controller' => 'Priorities', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tickets view large-9 medium-8 columns content">
    <h3><?= h($ticket->title) ?></h3>
    <?= $this->Html->link(__('Assign Ticket'), ['controller' => 'Tickets', 'action' => 'assign', $ticket->id]) ?>
    <table class="vertical-table">
        <tr>
            <th><?= __('Customer') ?></th>
            <td><?= $ticket->has('customer') ? $this->Html->link($ticket->customer->username, ['controller' => 'Customers', 'action' => 'view', $ticket->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= h($ticket->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($ticket->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Priority') ?></th>
            <td><?= $ticket->has('priority') ? $this->Html->link($ticket->priority->name, ['controller' => 'Priorities', 'action' => 'view', $ticket->priority->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($ticket->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Category') ?></th>
            <td><?= h($ticket->category) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $ticket->has('user') ? $this->Html->link($ticket->user->username, ['controller' => 'Users', 'action' => 'view', $ticket->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Ticket Type') ?></th>
            <td><?= h($ticket->ticket_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($ticket->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Total Time') ?></th>
            <td><?= $this->Number->format($ticket->total_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($ticket->created) ?></tr>
        </tr>
        <tr>
            <th><?= __('Resolution Date') ?></th>
            <td><?= h($ticket->resolution_date) ?></tr>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Ticket Updates') ?></h4>
        <div id="update"><?= $this->Html->link(__('+ New Update'), ['controller' => 'Updates', 'action' => 'add']) ?></div>
        <?php if (!empty($ticket->updates)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Update Text') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Analyst Id') ?></th>
                <th><?= __('Time Booking') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($ticket->updates as $updates): ?>
            <?php if (!empty($updates->update_text)): ?>
            <tr>
                <td><?= h($updates->update_text) ?></td>
                <td><?= h($updates->created) ?></td>
                <td><?= h($updates->analyst_id) ?></td>
                <td><?= h($updates->time_booking) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Updates', 'action' => 'view', $updates->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Updates', 'action' => 'edit', $updates->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Updates', 'action' => 'delete', $updates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $updates->id)]) ?>

                </td>
            </tr>
            <?php endif; ?>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
