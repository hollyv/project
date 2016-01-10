<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customers index large-9 medium-8 columns content">
    <h3><?= __('Customers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('username') ?></th>
                <th><?= $this->Paginator->sort('firstname') ?></th>
                <th><?= $this->Paginator->sort('lastname') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th><?= $this->Paginator->sort('phone') ?></th>
                <th><?= $this->Paginator->sort('department_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= $this->Number->format($customer->id) ?></td>
                <td><?= h($customer->username) ?></td>
                <td><?= h($customer->firstname) ?></td>
                <td><?= h($customer->lastname) ?></td>
                <td><?= h($customer->email) ?></td>
                <td><?= $this->Number->format($customer->phone) ?></td>
                <td><?= $customer->has('department') ? $this->Html->link($customer->department->name, ['controller' => 'Departments', 'action' => 'view', $customer->department->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $customer->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customer->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id)]) ?>
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
