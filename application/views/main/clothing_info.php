<div class="extras">

  <?= anchor('edit', 'Edit Item', 'class="extras"') ?>
  <?= anchor('delete', 'Delete Item', 'class="extras"') ?>

</div>

<?php if ( isset($img) ): ?>

  <img class="main" src="<?= base_url() . 'images/' . $img ?>" height="500px"/>

<?php endif ?>
