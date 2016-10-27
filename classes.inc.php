<?php
abstract class entity{

    private $health, $strength, $defence, $luck;
    public $speed;

    /*
     * Abstract functions
     */

    abstract public function attack($defender);
    abstract public function defend($damage);

    /*
     * Public functions
     */

    public function __construct($health, $strength, $defence, $luck, $speed){

        $this->health=$health;
        $this->strength=$strength;
        $this->defence=$defence;
        $this->luck=$luck;
        $this->speed=$speed;

        $this->whoAmI();
    }

    public function hit($defender){
        $damage = $this->strength - $defender->defence;
        echo "Attacking with ".$damage." damage.\n";
        $defender->defend($damage);
    }

    public function inflictDamage($damage){
        if($this->rollDice($this->luck)){
            echo "Dodged.\n";
        }
        else {
            $this->health -= $damage;
        }

        if($this->isAlive())
            echo $this->health." health remaining.\n";
        else echo "The target is dead.\n";
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
}

class hero extends entity {
    public function attack($defender){
        $this->hit($defender);
        if($this->rollDice(rapidStrikeProbability) && $defender->isAlive()) {
            echo "Rapid strike!\n";
            $this->hit($defender);
        }

    }
    public function defend($damage){
        if($this->rollDice(magicShieldProbability)){
            echo "Magic shield!\n";
            $damage/=2;
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