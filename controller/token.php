<?php

$fname = "charifa";
$lname = "hniguira";

$arr1 = str_split($fname);
$arr2 = str_split($fname, 2);
$arr3 = str_split($lname, 2);

print_r($arr2);
print_r($arr3);

echo $arr2[0] . $arr3[0];
