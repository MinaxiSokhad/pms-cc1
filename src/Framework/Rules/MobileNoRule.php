<?php
declare(strict_types= 1);
namespace Framework\Rules;
use Framework\Contracts\RuleInterface;
class MobileNoRule implements RuleInterface{
    private array $numErr = [];
    public function validate(array $data, string $field, array $params): bool{
        $num = $data[$field];
        // dd($num); 
        if (strlen($num) !== 10) 
        {
           
            $this->numErr[] = "The Number must be 10 Number long .";  
        } 
        if (!preg_match("/^\d{10}$/", $num)) {
            $this->numErr[] = "Your Mobile Number Must Contain Exactly 10 Digits!";
        }
      
        return empty($this->numErr);
    }
    public function getMessage(array $data, string $field, array $params): string{
        return implode(',',$this->numErr);
    }
}