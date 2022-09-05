<?php namespace ImpulseTechnologies\LoanManagement\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateImpulsetechnologiesLoanmanagementLoanApplications6 extends Migration
{
    public function up()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_applications', function($table)
        {
            $table->double('interest_rate', 10, 2);
        });
    }
    
    public function down()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_applications', function($table)
        {
            $table->dropColumn('interest_rate');
        });
    }
}
