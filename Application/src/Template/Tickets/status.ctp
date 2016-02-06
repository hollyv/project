<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets', 'action' => 'homepage']) ?></li>
        <li><?= $this->Html->link(__('Reports'), ['controller' => 'Tickets', 'action' => 'homepage']) ?></li>
        <li><?= $this->Html->link(__('Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Priorities'), ['controller' => 'Priorities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Priority'), ['controller' => 'Priorities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Updates'), ['controller' => 'Updates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Update'), ['controller' => 'Updates', 'action' => 'add']) ?></li>
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

<section>
    <fieldset>
        <article>
			<h3> All unclosed tickets </h3>
       		
       		<table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Priority') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Customer') ?></th>
                <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td><?= h($ticket->id) ?></td>
                <td><?= h($ticket->priority_id) ?></td>
                <td><?= h($ticket->title) ?></td>
                <td><?= h($ticket->description) ?></td>
                <td><?= h($ticket->customer_id) ?></td>
                 <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $ticket->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ticket->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ticket->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ticket->id)]) ?>
                </td>

                     
            </tr>
            <?php endforeach; ?>
        </table>

        </article>
    </fieldset>
</section>