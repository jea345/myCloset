<h2>Welcome to your closet</h2>

<?php $options = array( "tops" => "Tops", "bottoms" => "Bottoms", "footwear" => "Footwear", "accessories" => "Accessories", "outerwear" => "Outerwear", "underwear" => "Underwear", "other" => "Other"); ?>

<?= validation_errors('<h3 class="error">', '</h3>') ?>
<?= $error ?>


<?= form_open_multipart(); ?>

  <p>Name </p>
  <?= form_input( 'name', set_value('name') ); ?><br>

  <p>Category </p>
  <?= form_dropdown( 'category', $options, set_value('category') ); ?><br>

  <p>Upload Image </p>
  <?= form_upload( 'image', set_value('image') ) ?><br>



  <?= form_submit('submit', 'Enter'); ?>

<?= form_close() ?>
