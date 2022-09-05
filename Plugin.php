<?php namespace ImpulseTechnologies\LoanManagement;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'ImpulseTechnologies\LoanManagement\Components\ApplicationForm' => 'applicationForm',
            'ImpulseTechnologies\LoanManagement\Components\LoanCalculator' => 'loanCalculator',
            
		];
    }

    public function registerSettings()
    {
    }
}
