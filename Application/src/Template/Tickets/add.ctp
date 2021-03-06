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
    <?= $this->Form->create($ticket) ?>
    <fieldset>
        <legend><?= __('Add Ticket') ?></legend>
        <?php

            echo $this->Form->input('customer_id', ['options' => $customers, 'empty' => true]);
            //echo 'Status';
            //echo $this->Form->select(
              //  'status',
                //['Open' => 'Open', 'Pending' => 'Pending', 'Resolved' => 'Resolved', 'Closed' => 'Closed']);
            echo $this->Form->hidden('status', ['value' => 'New']);
            echo $this->Form->input('title');
            echo $this->Form->input('priority_id', ['options' => $priorities, 'empty' => false]);
            echo $this->Form->input('description');
            echo 'Category';
            echo $this->Form->select(
                'category',
                ['Computer Set Up' => 'Computer Set Up', 'E-mail' => 'E-mail', 'Hardware' => 'Hardware','Intranet' => 'Intranet', 'Internet' => 'Internet','Network' => 'Network', 'Phones' => 'Phones', 'Printers' => 'Printers', 'Scanners' => 'Scanners','Software' => 'Software', 'Virus' => 'Virus', 'Other' => 'Other']);
            $loguser = $this->request->session()->read('Auth.User.id');
            echo $this->Form->hidden('analyst_id', ['value' => $loguser]);
            echo 'Ticket Type';
             echo $this->Form->select(
                'ticket_type',
                ['Incident' => 'Incident', 'Request' => 'Request', 'Problem' => 'Problem Management']);
            echo 'Email Customer';
             echo $this->Form->select(
                'email_option',
                ['Yes' => 'Yes', 'No' => 'No']);
        ?>

    </fieldset>   
        <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>