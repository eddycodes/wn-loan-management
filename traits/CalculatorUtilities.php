<?php

namespace ImpulseTechnologies\LoanManagement\Traits;


use App\Model\LoanApplication;

trait CalculatorUtilities {
    public function monthlyInstallment($interest, $amount, $tenure) {
        $interestFloat =  $interest/100;
        $top = pow((1+$interestFloat),$tenure);
        $bottom = $top - 1;
        $ratio = $top/$bottom;
        $monthlyInstallment = round(($amount * $interestFloat * $ratio), 2);
        return $monthlyInstallment;
    }
}
