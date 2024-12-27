<?php
require 'crud.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

$newUser = new DynamicCRUD();
$newUser->create(
    "players", 
    [
        "name" => "John Doe",       
        "Physical" => 80, 
        "rating" => 99,             
        "pacing" => 90,             
        "dribbling" => 85           
    ]
);

$newUser->update(
    "players", 
    [
        "Physical" => 50, 
        "rating" => 50, 
        "pacing" => 50
    ],
    [
        "id" => 1 
    ]
);

?>
</body>
</html>