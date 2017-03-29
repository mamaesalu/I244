<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Koerad</title>
    <style type="text/css">
        h1 {
            color: teal;
            text-align: center;
        }
        div {
            border: solid 2px green;
            border-radius: 5px;
            display: inline-block;
            padding: 5px;
            width: 29%;
            margin:1%;
        }
        p {
            text-align: center;
        }
        div:hover {
            transform: scale(1.05);
        }

    </style>
</head>
<body>
<?php
$koerad= array(
    array('nimi'=>'Po', 'vanus'=>1, 'omanik'=>'Veiko', 'tõug'=>'kuldne retriiver'),
    array('nimi'=>'Reks', 'vanus'=>3, 'omanik'=>'Maie', 'tõug'=>'sakslane'),
    array('nimi'=>'Leedi', 'vanus'=>2, 'omanik'=>'Elle', 'tõug'=>'laika'),
    array('nimi'=>'Suusi', 'vanus'=>5, 'omanik'=>'Tarmo', 'tõug'=>'siberi husky')
);
echo "<h1>Koerapere</h1>";
foreach ($koerad as $koer) {
    include 'koerad.html';
}
?>
</body>
</html>
