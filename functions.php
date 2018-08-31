<?php
  function PrintableTitle(array $book) : string
  {
    $result = '<i>' .$book['title'] . '</i> - ' . $book['author'];
    if (!$book['available']) {
      $result = '<b>Not Available</b>';
    }

    return $result;
  }
?>