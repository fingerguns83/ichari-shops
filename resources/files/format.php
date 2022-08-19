<?php
$input = explode("\n", file_get_contents('./items.txt'));

/*foreach($input as $item){
    $item = str_replace('"', '', $item);
    $item = str_replace("minecraft:", '', $item);
    $item = str_replace(",", "", $item);

    $item = str_replace("_", " ", $item);
    $item = ucwords($item);
    $item = str_replace(" Of ", " of ", $item);
    $item = str_replace (" The ", " the ", $item);
    $output[] = '"' . $item . '",';
}*/

foreach($input as $item){
    $item = str_replace('"', '', $item);
    $item = str_replace("minecraft:", '', $item);
    $item = str_replace(",", "", $item);

    $item = str_replace("_", " ", $item);
    $item = ucwords($item);
    $item = str_replace(" Of ", " of ", $item);
    $item = str_replace (" The ", " the ", $item);
    $output[] = '"' . str_replace(" ", "-", $item) . '" => "' . $item . '",';
}

$output = implode("\n", $output);

file_put_contents('./items_formatted.txt', $output);