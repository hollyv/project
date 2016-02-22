<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
        <li><?= $this->Html->link(__('Reports'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
        <div id= "current"><li><?= $this->Html->link(__('Tickets'), ['controller' => 'Tickets','action' => 'index']) ?></li></div>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Analysts'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Priorities'), ['controller' => 'Priorities', 'action' => 'index']) ?></li>
    </ul>
</nav>

<div class="tickets view large-9 medium-8 columns content">
    <?php foreach ($details as $d): ?>
    <?php if (($d->ticket_id)== $id): ?>
  <?= h($d->ticket->description) ?>
  <?= h($d->ticket->description) ?>
  <?php break; ?>
<?php endif; ?>
            <?php endforeach; ?>
   <div class="related">
        <h4><?= __('Ticket Updates') ?></h4>


            <?php foreach ($results as $q): ?>
            <?php if (($q->ticket_id)== $id): ?>
            <div id="update_list">
            
            <?= h($q->update_text) ?>
            <?= h($q->created) ?>
            <?= h($q->user->username) ?>
            </p>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>


    </div>
</div>
