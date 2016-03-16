 <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
        <div id= "current"><li><?= $this->Html->link(__('Reports'), ['controller' => 'Tickets','action' => 'allReports']) ?></li></div>
        <li><?= $this->Html->link('Tickets', ['controller' => 'Tickets','action' => 'users', $loguser = $this->request->session()->read('Auth.User.id'),]); ?></li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Analysts'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Priorities'), ['controller' => 'Priorities', 'action' => 'index']) ?></li>
     </ul>
</nav>
<div id="all"><?= $this->Html->link(__('All Reports'), ['controller' => 'Tickets', 'action' => 'allReports']) ?></div>
<fieldset> 
    
        <h4><?= __('All Timebookings and Updates (Since: '. date('d-M-y', strtotime('-30 days'))  .') - ' . h($user->username)) ?></h4>

            <table >
            <tr>
            <th>Ticket Refence</th>
            <th>Ticket Title</th>
            <th>Ticket Category</th>
            <th>Ticket Status</th>
            <th>Update Created</th>
            <th>Update Text</th>
            <th>Timebooking</th>
            </tr>

            <?php foreach ($updates as $q): ?>

            <tr>
            <td><?= h($q->ticket->id) ?></td>
            <td><?= h($q->ticket->title) ?></td>
            <td><?= h($q->ticket->category) ?></td>
            <td><?= h($q->ticket->status) ?></td>
            <td><?= h($q->created->format('d-M-y H:m')) ?></td>
            <td><?= h($q->update_text) ?></td>
            <td><?= h($q->time_booking) ?></td>
            </tr>
            </div>


            <?php endforeach; ?>
        </table>

        <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
    <?php if($total->sum > 60): ?>
        <?php  $total->sum = $total->sum / 60 ; ?>
        <h5>Total Time Booked: <?= round(h($total->sum),2) ?> hr </h5>
    <?php else: ?>
        <h5>Total Time Booked: <?= round(h($total->sum),2) ?> mins </h5>
    <?php endif ?>
</div>
</fieldset> 