<?php
$tekst = "peegel";
for ($x = strlen($tekst)-1; $x >= 0; $x--) {
    echo "$tekst[$x]";
}
echo "<br>";
$uustekst = "";
for ($i = strlen($tekst)-1; $i >= 0; $i--) {
    $uustekst[strlen($tekst)-1 - ($i)]= $tekst[$i];
}
for ($j = 0; $j <= count($uustekst)-1; $j++){
    echo "$uustekst[$j]";
}
