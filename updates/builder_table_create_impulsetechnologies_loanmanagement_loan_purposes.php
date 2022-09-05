<?php namespace ImpulseTechnologies\LoanManagement\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateImpulsetechnologiesLoanmanagementLoanPurposes extends Migration
{
    public function up()
    {
        Schema::create('impulsetechnologies_loanmanagement_loan_purposes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('impulsetechnologies_loanmanagement_loan_purposes');
    }
}
