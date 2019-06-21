<?php

$boohoo = array("a", "e", "i", "o", "u");
$free = "tunde";
$nig = 0;
$yourString = str_replace($boohoo, "edy", $free);
$ray = str_split($free);
$flip = array_flip($ray);
foreach($flip as $rit){
    $nig+= (int)$rit;
}
$lip = (int)45678;
$fredy = $lip * $nig;
echo $yourString.$fredy;
?>