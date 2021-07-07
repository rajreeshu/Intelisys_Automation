<?php

require __DIR__ . '/vendor/autoload.php';


$inputFileName = "a.xlsx";

/**  Identify the type of $inputFileName  **/
$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);

/**  Create a new Reader of the type that has been identified  **/
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

/**  Load $inputFileName to a Spreadsheet Object  **/
$spreadsheet = $reader->load($inputFileName);

/**  Convert Spreadsheet Object to an Array for ease of use  **/
$schdeules = $spreadsheet->getActiveSheet()->toArray();

// echo "<pre>";
// print_r($schdeules);
// echo "</pre>";


foreach( $schdeules as $single_schedule )
{               
    echo '<div class="row">';
    foreach( $single_schedule as $single_item )
    {
        echo '<p class="item">' . $single_item . '</p>';
    }
    echo '</div>';
}


?>