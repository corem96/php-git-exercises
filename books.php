<?php
  $booksJson = file_get_contents('books.json');
  
  if(file_exists($booksJson)){
    $books = json_decode($booksJson, true);
  } else {
    echo "file books.json does not exists!";
  }
?>