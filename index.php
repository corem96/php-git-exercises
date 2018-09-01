<?php
  require_once('functions.php');
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="siimple.min.css">
  </head>
  <body>
    <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <p>The book you're looking for is: </p>
    <?php
      $booksJson = file_exists('books.json') ? file_get_contents('books.json') : null;
      if($booksJson != null){
        $books = json_decode($booksJson, true);
        
        if (isset($_GET['title'])) {
          echo '<p>Looking for: <b>' . $_GET['title'] . '</b></p>';
          if (bookingBooks($books, $_GET['title'])) {
            echo "Booked!";
            updateBooks($books);
          } else {
            echo "The book is not available";
          }
        } else {
          echo '<p>You are not looking for a book?</p>';
        }
    ?>
    <ul>
      <?php foreach($books as $book) : ?>
        <li>
          <a href="?title=<?php echo $book['title']; ?>">
            <?php echo printableTitle($book); ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
    <?php
      } else {
        echo "File books.json does not exists!";
      }
    ?>
    
    <script src="" async defer></script>
  </body>
</html>

