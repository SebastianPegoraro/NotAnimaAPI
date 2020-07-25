<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../Class/Player.php';

    $database = new Database();
    $db = $database->getConnection();

    $player = new Player($db);

    $player->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $player->getOnePlayer();

    if($player->name != null){
        // create array
        $playerArray = array(
            "id" => $player->id,
            "level" => $player->level,
            "name" => $player->name,
            "dexterity" => $player->dexterity,
            "strength" => $player->strength,
            "agility" => $player->agility,
            "life" => $player->life,
            "initiative" => $player->initiative,
            "action" => $player->action,
            "attack" => $player->attack,
            "defense" => $player->defense,
            "damage" => $player->damage
        );
      
        http_response_code(200);
        echo json_encode($playerArray);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Player not found.");
    }
?>