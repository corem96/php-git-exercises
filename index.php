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
        $books = [
          ['title' => '1984', 'price' => 8.15],
          ['title' => 'Colors for Kids', 'price' => 1.7],
          ['title' => 'It', 'price' => 65.20] 
        ];
        $percentage = 0.16;
        $addTaxes = function(array $book, $index) use ($percentage) {
          if(isset($book['price'])) {
            $book['price'] += round($percentage * $book['price'], 2);
          }
        };
        $percentage = 100000;
        
        foreach ($books as $index => $book) {
          $addTaxes($book, $index, 0.16);
        }
        var_dump($books);
        

        array_walk($books, $addTaxes);
        var_dump($books);
      ?>
      </ul>
    </div>
  </body>
</html>