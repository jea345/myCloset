<h2>Welcome to your closet</h2>

<?= validation_errors('<h3 class="error">', '</h3>') ?>

<?php if( isset($user_err) ): ?>

  <?= '<h3 class="error">' . $user_err . '</h3>' ?>

<?php endif ?>

<?= form_open('create_acc/process', 'id=createacc'); ?>

  <p>First Name </p>
  <?= form_input( 'firstname', set_value('firstname') ); ?><br>

  <p>Last Name </p>
  <?= form_input( 'lastname', set_value('lastname') ); ?><br>

  <p>Email </p>
  <?= form_input( 'email', set_value('email') ); ?><br>

  <p>Username </p>
  <?= form_input( 'username', set_value('username') ); ?><br>

  <p>Password </p>
  <?= form_password( 'password', set_value('password') ); ?><br>

  <?= form_submit('submit', 'Enter'); ?>

<?= form_close() ?>
