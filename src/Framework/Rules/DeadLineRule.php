<?php

declare(strict_types=1);

namespace Framework\Rules;

use DateTime;
use DateTimeZone;
use DateInterval;
use Framework\Contracts\RuleInterface;

class DeadLineRule implements RuleInterface
{
    public function validate(array $formData, string $field, array $params): bool
    {


        // Ensure the date is in a format that can be parsed by DateTime
        $dateString = $formData[$field];

        if (!$dateString) {
            return true;
        }
        $date = DateTime::createFromFormat('Y-m-d', $dateString);
        $start_date = DateTime::createFromFormat('Y-m-d', $params[1]);




        return $date > $start_date;
    }

    public function getMessage(array $formData, string $field, array $params): string
    {
        return "Invalid date.";
    }
}