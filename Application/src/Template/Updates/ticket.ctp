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
    <?= $this->Html->link(__('Add to Watched Tickets'), ['controller' => 'WatchedTickets', 'action' => 'add', $id]) ?>
    <?php if ($ticket->status == 'Pending'): 
    echo $this->Html->link(__('Resolve Ticket'), ['controller' => 'Tickets', 'action' => 'resolve', $id]);
    elseif($ticket->status == 'Resolved'):
    echo $this->Html->link(__('Close Ticket'), ['controller' => 'Tickets', 'action' => 'close', $id]);
    elseif($ticket->status == 'Closed'):
    echo $this->Html->link(__('Re Open Ticket'), ['controller' => 'Tickets', 'action' => 'open', $id]);
    endif;

    ?>
    <h3><?= $ticket->title?></h3>
    
    <div id="ticket_view">
    <div id="ticket_title"><h5>Ticket Details</h5></div>
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
            <td><?= $ticket->created->format('d-M-y H:m') ?></tr>
        </tr>
        <tr>
            <th><?= __('Resolution Date') ?></th>
            <td><?= $ticket->resolution_date ?></tr>
        </tr>
        <tr>
            <?= $this->Html->link(__('Edit'), ['controller' => 'Tickets','action' => 'edit', $ticket->id]) ?>
        </tr>            
    </table>
</div>
 
   <div class="related">
        <h4><?= __('  Ticket Updates') ?></h4>
        <div id="update"><?= $this->Html->link(__('+ New Update'), ['controller' => 'Updates', 'action' => 'add', $id]) ?></div>

            <?php foreach ($results as $q): ?>
            <?php if (($q->ticket_id)== $id): ?>

            <?php if (!empty($q->update_text)): ?>
            <div id="update_list">
            <div id="update_info">
           <h5><?php echo $q->user->username
           . " " .
            $q->created->format('d-M-y H:m'); 
             ?></h5><div id="update_actions">
                <?= $this->Html->link(__('Edit'), ['controller' => 'Updates', 'action' => 'edit', $q->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Updates', 'action' => 'delete', $q->id], ['confirm' => __('Are you sure you want to the update # {0}?', $q->id)]) ?>
            </div>
             <p><?= h($q->update_text) ?>
            </p>
        </div>
            
            </div>
            <?php endif; ?>
            <?php endif; ?>
            <?php endforeach; ?>


    </div>
    <?= h($time) ?>
</div>
