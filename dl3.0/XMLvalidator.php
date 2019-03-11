<?php
            function libxml_display_error($error)
            {
                $return = "<br/>\n";
                switch ($error->level) {
                    case LIBXML_ERR_WARNING:
                        $return .= "<b>Warning $error->code</b>: ";
                        break;
                    case LIBXML_ERR_ERROR:
                        $return .= "<b>Error $error->code</b>: ";
                        break;
                    case LIBXML_ERR_FATAL:
                        $return .= "<b>Fatal Error $error->code</b>: ";
                        break;
                }
              $return .= trim($error->message);
                if ($error->file) {
                    $return .=    " in <b>$error->file</b>";
                }
                $return .= " on line <b>$error->line</b>\n";

                return $return;
            }

            function libxml_display_errors() {
                $errors = libxml_get_errors();
                foreach ($errors as $error) {
                    print libxml_display_error($error);
                }
                libxml_clear_errors();
            }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Validation by XML Schema</title>
    </head>
    <body>
<?php
        libxml_use_internal_errors(true);

        $xml = new DOMDocument();
        $xml->load('booksXML2.xml');
        if (!$xml->schemaValidate('booksCanon.xsd')) {
             print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
             libxml_display_errors();
        } else {
            echo "This document is valid!\n";
        }
?>
    </body>
</html>
