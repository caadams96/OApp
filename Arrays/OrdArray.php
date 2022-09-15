<?php

namespace Oapp\Arrays;

class OrdArray
{
        public array $array = array();
        public int $elements;
        function __construct(int $max)
        {
            $this->array = array_pad($this->array,$max,0);
            $this->elements = 0;
        }
        function size():int
        {
            return sizeof($this->array);
        }
        function find(int $key)
        {
          $lowBound = 0;
          $upBound = $this->elements-1;
          //$currentIndex = 0;
          while(true)
          {
              $currentIndex = ($lowBound + $upBound) / 2 ;
              if($this->array[$currentIndex]===$key) {
                  return $currentIndex;
              }
              elseif  ($lowBound>$upBound){
                    return $this->elements;
              }
              else{
                  if($this->array[$currentIndex]<$key){
                      $lowBound=$currentIndex+1;
                      return $lowBound;
                  }else{
                      $upBound = $currentIndex-1;
                      return $upBound;
                  }
              }
          }

        }
        function insert(int $value):void
        {
            $s = $this->size()+1;
            $this->array[$s] = $value;
            sort($this->array);
            $this->elements++;

        }
}