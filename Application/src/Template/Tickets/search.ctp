 <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
        <li><?= $this->Html->link(__('Reports'), ['controller' => 'Tickets','action' => 'allReports']) ?></li>
        <div id= "current"><li><?= $this->Html->link('Tickets', ['controller' => 'Tickets','action' => 'users', $loguser = $this->request->session()->read('Auth.User.id'),]); ?></li></div>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Analysts'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Priorities'), ['controller' => 'Priorities', 'action' => 'index']) ?></li>
     </ul>
</nav>
<div id="ticketbar">
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
            <?= 
            $this->Html->link('My Watched Tickets', ['controller' => 'Tickets', 'action' => 'watched',
            $loguser = $this->request->session()->read('Auth.User.id'),]); ?></li>
            <li>
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
        <h4><?= $this->Html->link($ticket ->title . ' (id:'. $ticket ->id . ')' ,['controller' => 'Updates', 'action' => 'ticket', $ticket->id]) ?></h4>
        <div id= "des"><h5><?= $ticket->description ?></h5></div>
       <div id= "created"><h5><?= $ticket->created->format('d-M-y H:i') ?></h5></div>

        <!-- Use the TextHelper to format text -->
  	</div>
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