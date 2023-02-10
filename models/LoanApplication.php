<?php namespace ImpulseTechnologies\LoanManagement\Models;

use Model;

/**
 * Model
 */
class LoanApplication extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = true;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'impulsetechnologies_loanmanagement_loan_applications';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    protected $appends = ['monthlyInstallment'];

    public $attachOne = [
        'id_document' => 'System\Models\File',
        'proof_of_residence' => 'System\Models\File',

    ];

    public $belongsTo = [
        'loanProduct' => \ImpulseTechnologies\LoanManagement\Models\LoanProduct::class,
        'loanPurpose' => \ImpulseTechnologies\LoanManagement\Models\LoanPurpose::class
    ];

}
