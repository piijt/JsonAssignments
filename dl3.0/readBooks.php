<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cars</title>
        <link rel='stylesheet' href='css/mystyles.css'/>
    </head>
    <body>
<?php
        // Read the XML document into a SimpleXMLElement object
        $books = simplexml_load_file("./data/books.xml"
                , "SimpleXMLElement"
                , LIBXML_NOCDATA );
?>
        <h1>All Books</h1>
        <table>
<?php
        foreach ($books->book as $book) {

        }
          printf(   "<tr>"
                  . "<td>%s</td>"
                  . "<td>%s</td>"
                  . "<td>%s</td>"
                  . "<td>%s</td>"
                  . "<td>%s</td>"
                  . "<td>%s</td>",
                  $book['author'], $book['publisher'],$book['pages'],
                  $book['currency'],$book['comments'], null
                );
?>
        </table>
        <p><a href='./index.php'>Return Home</a></p>
    </body>
</html>
