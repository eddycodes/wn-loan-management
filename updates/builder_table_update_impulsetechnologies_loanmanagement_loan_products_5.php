<?php namespace ImpulseTechnologies\LoanManagement\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateImpulsetechnologiesLoanmanagementLoanProducts5 extends Migration
{
    public function up()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_products', function($table)
        {
            $table->boolean('depends_on_savings')->nullable();
            $table->smallInteger('maximum_amount_savings_multiplier')->nullable()->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_products', function($table)
        {
            $table->dropColumn('depends_on_savings');
            $table->dropColumn('maximum_amount_savings_multiplier');
        });
    }
}
