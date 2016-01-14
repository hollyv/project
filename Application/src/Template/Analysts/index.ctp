<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Analyst'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Updates'), ['controller' => 'Updates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Update'), ['controller' => 'Updates', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Watched Tickets'), ['controller' => 'WatchedTickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Watched Ticket'), ['controller' => 'WatchedTickets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="analysts index large-9 medium-8 columns content">
    <h3><?= __('Analysts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('username') ?></th>
                <th><?= $this->Paginator->sort('password') ?></th>
                <th><?= $this->Paginator->sort('firstname') ?></th>
                <th><?= $this->Paginator->sort('lastname') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($analysts as $analyst): ?>
            <tr>
                <td><?= $this->Number->format($analyst->id) ?></td>
                <td><?= h($analyst->username) ?></td>
                <td><?= h($analyst->password) ?></td>
                <td><?= h($analyst->firstname) ?></td>
                <td><?= h($analyst->lastname) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $analyst->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $analyst->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $analyst->id], ['confirm' => __('Are you sure you want to delete # {0}?', $analyst->id)]) ?>
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
