<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Updates'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="updates form large-9 medium-8 columns content">
    <?= $this->Form->create($update) ?>
    <fieldset>
        <legend><?= __('Add Update') ?></legend>
        <?php
            echo $this->Form->input('ticket_id', ['options' => $tickets]);
            echo $this->Form->input('update_text');
            $loguser = $this->request->session()->read('Auth.User.id');
            echo $this->Form->hidden('analyst_id', ['value' => $loguser]);
            echo $this->Form->input('time_booking');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
