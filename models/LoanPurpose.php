<?php namespace ImpulseTechnologies\LoanManagement\Models;

use Model;

/**
 * Model
 */
class LoanPurpose extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'impulsetechnologies_loanmanagement_loan_purposes';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $hasMany = [
        'loanApplications' => \ImpulseTechnologies\LoanManagement\Models\LoanApplication::class
    ];
}
