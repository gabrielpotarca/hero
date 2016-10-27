<?php
abstract class entity{

    private $health, $strength, $defence, $luck, $speed;
    public $name;

    /*
     * Abstract functions
     */

    abstract public function attack($defender);
    abstract public function defend($damage);

    /*
     * Public functions
     */

    public function __construct($name, $health, $strength, $defence, $luck, $speed){

        $this->name=$name;
        $this->health=$health;
        $this->strength=$strength;
        $this->defence=$defence;
        $this->luck=$luck;
        $this->speed=$speed;

        $this->whoAmI();
    }

    public function hit($defender){
        $damage = $this->strength - $defender->defence;
        echo $this->name." attacking with ".$damage." damage.\n";
        $defender->defend($damage);
    }

    public function inflictDamage($damage){
        if($this->rollDice($this->luck)){
            echo $this->name." dodged.\n";
        }
        else {
            $this->health -= $damage;
        }

        if($this->isAlive())
            echo $this->name." has ".$this->health." health remaining.\n";
        else {
            echo $this->name." is dead.\n";
        }
    }

    public function isAlive(){
        return ($this->health>0);
    }

    public function whoAmI(){
        echo 'Health: '.$this->health."\n".
            'Strength: '.$this->strength."\n".
            'Defence: '.$this->defence."\n".
            'Luck: '.$this->luck."\n".
            'Speed: '.$this->speed."\n";
    }

    public function rollDice($probability){
        $value=rand(0,100);
        return $value<=$probability;
    }

    public function getSpeed(){
        return $this->speed;
    }
    public function getLuck(){
        return $this->luck;
    }
}

class hero extends entity {
    public function attack($defender){
        $this->hit($defender);
        if($this->rollDice(rapidStrikeProbability) && $defender->isAlive()) {
            echo $this->name." uses rapid strike!\n";
            $this->hit($defender);
        }

    }
    public function defend($damage){
        if($this->rollDice(magicShieldProbability)){
            $damage/=2;
            echo $this->name." uses magic shield and decreases damage to ".$damage." !\n";
        }
        $this->inflictDamage($damage);
    }
}

class beast extends entity {
    public function attack($defender){
        $this->hit($defender);
    }
    public function defend($damage){
        $this->inflictDamage($damage);
    }
}