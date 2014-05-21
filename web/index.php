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
    
    $snappy = new Pdf('xvfb-run -s \'-screen 0 1100x1024x16\' -a wkhtmltopdf');
    
    $snappy->setOption('lowquality', false);
    $snappy->setOption('disable-javascript', true);
    $snappy->setOption('disable-smart-shrinking', false);
    $snappy->setOption('print-media-type', true);
    check_get_params($snappy);
    if (isset($_GET['margin']))
    {
        $snappy->setOption('margin-bottom', $_GET['margin']);
        $snappy->setOption('margin-top', $_GET['margin']);
        $snappy->setOption('margin-right', $_GET['margin']);
        $snappy->setOption('margin-left', $_GET['margin']);
    }
    
    // Display the resulting pdf in the browser
    // by setting the Content-type header to pdf
    // header('Content-Disposition: attachment; filename="file.pdf"');
    header('Content-Type: application/pdf');
    echo $snappy->getOutput($url);
}
else{
    throw new Exception("$url is not a valid url.");
}

/*
 * @function check if one the wkhtml params is present in the url and set if needed.
 */
function check_get_params($snappy)
{
    foreach($snappy->getOptions() as $option => $value)
    {
        if (isset($_GET[$option]))
        {
            if ($_GET[$option] == 'true' || $_GET[$option] == 'false')
                $optValue = (boolean)$_GET[$option];
            else
                $optValue = $_GET[$option];
            $snappy->setOption($option, $optValue);
        }
    }
}
