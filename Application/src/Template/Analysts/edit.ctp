<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $analyst->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $analyst->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Analysts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Updates'), ['controller' => 'Updates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Update'), ['controller' => 'Updates', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="analysts form large-9 medium-8 columns content">
    <?= $this->Form->create($analyst) ?>
    <fieldset>
        <legend><?= __('Edit Analyst') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('password');
            echo $this->Form->input('firstname');
            echo $this->Form->input('lastname');
            echo $this->Form->input('role');
            echo $this->Form->input('supportteam');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
