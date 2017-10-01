<!DOCTYPE html>

<html>

  <head>
    <?php if(isset($css_includes)): ?>


      <?php foreach($css_includes as $file): ?>

        <link rel="stylesheet" type="text/css" href=" <?= base_url() . 'css/' . $file . '.css' ?> ">

      <?php endforeach ?>

    <?php endif ?>

    <title><?= $title ?></title>

    <meta charset="utf-8" />

  </head>

  <body>
