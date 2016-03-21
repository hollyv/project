 <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Home'), ['controller' => 'Tickets','action' => 'homepage']) ?></li>
        <li><?= $this->Html->link(__('Reports'), ['controller' => 'Tickets','action' => 'allReports']) ?></li>
        <li><?= $this->Html->link('Tickets', ['controller' => 'Tickets','action' => 'users', $loguser = $this->request->session()->read('Auth.User.id'),]); ?></li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <div id= "current"><li><?= $this->Html->link(__('Analysts'), ['controller' => 'Users', 'action' => 'index']) ?></li></div>
        <li><?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Priorities'), ['controller' => 'Priorities', 'action' => 'index']) ?></li>
     </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('password');
            echo $this->Form->input('firstname');
            echo $this->Form->input('lastname');
            //echo $this->Form->input('role');
            echo 'Role';
            echo $this->Form->select(
                'role',
                ['Manager' => 'Manager', 'Analyst' => 'Analyst']
                );
            //echo $this->Form->input('supportteam');
            echo 'Support Team';
            echo $this->Form->select(
                'supportteam',
                ['Business Systems' => 'Business Systems', 'DBA' => 'DBA','Functional Support' => 'Functional Support','Infrastructure' => 'Infastructure', 'Network Support' => 'Network Support', 'Projects and Admin' => 'Projects and Admin']
                );
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
