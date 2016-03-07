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
<div class="priorities index large-9 medium-8 columns content">
    <h3><?= __('Priorities') ?></h3>
    <li><?= $this->Html->link(__('New Priority'), ['action' => 'add']) ?></li>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('resolution_time') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($priorities as $priority): ?>
            <tr>
                <td><?= $this->Number->format($priority->id) ?></td>
                <td><?= h($priority->name) ?></td>
                <td><?= h($priority->resolution_time) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tickets','action' => 'priority', $priority->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $priority->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $priority->id], ['confirm' => __('Are you sure you want to delete # {0}?', $priority->id)]) ?>
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
