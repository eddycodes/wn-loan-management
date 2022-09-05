<?php namespace ImpulseTechnologies\LoanManagement\Models;

use Model;

/**
 * Model
 */
class LoanProduct extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'impulsetechnologies_loanmanagement_loan_products';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $hasMany = [
        'loanApplications' => \ImpulseTechnologies\LoanManagement\Models\LoanApplication::class
    ];
}
