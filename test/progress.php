<?php

    include '../console.php';

    for ($i=200; $i <=300 ; $i++)
    {
        echo \console\progress ('1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',200,$i,300)."\n";
    }

/*    echo \console\progress ('1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',0,0,100)."\n";
    echo \console\progress ('1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',0,10,100)."\n";
    echo \console\progress ('1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',0,50,100)."\n";
    echo \console\progress ('1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',0,90,100)."\n";
    echo \console\progress ('1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',0,100,100)."\n";
*/
