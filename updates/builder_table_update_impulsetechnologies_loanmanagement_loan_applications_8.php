<?php namespace ImpulseTechnologies\LoanManagement\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateImpulsetechnologiesLoanmanagementLoanApplications8 extends Migration
{
    public function up()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_applications', function($table)
        {
            $table->integer('loan_purpose_id')->nullable();
            $table->string('other_loan_purpose', 191)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_applications', function($table)
        {
            $table->dropColumn('loan_purpose_id');
            $table->dropColumn('other_loan_purpose');
        });
    }
}
