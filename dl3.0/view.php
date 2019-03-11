<!DOCTYPE html>
<html lang="en" dir="ltr">
      <head>
            <meta charset="utf-8">
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      </head>

      <body>
            <div class="container">
                  <div class="row">
                        <div class="col-lg-12">
                              <hr>
                        </div>
                  </div>

                  <div class="row">
                        <div class="col-lg-6">
                              <div class="bg-info text-center mb-2">
                                    <a href="index.php" class="text-white"><?php echo "< " ?>Add Books</a>
                              </div>
                              <div class="bg-dark">
                                    <h2 class="text-white p-2">Books in store</h2>
                              </div>
                              <div class="bg-light p-2">
                                    <?php
                                          $xml=simplexml_load_file("books.xml") or die("Error: Cannot create object");

                                          foreach ($xml->children() as $key) {
                                                echo "<h3>title: " . $key->title . "</h3>";
                                                echo "edition: " . $key->edition . "<br>";
                                                echo "author: " . $key->authors->author->firstname . " " . $key->authors->author->lastname . "<br>";
                                                echo "publisher: " . $key->publisher->publishername . " " . $key->publisher->publisheryear . " " . $key->publisher->publisherplace . "<br>";
                                                echo "pages: " . $key->pages . "<br>";
                                                echo "price: " . $key->price . "<br>";
                                                echo "comments: " . $key->comments->comment . "<br>";
                                                echo "<hr>";
                                                echo "<br>";
                                          }
                                    ?>
                              </div>
                        </div>
                  </div>
            </div>

            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
      </body>
</html>
