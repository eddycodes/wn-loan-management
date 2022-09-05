<?php namespace ImpulseTechnologies\LoanManagement\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateImpulsetechnologiesLoanmanagementLoanProducts2 extends Migration
{
    public function up()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_products', function($table)
        {
            $table->integer('loan_purpose_id')->nullable()->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_products', function($table)
        {
            $table->dropColumn('loan_purpose_id');
        });
    }
}
