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

<fieldset>
<h2>
    Search Results for: <?= $entered ?>
</h2>

<section>
<?php foreach ($foundTickets as $foundTicket): ?>
    <div id="search_results">
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link($foundTicket ->title,['controller' => 'Tickets', 'action' => 'view', $foundTicket->id]) ?></h4>
        <h5><?= $foundTicket->description ?></h5>
       

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