<?php namespace ImpulseTechnologies\LoanManagement\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateImpulsetechnologiesLoanmanagementLoanApplications extends Migration
{
    public function up()
    {
        Schema::create('impulsetechnologies_loanmanagement_loan_applications', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('first_name');
            $table->string('surname');
            $table->string('nationality');
            $table->string('id_number');
            $table->string('gender');
            $table->date('date_of_bith');
            $table->string('profession');
            $table->string('employment_status');
            $table->integer('employment_period');
            $table->string('email');
            $table->string('mobile');
            $table->string('property_no');
            $table->string('street_name');
            $table->string('residential_area');
            $table->string('id_document');
            $table->string('proof_of_residence');
            $table->string('guarantor_name');
            $table->string('guarantor_customer_no');
            $table->string('next_of_kin_email');
            $table->string('next_of_kin_mobile');
            $table->string('relationship_to_next_of_kin');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('loan_product_id')->nullable()->unsigned();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('impulsetechnologies_loanmanagement_loan_applications');
    }
}
