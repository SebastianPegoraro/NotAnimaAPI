<?php
class Player{
    private $connection;

    private $tableName = 'player';

    public $id;
    public $level;
    public $name;
    public $dexterity;
    public $strength;
    public $agility;
    public $life;
    public $initiative;
    public $action;
    public $attack;
    public $defense;
    public $damage;

    public function __construct($dataBase)
    {
        $this->connection = $dataBase;
    }

    public function getPlayers(){
        $sqlQuery = "SELECT id,level,name,dexterity,strength,agility,life,initiative,action,attack,defense,damage FROM " . $this->tableName . "";
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public function createPlayer(){
        $sqlQuery = "INSERT INTO
                    ". $this->tableName ."
                SET
                    level = :level, 
                    name = :name, 
                    dexterity = :dexterity, 
                    strength = :strength, 
                    agility = :agility, 
                    life = :life, 
                    initiative = :initiative, 
                    action = :action, 
                    attack = :attack, 
                    defense = :defense, 
                    damage = :damage";
    
        $stmt = $this->connection->prepare($sqlQuery);
    
        // sanitize
        $this->level=htmlspecialchars(strip_tags($this->level));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->dexterity=htmlspecialchars(strip_tags($this->dexterity));
        $this->strength=htmlspecialchars(strip_tags($this->strength));
        $this->agility=htmlspecialchars(strip_tags($this->agility));
        $this->life=htmlspecialchars(strip_tags($this->life));
        $this->initiative=htmlspecialchars(strip_tags($this->initiative));
        $this->action=htmlspecialchars(strip_tags($this->action));
        $this->attack=htmlspecialchars(strip_tags($this->attack));
        $this->defense=htmlspecialchars(strip_tags($this->defense));
        $this->damage=htmlspecialchars(strip_tags($this->damage));
    
        // bind data
        $stmt->bindParam(":level", $this->level);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":dexterity", $this->dexterity);
        $stmt->bindParam(":strength", $this->strength);
        $stmt->bindParam(":agility", $this->agility);
        $stmt->bindParam(":life", $this->life);
        $stmt->bindParam(":initiative", $this->initiative);
        $stmt->bindParam(":action", $this->action);
        $stmt->bindParam(":attack", $this->attack);
        $stmt->bindParam(":defense", $this->defense);
        $stmt->bindParam(":damage", $this->damage);
    
        if($stmt->execute()){
           return true;
        }
        return false;
    }

    public function getOnePlayer(){
        $sqlQuery = "SELECT id,level,name,dexterity,strength,agility,life,initiative,action,attack,defense,damage FROM " . $this->tableName . " WHERE id = :id";

        $stmt = $this->connection->prepare($sqlQuery);

        $stmt->bindParam(":id", $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->level = $dataRow['level'];
        $this->name = $dataRow['name'];
        $this->dexterity = $dataRow['dexterity'];
        $this->strength = $dataRow['strength'];
        $this->agility = $dataRow['agility'];
        $this->life = $dataRow['life'];
        $this->initiative = $dataRow['initiative'];
        $this->action = $dataRow['action'];
        $this->attack = $dataRow['attack'];
        $this->defense = $dataRow['defense'];
        $this->damage = $dataRow['damage'];
    }

    public function updateEmployee(){
        $sqlQuery = "UPDATE
                    ". $this->db_table ."
                SET
                    name = :name, 
                    email = :email, 
                    age = :age, 
                    designation = :designation, 
                    created = :created
                WHERE 
                    id = :id";
    
        $stmt = $this->connection->prepare($sqlQuery);
    
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->age=htmlspecialchars(strip_tags($this->age));
        $this->designation=htmlspecialchars(strip_tags($this->designation));
        $this->created=htmlspecialchars(strip_tags($this->created));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":id", $this->id);
    
        if($stmt->execute()){
           return true;
        }
        return false;
    }

    // DELETE
    function deleteEmployee(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->connection->prepare($sqlQuery);
    
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        $stmt->bindParam(1, $this->id);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }

}