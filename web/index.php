<?php

require_once realpath(dirname(__FILE__) . '/../vendor/autoload.php');

use Knp\Snappy\Pdf;

$parsed_url = parse_url($_GET['url']);
$url = $_GET['url'];

if ($parsed_url != false){
    // add http if needed
    if (!isset($parsed_url['scheme'])){
        $url = 'http://' . $_GET['url'];
    }
    // Display the resulting pdf in the browser
    // by setting the Content-type header to pdf
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="file.pdf"');
    
    $snappy = new Pdf('xvfb-run -a wkhtmltopdf');
    $snappy->setOption('disable-javascript', true);
    echo $snappy->getOutput($url);
}
else{
    throw new Exception("$url is not a valid url.");
}