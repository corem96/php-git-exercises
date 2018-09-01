<?php
  function PrintableTitle(array $book) : string
  {
    $result = '<i>' .$book['title'] . '</i> - ' . $book['author'];
    if (!$book['available']) {
      $result = '<b>Not Available</b>';
    }

    return $result;
  }

  function bookingBooks(array $books, string $title) : bool 
  {
    foreach ($books as $key => $book) {
      if ($book['title'] == $title) {
        if ($book['available']) {
          $books[$key]['available'] = false;
          return true;
        } else {
          return false;
        }
      }
    }
    return false;
  }

  function updateBooks(array $books)
  {
    if(is_writable('books.json')){
      $booksJson = json_encode($books);
      file_put_contents(__DIR__ . '/books.json', $booksJson);
      echo "<br>file rewritten";
    } else {
      echo "cant write on file. is protected!";
    }
  }
?>