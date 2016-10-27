<?php
include "config.inc.php";
include "classes.inc.php";

echo "++ ++ ++ HERO ++ ++ ++\n\n";

echo "Generating Orderus...\n";
$Orderus = new hero(rand(70,100),rand(70,80),rand(45,55),rand(10,30),rand(40,50));

echo "\nGenerating beast...\n";
$Beast = new beast(rand(60,90),rand(60,90),rand(40,60),rand(25,40),rand(40,60));


$heroAttacked=false;

while($Orderus->isAlive() && $Beast->isAlive()){

    if($heroAttacked){
        echo "\nBeast prepares to attack...\n";
        $Beast->attack($Orderus);
        $heroAttacked=false;
    }
    else{
        echo "\nOrderus prepares to attack...\n";
        $Orderus->attack($Beast);
        $heroAttacked=true;
    }

}
?>