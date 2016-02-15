<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
        <li><?= $this->Html->link(__('Reports'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
        <li><?= $this->Html->link(__('Tickets'), ['controller' => 'Tickets','action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Analysts'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <div id= "current"><li><?= $this->Html->link(__('Priorities'), ['controller' => 'Priorities', 'action' => 'index']) ?></li></div>
    </ul>
</nav>
<div class="priorities view large-9 medium-8 columns content">
    <h3><?= h($priority->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($priority->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Resolution Time') ?></th>
            <td><?= h($priority->resolution_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($priority->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Tickets') ?></h4>
        <?php if (!empty($priority->tickets)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Customer Id') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Priority Id') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Category') ?></th>
                <th><?= __('Analyst Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Ticket Type') ?></th>
                <th><?= __('Resolution Date') ?></th>
                <th><?= __('Total Time') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($priority->tickets as $tickets): ?>
            <tr>
                <td><?= h($tickets->id) ?></td>
                <td><?= h($tickets->customer_id) ?></td>
                <td><?= h($tickets->status) ?></td>
                <td><?= h($tickets->title) ?></td>
                <td><?= h($tickets->priority_id) ?></td>
                <td><?= h($tickets->description) ?></td>
                <td><?= h($tickets->category) ?></td>
                <td><?= h($tickets->analyst_id) ?></td>
                <td><?= h($tickets->created) ?></td>
                <td><?= h($tickets->ticket_type) ?></td>
                <td><?= h($tickets->resolution_date) ?></td>
                <td><?= h($tickets->total_time) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tickets', 'action' => 'view', $tickets->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tickets', 'action' => 'edit', $tickets->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tickets', 'action' => 'delete', $tickets->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tickets->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
