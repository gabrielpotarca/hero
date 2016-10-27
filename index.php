<?php
include "config.inc.php";
include "classes.inc.php";

echo "++ ++ ++ HERO ++ ++ ++\n\n";

echo "Generating Orderus...\n";
$Orderus = new hero("Orderus",rand(70,100),rand(70,80),rand(45,55),rand(10,30),rand(40,50));

echo "\nGenerating beast...\n";
$Beast = new beast("Beast",rand(60,90),rand(60,90),rand(40,60),rand(25,40),rand(40,60));


$heroAttacked=false; // make the hero attack first

if($Beast->getSpeed()>$Orderus->getSpeed()){
    $heroAttacked=true; // make the beast attack first
}
elseif($Beast->getSpeed()==$Orderus->getSpeed()){
    if($Beast->getLuck()>$Orderus->getLuck()){
        $heroAttacked=true; // make the beast attack first
    }
}

$round=0;
while($Orderus->isAlive() && $Beast->isAlive() && $round<=maxTurns){
    $round++;
    echo "\nRound ".$round."\n";

    if($heroAttacked){
        echo "Beast prepares to attack...\n";
        $Beast->attack($Orderus);
        $heroAttacked=false;
    }
    else{
        echo "Orderus prepares to attack...\n";
        $Orderus->attack($Beast);
        $heroAttacked=true;
    }

}

if($round==maxTurns+1){
    echo "\n DRAW \n";
}
elseif($Beast->isAlive()){
    echo "\n".$Beast->name." has won.\n";
}
else{
    echo "\n".$Orderus->name." has won.\n";
}

?>