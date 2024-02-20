<?php
// Include the Dompdf library
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

// Create a new Dompdf instance
$dompdf = new Dompdf();

// HTML content for the document (replace this with your own content generation logic)
$html = '
    <html>
    <head>
        <title>Generated Document</title>
    </head>
    <body>
        <h1>Internship Offer</h1>
        <p>This is a dynamically generated document.</p>
    </body>
    </html>
';

// Load HTML content into Dompdf
$dompdf->loadHtml($html);

// Render the document
$dompdf->render();

// Output the generated PDF (you can also save it to a file if needed)
echo $dompdf->output();
?>
