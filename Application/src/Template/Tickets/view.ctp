<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ticket'), ['action' => 'edit', $ticket->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ticket'), ['action' => 'delete', $ticket->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ticket->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tickets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ticket'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Analysts'), ['controller' => 'Analysts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Analyst'), ['controller' => 'Analysts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Updates'), ['controller' => 'Updates', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Update'), ['controller' => 'Updates', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tickets view large-9 medium-8 columns content">
    <h3><?= h($ticket->title) ?></h3>
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
            <th><?= __('Description') ?></th>
            <td><?= h($ticket->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Category') ?></th>
            <td><?= h($ticket->category) ?></td>
        </tr>
        <tr>
            <th><?= __('Analyst') ?></th>
            <td><?= $ticket->has('analyst') ? $this->Html->link($ticket->analyst->username, ['controller' => 'Analysts', 'action' => 'view', $ticket->analyst->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Ticket Type') ?></th>
            <td><?= h($ticket->ticket_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Ticket Id') ?></th>
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
        <h4><?= __('Related Updates') ?></h4>
        <?php if (!empty($ticket->updates)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Ticket Id') ?></th>
                <th><?= __('Update Text') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Analyst Id') ?></th>
                <th><?= __('Time Booking') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($ticket->updates as $updates): ?>
            <tr>
                <td><?= h($updates->id) ?></td>
                <td><?= h($updates->ticket_id) ?></td>
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
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
