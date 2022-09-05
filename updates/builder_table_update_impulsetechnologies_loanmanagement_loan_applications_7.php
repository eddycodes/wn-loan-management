<?php namespace ImpulseTechnologies\LoanManagement\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateImpulsetechnologiesLoanmanagementLoanApplications7 extends Migration
{
    public function up()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_applications', function($table)
        {
            $table->double('monthly_installment', 10, 2);
        });
    }
    
    public function down()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_applications', function($table)
        {
            $table->dropColumn('monthly_installment');
        });
    }
}
