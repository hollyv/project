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
</nav><div id="ticketbar">
    <div id="ticketbar_links">
        <ul id="ticket_list">
            <li>
            <?= 
            $this->Html->link('My Tickets', [
            'controller' => 'Tickets',
            'action' => 'users',
            $loguser = $this->request->session()->read('Auth.User.username'),
            ]); ?></li>

            <li>
            <?= 
            $this->Html->link('All Unclosed Tickets', [
            'controller' => 'Tickets',
            'action' => 'status',
            ]); ?></li>

            <li>
            <?= 
            $this->Html->link('My Watched Tickets', [
            'controller' => 'WatchedTickets',
            'action' => 'search',
            $loguser = $this->request->session()->read('Auth.User.id'),
            ]); ?></lI>
        </ul>
    </div>
    </div>
<div class="tickets index large-9 medium-8 columns content">

    <h3><?= __('Tickets') ?></h3>
    <li><?= $this->Html->link(__('New Ticket'), ['action' => 'add']) ?></li>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('customer_id') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('priority_id') ?></th>
                <th><?= $this->Paginator->sort('description') ?></th>
                <th><?= $this->Paginator->sort('category') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td><?= $this->Number->format($ticket->id) ?></td>
                <td><?= $ticket->has('customer') ? $this->Html->link($ticket->customer->username, ['controller' => 'Customers', 'action' => 'view', $ticket->customer->id]) : '' ?></td>
                <td><?= h($ticket->status) ?></td>
                <td><?= h($ticket->title) ?></td>
                <td><?= $ticket->has('priority') ? $this->Html->link($ticket->priority->name, ['controller' => 'Priorities', 'action' => 'view', $ticket->priority->id]) : '' ?></td>
                <td><?= h($ticket->description) ?></td>
                <td><?= h($ticket->category) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $ticket->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ticket->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ticket->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ticket->id)]) ?>
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

    <div id="search">
       <div id="search_contents">
    <form action="/tickets/tickets/search" method="post">
    <div id="search_text"> Search Tickets: </div>
    <div id="searchbar"><input type="text" name="search" placeholder="Enter a ticket id / keyword" ></div>
    <div id="search_button"><input type="submit" value="Go"></div>
    </div>
    </form> 
    <br>
</div>

</div>

