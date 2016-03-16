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
<div class="tickets form large-9 medium-8 columns content">
    <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ticket->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ticket->id)]
            )
        ?></li>
        <?= $this->Form->create($ticket) ?>
    <fieldset>
        
        <legend><?= __('Edit Ticket') ?></legend>
        <?php
            echo $this->Form->input('customer_id', ['options' => $customers, 'empty' => true]);
            echo $this->Form->input('title');
            echo $this->Form->input('priority_id', ['options' => $priorities, 'empty' => false]);
            echo $this->Form->input('description');
            echo 'Category';
            echo $this->Form->select(
                'category',
                ['Computer Set Up' => 'Computer Set Up', 'E-mail' => 'E-mail', 'Hardware' => 'Hardware','Intranet' => 'Intranet', 'Internet' => 'Internet','Network' => 'Network', 'Phones' => 'Phones', 'Printers' => 'Printers', 'Scanners' => 'Scanners','Software' => 'Software', 'Virus' => 'Virus', 'Other' => 'Other']);
            echo 'Ticket Type';
             echo $this->Form->select(
                'ticket_type',
                ['Incident' => 'Incident', 'Request' => 'Request', 'Problem' => 'Problem Management']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
