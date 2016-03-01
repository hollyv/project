<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <div id= "current"><li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets','action' => 'homepage']) ?></li></div>
        <li><?= $this->Html->link(__('Reports'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
        <li><?= $this->Html->link('Tickets', ['controller' => 'Tickets','action' => 'users', $loguser = $this->request->session()->read('Auth.User.id'),]); ?></li>
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
            $this->Html->link('My Tickets', ['controller' => 'Tickets','action' => 'users',
            $loguser = $this->request->session()->read('Auth.User.username'),
            ]); ?></li>

            <li>
            <?= 
            $this->Html->link('All Unclosed Tickets', ['controller' => 'Tickets','action' => 'status']); ?></li>

            <li>
            <?= 
            $this->Html->link('My Watched Tickets', [
            'controller' => 'WatchedTickets',
            'action' => 'search',
            $loguser = $this->request->session()->read('Auth.User.id'),
            ]); ?></lI>

            <li>
            <?= 
            $this->Html->link('Overdue', [
            'controller' => 'WatchedTickets',
            'action' => 'search',
            $loguser = $this->request->session()->read('Auth.User.id'),
            ]); ?></lI>
        </ul>
    </div>
    </div>
<h5>
<section>
    <fieldset>
        <article>
      <h3> All overdue tickets </h3>
      
        
          <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Priority') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Customer') ?></th>
                <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($overdue as $ticket): ?>
    
             <tr>
                <td><?= h($ticket->id) ?></td>
                <td><?= h($ticket->priority_id) ?></td>
                <td><?= h($ticket->title) ?></td>
                <td><?= h($ticket->customer_id) ?></td>
                <td><?= h($ticket->created) ?></td>
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
