<ul>

  <?php if ( isset( $clothing_arr ) ): ?>

    <?php foreach ( $clothing_arr as $category => $itemarr ): ?>

      <h1> <?= $category ?> </h1>

      <?php foreach ( $itemarr as $index => $item ): ?>

        <?php if ( isset($selected) && $item['id'] == $selected ): ?>

          <?= anchor( 'main' , "<li class='selected'>" . $item['name'] . "</li>" )?>

        <?php else: ?>

          <?= anchor( 'main/selected/' . $category . '/' . $index , "<li>" . $item['name'] . "</li>" )?>

        <?php endif ?>

      <?php endforeach?>

    <?php endforeach ?>

  <?php endif ?>

</ul>
