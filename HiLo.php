<?php
namespace OApp;
use Exception;
class HiLo
{
    private int $num;
    private int $strokes;
    private int $comStrokes =0;
    private int $comLower =0;
    private int $comUpper= 0;
    private int $max= 1023;
    private int $m= 0;
    private array $comGuesses=array();

    function __construct()
    {
        $this->num = random_int(0, 10);
    }
    function guess($guess)
    {
        try {
            $num = $this->num;
            if($num == $guess ){
                return "Correct";
            }
            if($guess>$num){
                $this->strokes++;
                return "Hi";
            }
            if($guess<$num){
                $this->strokes++;
                return "lo";

            }
        } catch (Exception $e) {
            return $e;
        }
    }
    function find()
    {
        $this->comUpper = $this->max/2;
        $upper = 0;
        $lower = 0;
        while (true){
            echo("DATA");
            echo("\n");
            echo("Lower Bound:".$this->comLower);
            echo("\n");
            echo("Upper Bound:". $this->comUpper);
            echo("\n");
            echo("Hi or Lo");
            echo("\n");
            echo("Computer Guess:". $this->comUpper);
            echo("\n");
            echo("---------------------------------------------");
            echo("\n");

            $r = readline('');
            if($r == "Hi"||$r == "hi"){
                //SET GLOBAL UPPER&LOWER
                $upper = $this->comUpper;
                $lower = $this->comLower;
                $this->comGuesses[] = $upper;
//                    for($i=0;$i<sizeof($this->comGuesses);++$i){
//                        if($this->comUpper>$this->comGuesses[$i]){
//                            $this->comUpper = $this->comGuesses[$i];
//                        }
//                    }
                //SET COMPUTERS UPPER
                $this->comUpper =  intval(($upper+$lower)/2);
                $this->comStrokes++;

            }
            if($r == "Lo"||$r == "lo"){
                //SET GLOBAL UPPER&LOWER
                $upper = $this->comUpper *2;
                $lower = $this->comUpper;
                //First Guess?
                if($this->comStrokes<=0){
                    //assign m to default max
                    $this->m = $this->max;

                } else $this->m = $upper; //else assign m to upper

                //SET COMPUTERS UPPER&LOWER
                $this->comUpper = intval(($this->m+$lower)/2);
                //Memory
                $this->comGuesses[] = $upper;
                //Loop for the number of guesses
                for($i=0;$i<sizeof($this->comGuesses);++$i){
                    //Is the current guess greater than current indexed value
                    if($this->comUpper>=$this->comGuesses[$i]){
                        //replace object upper with value in memory
                        $this->comUpper = $this->comGuesses[$i];
                    }
                }
                //little hack
                if($this->comStrokes>0 && $this->max>100){
                    $this->m = $this->comUpper;
                }
                //Set LOWER
                $this->comLower = $lower;
                //increment
                $this->comStrokes++;
            }
            if($r=="correct"){
                echo("Computer Guesses:". $this->comStrokes);
                echo("\n");
                echo("---------------------------------------------");
                echo("\n");
                break;
            }
        }
        return $this->comUpper;
    }
}