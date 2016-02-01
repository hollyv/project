<h1>
    Tickets
    <?= $this->Text->toList($users) ?>
</h1>

<section>
<?php foreach ($tickets as $ticket): ?>
    <article>
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link($ticket->title) ?></h4>
<?php endforeach; ?>
	<table cellpadding="0" cellspacing="0">
        <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Title') ?></th>
            </tr>
            <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td><?= h($ticket->id) ?></td>
                <td><?= h($ticket->title) ?></td>


                  	    </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <!-- Use the TextHelper to format text -->
  
    </article>

</section>