<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../Class/Player.php';

    $database = new Database();
    $db = $database->getConnection();

    $players = new Player($db);

    $stmt = $players->getPlayers();
    $playersCount = $stmt->rowCount();


    echo json_encode($playersCount);

    if($playersCount > 0){
        
        $playersArr = array();
        $playersArr["body"] = array();
        $playersArr["itemCount"] = $playersCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "level" => $level,
                "name" => $name,
                "dexterity" => $dexterity,
                "strength" => $strength,
                "agility" => $agility,
                "life" => $life,
                "initiative" => $initiative,
                "action" => $action,
                "attack" => $attack,
                "defense" => $defense,
                "damage" => $damage
            );

            array_push($playersArr["body"], $e);
        }
        echo json_encode($playersArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>