<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $priority->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $priority->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Priorities'), ['action' => 'index']) ?></li>
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
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
