<?php

/*
    Objective
        You are given a function 'secret()' that accepts a single integer parameter 
        and returns an integer. In your favorite programming language, write 
        a command-line program that takes one command-line argument (a number) 
        and determines if the secret() function is additive [secret(x+y) = secret(x) 
        + secret(y)], for all combinations x and y, where x and y are all prime numbers 
        less than the number passed via the command-line argument.  Describe how to 
        run your examples. Please generate the list of primes without using built-in 
        functionality.
   Uses 
        To run additiveTest.php script from command line, update the code for the **secret() 
        function found in secretFunctiom.php which is located in the same directory . 
        This secret function file will then be included by the testing script.
        Command Line(in test directory)  pathToServerPhp/php additiveTest.php [Someinteger]
 
    **Example secret function
        function secret($int){
            return $int*2;
        }
*/

require_once 'classes/AdditiveTest.class.php';
use com\rentroi\codechallenges\salesforce\classes\AdditiveTest;
//use yo\AddiitveTest;

if (!isset($argv[1]) || !ctype_digit($argv[1])) {
    cli("You must pass an integer argument to this command line script.");
    die();
}

$isAdditive = new AdditiveTest($argv[1]);

if($isAdditive->isAdditive){
    cli("Secret Function is Additive...");
    
}else {
    cli("Secret Function is NOT Additive...");
}

function cli($message) {
    print $message . PHP_EOL;
}

