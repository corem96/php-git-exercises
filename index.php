<?php
  require_once('init.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $pageTitle ?></title>
    <meta charset="utf-8">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/style.css">
  </head>
  <body>
    <h1><?php echo $pageTitle; ?></h1>
    <div class="box">
      <ul>
      <?php
      foreach ($rows as $row) {
        print("<pre>".print_r($row, true)."</pre>");
      }

      var_dump($result);
      $dbError = $db->errorInfo()[2];
      print("<pre>" . print_r($dbError, true) . "</pre>");
      ?>
      </ul>
    </div>
  </body>
</html>