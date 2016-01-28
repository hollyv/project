 <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li></li>
        <li></li>

 <fieldset> 
 <h1>Login</h1>
<?= $this->Form->create() ?>
<?= $this->Form->input('username') ?>
<?= $this->Form->input('password') ?>
<?= $this->Form->button('Login') ?>
<?= $this->Form->end() ?>
 </fieldset>
    </ul>
</nav>

<div id="logIn">
	Welcome to Numatic International's <br>
	Helpdesk Portal <br>
	<div id="henry">
	<?php echo $this->Html->image('henry-logo.jpg', array('alt' => 'Numatic Logo', 'border' => '0', 'data-src' => 'holder.js/100%x100', 'draggable' => 'false', 'style' => 'height:50%; width:50%; margin-left: 20px;')); ?>
	
	</div>

</div>
