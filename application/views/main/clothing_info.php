<div class="extras">

  <?= anchor('edit/clothing/' . $selected, 'Edit Item', 'class="extras"') ?>
  <?= anchor('delete/clothing/' . $selected, 'Delete Item', 'class="extras"') ?>

</div>

<?php if ( isset($img) ): ?>

  <img class="main" src="<?= base_url() . 'images/' . $img ?>" height="500px"/>

<?php endif ?>
