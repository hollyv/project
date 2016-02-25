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
            <?php $time = 0;?>
            <?php foreach ($results as $q): ?>
            
            <?php if (($q->ticket_id)== $id): ?>
            <?php $time = $time + $q->time_booking; ?>
            <?php endif; ?>
            <?php endforeach; ?>

   <div class="tickets view large-9 medium-8 columns content">
    <?= $this->Html->link(__('Assign Ticket'), ['controller' => 'Tickets', 'action' => 'assign', $id]) ?>
    <h3><?= $ticket->title?></h3>
    
    <div id="ticket_view">
        <h5>  Ticket Details</h5>
    <table class="vertical-table">

        <tr>
            <th><?= __('Customer') ?></th>
            <td><?= $ticket->customer->username?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $ticket->status ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= $ticket->title?></td>
        </tr>
        <tr>
            <th><?= __('Priority') ?></th>
            <td><?= $ticket->priority->name?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= $ticket->description?></td>
        </tr>
        <tr>
            <th><?= __('Category') ?></th>
            <td><?= $ticket->category?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $ticket->user->username?></td>
        </tr>
        <tr>
            <th><?= __('Ticket Type') ?></th>
            <td><?= $ticket->ticket_type?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $ticket->id?></td>
        </tr>
        <tr>
            <th><?= __('Total Time') ?></th>
            <td><?= $time?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $ticket->created?></tr>
        </tr>
        <tr>
            <th><?= __('Resolution Date') ?></th>
            <td><?= $ticket->resolution_date?></tr>
        </tr>
    </table>
</div>
 
   <div class="related">
        <h4><?= __('Ticket Updates') ?></h4>
        <div id="update"><?= $this->Html->link(__('+ New Update'), ['controller' => 'Updates', 'action' => 'add', $id]) ?></div>

            <?php foreach ($results as $q): ?>
            <?php if (($q->ticket_id)== $id): ?>

            <?php if (!empty($q->update_text)): ?>
            <div id="update_list">
            
            <h5><?= h($q->user->username) ?>  <?= h($q->created) ?></h5>
            <p>
            <?= h($q->update_text) ?>
            <?= h($q->time_booking) ?>
            </p>
            </div>
            <?php endif; ?>
            <?php endif; ?>
            <?php endforeach; ?>


    </div>
    <?= h($time) ?>
</div>
