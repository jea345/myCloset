<h2>Welcome to your closet</h2>

<?php $options = array( "tops" => "Tops", "bottoms" => "Bottoms", "footwear" => "Footwear", "accessories" => "Accessories", "outerwear" => "Outerwear", "underwear" => "Underwear", "other" => "Other"); ?>

<?= validation_errors('<h3 class="error">', '</h3>') ?>

<?php if ( isset( $upload_error ) ): ?>

  <?= $upload_error ?>

<?php endif ?>


<?= form_open_multipart(); ?>

  <p>Name </p>
  <?= form_input( 'name', $item_name ); ?><br>

  <p>Category </p>
  <?= form_dropdown( 'category', $options, $item_category ); ?><br>

  <?php if ( isset( $item_picture ) && $item_picture === TRUE ): ?>

    <p>New Image </p>
    <?= form_upload( 'image' ) ?>
    <?= anchor('delete/clothing_image/' . $item_id, 'Delete Item') ?><br>

  <?php else: ?>

    <p>Upload Image </p>
    <?= form_upload( 'image' ) ?><br>

  <?php endif ?>



  <?= form_submit('submit', 'Edit'); ?>

<?= form_close() ?>
