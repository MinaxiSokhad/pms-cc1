<?php
declare(strict_types=1);
namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class SelectionRule implements RuleInterface
{
    private array $nameErr = [];
    public function validate(array $data, string $field, array $params): bool
    {

        return !empty($data[$field]);

        // $name = $data[$field];
        // if (!$name && $name == "selection") {
        //     $this->nameErr[] = "Invalid Selection!";
        // }
        // return empty($this->nameErr);
    }
    public function getMessage(array $data, string $field, array $params): string
    {
        return "Please Select Valid Option";
    }
}