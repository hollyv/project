<h1>
    Tickets status
    
</h1>

<section>
<?php foreach ($watchedTickets as $watchedTicket): ?>
    <article>
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link($watchedTicket->ticket_id) ?></h4>
       <h4><?= $this->Html->link($watchedTicket->comment) ?></h4>

        <!-- Use the TextHelper to format text -->
  
    </article>
<?php endforeach; ?>
</section>