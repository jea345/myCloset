<h2>Welcome to your closet</h2>

<?= validation_errors('<h3 class="error">', '</h3>') ?>

<?php if( isset($user_err) ): ?>

  <?= '<h3 class="error">' . $user_err . '</h3>' ?>

<?php endif ?>

<?= form_open('login/process'); ?>

  <p>Username </p>
  <?= form_input( 'username', set_value('username') ); ?><br>

  <p>Password </p>
  <?= form_password( 'password', set_value('password') ); ?><br>

  <?= form_submit('submit', 'Enter'); ?>

<?= form_close() ?>
