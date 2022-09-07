<?php namespace ImpulseTechnologies\LoanManagement\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateImpulsetechnologiesLoanmanagementLoanProducts6 extends Migration
{
    public function up()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_products', function($table)
        {
            $table->double('minimum_savings', 10, 2)->nullable();
            $table->double('maximum_savings', 10, 2)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_products', function($table)
        {
            $table->dropColumn('minimum_savings');
            $table->dropColumn('maximum_savings');
        });
    }
}
