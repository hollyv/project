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
    <?= $this->Html->link(__('Assign Ticket'), ['controller' => 'Tickets', 'action' => 'assign', $ticket->id]) ?>
    <h3><?= h($ticket->title) ?></h3>
    
    <div id="ticket_view">
        <h5>  Ticket Details</h5>
    <table class="vertical-table">
        <tr>
            <th><?= __('Customer') ?></th>
            <td><?= $ticket->has('customer') ? $this->Html->link($ticket->customer->username, ['controller' => 'Customers', 'action' => 'view', $ticket->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= h($ticket->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($ticket->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Priority') ?></th>
            <td><?= $ticket->has('priority') ? $this->Html->link($ticket->priority->name, ['controller' => 'Priorities', 'action' => 'view', $ticket->priority->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($ticket->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Category') ?></th>
            <td><?= h($ticket->category) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $ticket->has('user') ? $this->Html->link($ticket->user->username, ['controller' => 'Users', 'action' => 'view', $ticket->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Ticket Type') ?></th>
            <td><?= h($ticket->ticket_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($ticket->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Total Time') ?></th>
            <td><?= $this->Number->format($ticket->total_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($ticket->created) ?></tr>
        </tr>
        <tr>
            <th><?= __('Resolution Date') ?></th>
            <td><?= h($ticket->resolution_date) ?></tr>
        </tr>
    </table>
</div>
    <div class="related">
        <h4><?= __('Ticket Updates') ?></h4>
        <div id="update"><?= $this->Html->link(__('+ New Update'), ['controller' => 'Updates', 'action' => 'add', $ticket->id]) ?></div>
        <?php if (!empty($ticket->updates)): ?>
            <?php foreach ($ticket->updates as $updates): ?>
            <?php if (!empty($updates->update_text)): ?>
            <div id="update_list">
            
            
            <h5><?= h($updates->analyst_id) ?><?= h($updates->created) ?></h5>
            <?= h($updates->update_text) ?>
            
            </p>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
            <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div> 
       
    <?php endif; ?>
    </div>
</div>




