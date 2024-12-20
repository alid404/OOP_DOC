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

$players = $newUser->read(
    "players", 
    [
        "rating" => 50,   
        "pacing" => 50    
    ]
);

foreach ($players as $player) {
    echo "Player Name: " . $player['name'] . "<br>";
    echo "Physical: " . $player['Physical'] . "<br>";
    echo "Rating: " . $player['rating'] . "<br>";
    echo "Pacing: " . $player['pacing'] . "<br>";
    echo "Dribbling: " . $player['dribbling'] . "<br>";
    echo "<hr>";
}


################# different TESTS for READ ###############"// Get all players
$allPlayers = $newUser->read("players");
print_r($allPlayers);

// Get any player based on their ID
$player = $newUser->read(
    "players", 
    [
        "id" => 1 
    ]
);
print_r($player);

// Get the players with a specific rating
$highRatedPlayers = $newUser->read(
    "players", 
    [
        "rating" => 99 
    ]
);
print_r($highRatedPlayers);

?>
</body>
</html>