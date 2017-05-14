<?php
namespace com\rentroi\codechallenges\salesforce\classes;

class AdditiveTest{
    
    
     public function __construct($intArg){
            $this->intArg=$intArg;
            $this->calculate();
            return $this;
     }
     
     
    private function calculate(){
            $this->loadSecretFile();
            $this->primesArr = $this->makePrimeArr($this->intArg-1);
            $this->isSecretFunctAdditive();
     }
     
     
    private function loadSecretFile(){
            //this is  secret() function
            if(file_exists("secretFunction.php")){
                   require_once("secretFunction.php"); 
            }else {
                   cli("File secretFunction.php not found.");
                   die();
            }
            if(!function_exists("secret")){
                   cli("Function secret() not found...");
                   die();
            }
     }
     
     
    private function makePrimeArr($max){
            foreach (range(1, $max) as $i){
                if($this->is_prime($i)){
                    $retArr[]=$i;
                }
            }
    return $retArr;
    }   
     
    
    private function isSecretFunctAdditive(){
            foreach ($this->primesArr as $firstPrime) {
                foreach ($this->primesArr as $secondPrime) {
                    
                       $result1 = (int)secret($firstPrime + $secondPrime);
                       $result2 = (int)secret($firstPrime) + (int)secret($secondPrime);

                       if($result1 != $result2){
                           $this->isAdditive=FALSE;
                           return;
                       }
                }
            }
            $this->isAdditive=TRUE;
            return;
     }
      
     
    private function is_prime($number) {
            return !preg_match('/^1?$|^(11+?)\1+$/x', str_repeat('1', $number));
    }
}

