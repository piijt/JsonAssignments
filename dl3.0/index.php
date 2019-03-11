<!DOCTYPE html>
<html lang="en" dir="ltr">
      <head>
            <meta charset="utf-8">
            <title>Assignment DI.3.1</title>
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      </head>
      <body>
            <div class="container">
                  <div class="row">
                        <div class="col-lg-12">
                              <hr>
                        </div>
                  </div>
            </div>

            <?php
                  if (isset($_REQUEST['ok'])) {
                        $xml = new DOMDocument("1.0", "UTF-8");
                        $xml->load("books.xml");

                        $rootTag = $xml->getElementsByTagName("booksCanon")->item(0);
                        $dataTag = $xml->createElement("book");
                        $bookAttribute = $xml->createAttribute("id");
                        $bookAttribute->value = "book_id";
                        $dataTag->appendChild($bookAttribute);
                        $authorsTag = $xml->createElement("authors");
                        $authorTag = $xml->createElement("author");
                        $publisherTag = $xml->createElement("publisher");
                        $commentsTag = $xml->createElement("comments");

                        $titleTag = $xml->createElement("title", $_REQUEST['title']);
                        $editionTag = $xml->createElement("edition", $_REQUEST['edition']);
                        $firstnameTag = $xml->createElement("firstname", $_REQUEST['firstname']);
                        $lastnameTag = $xml->createElement("lastname", $_REQUEST['lastname']);
                        $publishernameTag = $xml->createElement("publishername", $_REQUEST['publishername']);
                        $publisheryearTag = $xml->createElement("publisheryear", $_REQUEST['publisheryear']);
                        $publisherplaceTag = $xml->createElement("publisherplace", $_REQUEST['publisherplace']);
                        $pagesTag = $xml->createElement("pages", $_REQUEST['pages']);
                        $priceTag = $xml->createElement("price", ($_REQUEST['currency'] . " " . $_REQUEST['price']));
                        $currencyTag = $xml->createElement("currency", ($_REQUEST['currency']));
                        $commentTag = $xml->createElement("comment", $_REQUEST['comment']);

                        $dataTag->appendChild($titleTag);
                        $dataTag->appendChild($editionTag);

                        $rootTag->appendChild($dataTag);
                        $dataTag->appendChild($authorsTag);
                        $dataTag->appendChild($publisherTag);

                        $authorsTag->appendChild($authorTag);
                        $authorTag->appendChild($firstnameTag);
                        $authorTag->appendChild($lastnameTag);

                        $publisherTag->appendChild($publishernameTag);
                        $publisherTag->appendChild($publisheryearTag);
                        $publisherTag->appendChild($publisherplaceTag);

                        $dataTag->appendChild($pagesTag);
                        $dataTag->appendChild($priceTag);
                        $dataTag->appendChild($currencyTag);

                        $dataTag->appendChild($commentsTag);
                        $commentsTag->appendChild($commentTag);
                        $xml->save("books.xml");
                  }
            ?>

            <div class="container">
                  <div class="row">
                        <div class="col-lg-6">
                              <div class="bg-dark">
                                    <h2 class="text-white p-2">Add books</h2>
                              </div>
                              <form class="" action="index.php" method="post">
                                    <div class="form-group">
                                          <label for="title">title</label>
                                          <input type="text" name="title" value="" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                          <label for="edition">edition</label>
                                          <input type="text" name="edition" value="" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                          <label for="firstname">firstname</label>
                                          <input type="text" name="firstname" value="" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                          <label for="lastname">lastname</label>
                                          <input type="text" name="lastname" value="" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                          <label for="publishername">publishername</label>
                                          <input type="text" name="publishername" value="" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                          <label for="publisheryear">publisheryear</label>
                                          <input type="text" name="publisheryear" value="" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                          <label for="publisherplace">publisherplace</label>
                                          <input type="text" name="publisherplace" value="" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                          <label for="pages">pages</label>
                                          <input type="text" name="pages" value="" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                          <label for="price">price</label>
                                          <input type="text" name="price" value="" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                          <label for="currency">currency</label>
                                          <select name="currency" class="form-control form-control-sm" id="exampleFormControlSelect1" required>
                                                <option value="">None</option>
                                                <option value="&#8364;">EU &#8364;</option>
                                                <option value="&#163;">UK &#163;</option>
                                                <option value="&#36;">USD &#36;</option>
                                          </select>
                                    </div>
                                    <div class="form-group">
                                          <label for="comment">comment</label>
                                          <input type="text" name="comment" value="" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                          <input type="submit" name="ok" value="Tilføj" class="btn btn-primary" required>
                                    </div>
                              </form>
                        </div>
                        <div class="col-lg-4 offset-lg-2">
                              <div class="bg-info text-center">
                                    <a href="view.php" class="text-white">View books</a>
                              </div>
                              <div class="bg-info text-center mt-2">
                                    <a href="books.xml" class="text-white">View XML Tree Structure</a>
                              </div>
                        </div>
                  </div>
            </div>

            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
      </body>
</html>
