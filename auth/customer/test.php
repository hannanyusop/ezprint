<?php

#example code for log2 N
$n = 8;
$y = 1;
$num1 = rand();
$num2 = rand();

echo "<br>=========================<br>";
echo "Let's say N is".$n;
echo "<br>=========================<br>";
for($x = 1; $x<$n; $x*=2){

    echo "Current Loop:$y<br>";
    echo "Current X is ".$x;

    echo "<br> =>Num 1 is $num1 and num 2 is $num2<br>";

    if($num1 < $num2){
        echo "ANS: num 2 is bigger than num 1!";
    }else{
        echo "ANS: num 1 is bigger than num 2!";
    }

    #increament y to get total count
    $y++;

    echo "<br>=========================<br>";

}

?>