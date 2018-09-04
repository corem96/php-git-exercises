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
    <link rel="stylesheet" href="spectre.css">
  </head>
  <body>
    <h1><?php echo $pageTitle; ?></h1>
    <div class="box">
      <ul>
      <?php
        // var_dump(checkIfValid($customer1, [$book1]));
        // $customer2 = new Customer(102, 'jose', 'pablo', 'jose.pablo@mail.com');
        // var_dump(checkIfValid($customer2, [$book1]));
        // $book1->isAvailable(true); //this code runs ok
        // echo $book1;
        
        var_dump($basic->getId());
        var_dump($premium->getId());
        
      ?>
      </ul>
    </div>
  </body>
</html>