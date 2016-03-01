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
            $this->Html->link('All Tickets', ['controller' => 'Tickets','action' => 'index',
            ]); ?></li>
            <li>
            <?= 
            $this->Html->link('My Tickets', ['controller' => 'Tickets','action' => 'users',
            $loguser = $this->request->session()->read('Auth.User.id'),
            ]); ?></li>
            <li>
            <?= 
            $this->Html->link('All Unclosed Tickets', ['controller' => 'Tickets','action' => 'status']); ?></li>
            <li>
            <u><?= 
            $this->Html->link('My Watched Tickets', ['controller' => 'Tickets', 'action' => 'watched',
            $loguser = $this->request->session()->read('Auth.User.id'),]); ?></li>
            </u><li>
            <?= 
            $this->Html->link('Overdue Tickets', ['controller' => 'Tickets', 'action' => 'overdue']); ?></li>
        </ul>
    </div>
    </div>

<fieldset>
<h2>
    Search Results for: <?= $entered ?>
</h2>

<section>
<?php foreach ($foundTickets as $ticket): ?>
    <div id="search_results">
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link($ticket ->title,['controller' => 'Updates', 'action' => 'ticket', $ticket->id]) ?></h4>
        <h5><?= $ticket->description ?></h5>
       

        <!-- Use the TextHelper to format text -->
  	</div><p>
<?php endforeach; ?>
<div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div> 
	<br>
    
       <div id="search_contents">
    <form action="/tickets/tickets/search" method="post">
    <div id="search_text"> Search Tickets: </div>
    <div id="searchbar"><input type="text" name="search" value=<?= $entered ?> ></div>
    <div id="search_button"><input type="submit" value="Go"></div>
    
    </form> 

</fieldset>
</section>