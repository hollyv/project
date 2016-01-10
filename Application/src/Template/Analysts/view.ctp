<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Analyst'), ['action' => 'edit', $analyst->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Analyst'), ['action' => 'delete', $analyst->id], ['confirm' => __('Are you sure you want to delete # {0}?', $analyst->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Analysts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Analyst'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Updates'), ['controller' => 'Updates', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Update'), ['controller' => 'Updates', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="analysts view large-9 medium-8 columns content">
    <h3><?= h($analyst->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Username') ?></th>
            <td><?= h($analyst->username) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($analyst->password) ?></td>
        </tr>
        <tr>
            <th><?= __('Firstname') ?></th>
            <td><?= h($analyst->firstname) ?></td>
        </tr>
        <tr>
            <th><?= __('Lastname') ?></th>
            <td><?= h($analyst->lastname) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($analyst->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Role') ?></h4>
        <?= $this->Text->autoParagraph(h($analyst->role)); ?>
    </div>
    <div class="row">
        <h4><?= __('Supportteam') ?></h4>
        <?= $this->Text->autoParagraph(h($analyst->supportteam)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tickets') ?></h4>
        <?php if (!empty($analyst->tickets)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Customer Id') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Category') ?></th>
                <th><?= __('Analyst Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Ticket Type') ?></th>
                <th><?= __('Resolution Date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($analyst->tickets as $tickets): ?>
            <tr>
                <td><?= h($tickets->id) ?></td>
                <td><?= h($tickets->customer_id) ?></td>
                <td><?= h($tickets->status) ?></td>
                <td><?= h($tickets->title) ?></td>
                <td><?= h($tickets->description) ?></td>
                <td><?= h($tickets->category) ?></td>
                <td><?= h($tickets->analyst_id) ?></td>
                <td><?= h($tickets->created) ?></td>
                <td><?= h($tickets->ticket_type) ?></td>
                <td><?= h($tickets->resolution_date) ?></td>
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
    <div class="related">
        <h4><?= __('Related Updates') ?></h4>
        <?php if (!empty($analyst->updates)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Ticket Id') ?></th>
                <th><?= __('Update Text') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Analyst Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($analyst->updates as $updates): ?>
            <tr>
                <td><?= h($updates->id) ?></td>
                <td><?= h($updates->ticket_id) ?></td>
                <td><?= h($updates->update_text) ?></td>
                <td><?= h($updates->created) ?></td>
                <td><?= h($updates->analyst_id) ?></td>
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
