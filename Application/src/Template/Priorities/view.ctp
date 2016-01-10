<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Priority'), ['action' => 'edit', $priority->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Priority'), ['action' => 'delete', $priority->id], ['confirm' => __('Are you sure you want to delete # {0}?', $priority->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Priorities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Priority'), ['action' => 'add']) ?> </li>
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
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($priority->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Resolution Time') ?></th>
            <td><?= $this->Number->format($priority->resolution_time) ?></td>
        </tr>
    </table>
</div>
