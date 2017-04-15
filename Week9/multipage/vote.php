<?php
require_once('head.html');

$pildid = array(
    array("link"=>"pildid/nameless1.jpg", "alt"=>"nimetu 1"),
    array("link"=>"pildid/nameless2.jpg", "alt"=>"nimetu 2"),
    array("link"=>"pildid/nameless3.jpg", "alt"=>"nimetu 3"),
    array("link"=>"pildid/nameless4.jpg", "alt"=>"nimetu 4"),
    array("link"=>"pildid/nameless5.jpg", "alt"=>"nimetu 5"),
    array("link"=>"pildid/nameless6.jpg", "alt"=>"nimetu 6")
);

echo '<h3>Vali oma lemmik :)</h3>'."\n";
echo '<form action="tulemus.php" method="GET">';
$counter = 1;
foreach ($pildid as $pilt):
    echo '<p>';
    echo '<label for="p'.$counter.'">';
    echo '<img src="'.$pilt['link'].'" alt="'.$pilt['alt'].'" height="100" />';
    echo "</label>";
    echo '<input type="radio" value="'.$counter.'" id="p'.$counter.'" name="pilt"/>';
    echo "</p> \n";
    $counter++;
endforeach;

echo '<br/>';
echo '<input type="submit" value="Valin!"/>';
echo "</form>";
require_once('foot.html');
?>