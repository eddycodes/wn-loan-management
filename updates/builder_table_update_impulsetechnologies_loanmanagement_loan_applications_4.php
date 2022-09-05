<?php namespace ImpulseTechnologies\LoanManagement\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateImpulsetechnologiesLoanmanagementLoanApplications4 extends Migration
{
    public function up()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_applications', function($table)
        {
            $table->dropColumn('id_document');
            $table->dropColumn('proof_of_residence');
        });
    }
    
    public function down()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_applications', function($table)
        {
            $table->string('id_document', 191);
            $table->string('proof_of_residence', 191);
        });
    }
}
