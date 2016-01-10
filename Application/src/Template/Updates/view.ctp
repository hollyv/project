<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Update'), ['action' => 'edit', $update->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Update'), ['action' => 'delete', $update->id], ['confirm' => __('Are you sure you want to delete # {0}?', $update->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Updates'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Update'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Analysts'), ['controller' => 'Analysts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Analyst'), ['controller' => 'Analysts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="updates view large-9 medium-8 columns content">
    <h3><?= h($update->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Ticket') ?></th>
            <td><?= $update->has('ticket') ? $this->Html->link($update->ticket->title, ['controller' => 'Tickets', 'action' => 'view', $update->ticket->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Update Text') ?></th>
            <td><?= h($update->update_text) ?></td>
        </tr>
        <tr>
            <th><?= __('Analyst') ?></th>
            <td><?= $update->has('analyst') ? $this->Html->link($update->analyst->id, ['controller' => 'Analysts', 'action' => 'view', $update->analyst->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($update->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($update->created) ?></tr>
        </tr>
    </table>
</div>
