<?php namespace ImpulseTechnologies\LoanManagement\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateImpulsetechnologiesLoanmanagementLoanApplications5 extends Migration
{
    public function up()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_applications', function($table)
        {
            $table->double('loan_amount', 10, 2);
            $table->integer('tenure');
        });
    }
    
    public function down()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_applications', function($table)
        {
            $table->dropColumn('loan_amount');
            $table->dropColumn('tenure');
        });
    }
}
