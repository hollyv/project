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
<div class="priorities form large-9 medium-8 columns content">
    <?= $this->Form->create($priority) ?>
    <fieldset>
        <legend><?= __('Edit Priority') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('resolution_time');
        ?>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $priority->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $priority->id)]
            )
        ?></li>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
