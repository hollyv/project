<h1>
    Tickets status
    
</h1>

<section>
<?php foreach ($tickets as $ticket): ?>
    <article>
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link($ticket->title) ?></h4>


        <!-- Use the TextHelper to format text -->
  
    </article>
<?php endforeach; ?>
</section>