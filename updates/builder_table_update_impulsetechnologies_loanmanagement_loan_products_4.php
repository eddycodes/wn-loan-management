<?php namespace ImpulseTechnologies\LoanManagement\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateImpulsetechnologiesLoanmanagementLoanProducts4 extends Migration
{
    public function up()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_products', function($table)
        {
            $table->double('insurance_charge', 10, 2)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('impulsetechnologies_loanmanagement_loan_products', function($table)
        {
            $table->dropColumn('insurance_charge');
        });
    }
}
