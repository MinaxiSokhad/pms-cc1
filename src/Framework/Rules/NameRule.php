<?php
declare(strict_types=1);
namespace Framework\Rules;
use Framework\Contracts\RuleInterface;
class NameRule implements RuleInterface{
    private array $nameErr = [];
    
    public function validate(array $data, string $field, array $params): bool{
        $name = $data[$field];
      
;        if(!preg_match("/^[A-Z\sa-z]+$/",$name)) 
        {
            $this->nameErr[] = "Must Contain Only Characters!";
        }
      
        if(preg_match("#[0-9]+#",$name)) 
        {
            $this->nameErr[] = " Must Not Contain Number!";
        }
        
        return empty($this->nameErr);
    }
    public function getMessage(array $data, string $field, array $params): string{
        return implode(',',$this->nameErr);
    }
}