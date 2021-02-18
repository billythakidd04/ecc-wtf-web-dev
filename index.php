<!DOCTYPE html>
<html>
    <head>
        <title>Index Page</title>
    </head>
    <body>
        <?php include 'header.php';?>
    </body>
</html>

<?php
$variableName = 'Some string here';
echo 'this works with single quotes<br/>';
echo 'this doesnt work with single quotes: $variableName\n<br/>';
echo "this does work with double quotes: $variableName\n<br/>test";