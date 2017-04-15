<?php
require_once('head.html');

echo "<h3>Valiku tulemus</h3>";

if (isset($_GET['pilt']) && $_GET['pilt']!=""){
    echo "Sinu lemmik oli pilt nr. ".$_GET["pilt"];
    echo "<p>Tänan hindamast!</p>";}
else echo '<p style="color:#ffb429">Tee oma valik!</p>';

require_once('foot.html');?>
