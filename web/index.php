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
    header('Content-Type: application/pdf');
    
    // Download file instead of viewing it in the browser
    if (isset($_GET['ddl'])) {
        $filename = (empty($_GET['ddl']))? 'file' : $_GET['ddl'];
        header('Content-Disposition: attachment; filename="'.$filename.'.pdf"');
    }

    // Convert pdf in CMYK colorspace
    // Need GhostScript
    // Need a writeable temporary directory for php process
    if (isset($_GET['cmyk']) && $_GET['cmyk'] === 1) {
        
        $tmpRGBFileName = tempnam(sys_get_temp_dir(), 'pdf-rgb');
        $tmpCMYKFileName = tempnam(sys_get_temp_dir(), 'pdf-cmyk');
        
        // Write snappy RGB output in file
        $tmpRGBFile = fopen($tmpRGBFileName,'wb');
        fwrite($tmpRGBFile,$snappy->getOutput($url));
        fclose($tmpRGBFile);
        
        // Convert to CMYK with GhostScript command
        exec('gs -o '.$tmpCMYKFileName.' -sDEVICE=pdfwrite -sProcessColorModel=DeviceCMYK -sColorConversionStrategy=CMYK -sColorConversionStrategyForImages=CMYK '.$tmpRGBFileName);
        
        //Display output in stream
        $tmpCMYKFile = fopen($tmpCMYKFileName,'rb');
        $cmykOutput = fread($tmpCMYKFile, filesize($tmpCMYKFileName));
        fclose($tmpCMYKFile);
        echo $cmykOutput;

        //Cleanup temporary files
        unlink($tmpRGBFileName);
        unlink($tmpCMYKFileName);
    } else {
        echo $snappy->getOutput($url);
    }
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
