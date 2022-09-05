<?php namespace ImpulseTechnologies\LoanManagement\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateImpulsetechnologiesLoanmanagementLoanProducts extends Migration
{
    public function up()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_products', function($table)
        {
            $table->double('minimum_amount', 10, 2);
            $table->double('maximum_amount', 10, 2);
            $table->double('minimum_tenure', 10, 2);
            $table->double('maximum_tenure', 10, 2);
        });
    }
    
    public function down()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_products', function($table)
        {
            $table->dropColumn('minimum_amount');
            $table->dropColumn('maximum_amount');
            $table->dropColumn('minimum_tenure');
            $table->dropColumn('maximum_tenure');
        });
    }
}
