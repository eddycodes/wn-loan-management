<?php namespace ImpulseTechnologies\LoanManagement\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateImpulsetechnologiesLoanmanagementLoanProducts extends Migration
{
    public function up()
    {
        Schema::create('impulsetechnologies_loanmanagement_loan_products', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('short_name');
            $table->double('interest_rate', 10, 2);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('impulsetechnologies_loanmanagement_loan_products');
    }
}
