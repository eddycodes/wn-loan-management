<?php

namespace ImpulseTechnologies\LoanManagement\Components;

use Cms\Classes\ComponentBase;

use ImpulseTechnologies\LoanManagement\Models\LoanProduct;
use ImpulseTechnologies\LoanManagement\Models\LoanApplication;
use ImpulseTechnologies\LoanManagement\Models\LoanPurpose;
use Input;
use Validator;
use Log;
use Mail;
use Session;
use ImpulseTechnologies\LoanManagement\Traits\CalculatorUtilities;

class ApplicationForm extends ComponentBase
{
    use CalculatorUtilities;

    public $loanProducts;
    public $loanPurposes;
    public $loanAmount;
    public $tenure;
    public $loanProductId;
    public $savingsAmount;


    public function componentDetails()
    {
        return [
            'name'        => 'ApplicationForm Component',
            'description' => 'Loan Application Form Component'
        ];
    }

    public function onRun()
    {
        $this->loanProducts = $this->loadLoanProducts();
        $this->loanPurposes = $this->loadLoanPurposes();
        $this->loanAmount = Session::get('loan_amount',750);
        $this->tenure = Session::get('tenure',1);
        $this->loanProductId = Session::get('loan_product_id',LoanProduct::pluck('id')->first());
        $this->savingsAmount = Session::get('savings_amount',750);
        $this->addJs('assets/js/nouislider.js');
        $this->addCss('assets/css/nouislider.css');
        $this->addJs('assets/js/applicationform.js');
    }

    protected function loadLoanProducts()
    {
        return LoanProduct::all();
    }

    protected function loadLoanPurposes()
    {
        return LoanPurpose::all();
    }

    public function onSubmit()
    {

        $validator = Validator::make(
            Input::all(),
            [
                'tenure' => 'required',
                'first_name' => 'required',
                'surname' => 'required',
                'nationality' => 'required',
                'id_number' => 'required|size:11',
                'gender' => 'required',
                'date_of_birth' => 'required',
                'profession' => 'required',
                'employment_status' => 'required',
                'employment_period' => 'required',
                'email' => 'required',
                'mobile' => 'required',
                'property_no' => 'required',
                'employment_period' => 'required',
                'street_name' => 'required',
                'residential_area' => 'required',
                'guarantor_name' => 'required',
                'guarantor_customer_no' => 'required',
                'next_of_kin_name' => 'required',
                'next_of_kin_nrc' => 'required',
                'next_of_kin_email' => 'required',
                'next_of_kin_mobile' => 'required',
                'relationship_to_next_of_kin' => 'required',
                'loan_product_id' => 'required',
                'id_document' => 'required|file|mimes:pdf',
                'proof_of_residence' => 'required|file|mimes:pdf'
            ]
        );

        if ($validator->fails()) {


            return ['#result' => $this->renderPartial('applicationForm::messages', [
                'errors' => $validator->messages(),
                'type' => 'danger',
                'title' => 'There were some errors with your submission'
            ])];
        } else {
            $loanProduct = LoanProduct::findOrFail(Input::get('loan_product_id'));
            $loanApplication = new LoanApplication;
            $loanApplication->loan_amount = Input::get('loan_amount');
            $loanApplication->tenure = Input::get('tenure');
            $loanApplication->interest_rate = $loanProduct->interest_rate;
            $loanApplication->first_name = Input::get('first_name');
            $loanApplication->surname = Input::get('surname');
            $loanApplication->nationality = Input::get('nationality');
            $loanApplication->id_number = Input::get('id_number');
            $loanApplication->gender = Input::get('gender');
            $loanApplication->date_of_birth = Input::get('date_of_birth');
            $loanApplication->profession = Input::get('profession');
            $loanApplication->employment_status = Input::get('employment_status');
            $loanApplication->employment_period = Input::get('employment_period');
            $loanApplication->email = Input::get('email');
            $loanApplication->mobile = Input::get('mobile');
            $loanApplication->property_no = Input::get('property_no');
            $loanApplication->street_name = Input::get('street_name');
            $loanApplication->residential_area = Input::get('residential_area');
            $loanApplication->guarantor_name = Input::get('guarantor_name');
            $loanApplication->guarantor_customer_no = Input::get('guarantor_customer_no');
            $loanApplication->next_of_kin_name = Input::get('next_of_kin_name');
            $loanApplication->next_of_kin_nrc = Input::get('next_of_kin_nrc');
            $loanApplication->next_of_kin_email = Input::get('next_of_kin_email');
            $loanApplication->next_of_kin_mobile = Input::get('next_of_kin_mobile');
            $loanApplication->relationship_to_next_of_kin = Input::get('relationship_to_next_of_kin');
            $loanApplication->loan_product_id = Input::get('loan_product_id') == NULL ? NULL : Input::get('loan_product_id');
            $loanApplication->id_document = Input::file('id_document');
            $loanApplication->other_loan_purpose = Input::get('other_loan_purpose');
            $loanApplication->loan_purpose_id = empty(Input::get('loan_purpose_id')) ? NULL : Input::get('loan_purpose_id');
            $loanApplication->proof_of_residence = Input::file('proof_of_residence');
            $loanApplication->save();


            $data = [
                'id' => $loanApplication->id,
                'loan_amount' => $loanApplication->loan_amount,
                'tenure' => $loanApplication->tenure,
                'monthly_installment' => $this->monthlyInstallment($loanApplication->interest_rate,$loanApplication->loan_amount,$loanApplication->tenure),
                'interest_rate' => $loanApplication->interest_rate,
                'first_name' => $loanApplication->first_name,
                'surname' => $loanApplication->surname,
                'nationality' => $loanApplication->nationality,
                'id_number' => $loanApplication->id_number,
                'gender' => $loanApplication->gender,
                'date_of_birth' => $loanApplication->date_of_birth,
                'profession' => $loanApplication->profession,
                'employment_status' => $loanApplication->employment_status,
                'employment_period' => $loanApplication->employment_period,
                'email' => $loanApplication->email,
                'mobile' => $loanApplication->mobile,
                'property_no' => $loanApplication->property_no,
                'street_name' => $loanApplication->street_name,
                'residential_area' => $loanApplication->residential_area,
                'guarantor_name' => $loanApplication->guarantor_name,
                'guarantor_customer_no' => $loanApplication->guarantor_customer_no,
                'next_of_kin_name' => $loanApplication->next_of_kin_name,
                'next_of_kin_nrc' => $loanApplication->next_of_kin_nrc,
                'next_of_kin_email' => $loanApplication->next_of_kin_email,
                'next_of_kin_mobile' => $loanApplication->next_of_kin_mobile,
                'relationship_to_next_of_kin' => $loanApplication->relationship_to_next_of_kin,
                'loan_purpose' => empty($loanApplication->loanPurpose->name) ? '' : $loanApplication->loanPurpose->name,
                'loan_product' => $loanApplication->loanProduct->name,
                'other_loan_purpose' => $loanApplication->other_loan_purpose
            ];

            Mail::send('impulsetechnologies.loanmanagement::mail.new-application', $data, function ($message) use ($loanApplication) {
                $message->to($this->property('notificationEmailAddress'), $this->property('notificationEmailName'))
                ->subject('New Loan Application');
                $message->attach($loanApplication->id_document->getLocalPath(), ['as' => $loanApplication->id_document->getFilename()]);
                $message->attach($loanApplication->proof_of_residence->getLocalPath(), ['as' => $loanApplication->proof_of_residence->getFilename()]);
            });

            Mail::send('impulsetechnologies.loanmanagement::mail.application-notification', $data, function ($message) use ($loanApplication) {
                $message->to($loanApplication->email, $loanApplication->first_name . ' ' . $loanApplication->surname)
                ->subject('Loan Application Received');;
                $message->attach($loanApplication->id_document->getLocalPath(), ['as' => $loanApplication->id_document->getFilename()]);
                $message->attach($loanApplication->proof_of_residence->getLocalPath(), ['as' => $loanApplication->proof_of_residence->getFilename()]);
            });

            return ['#result' => $this->renderPartial('applicationForm::messages', [
                'errors' => [],
                'type' => 'success',
                'title' => 'Loan application submitted!',
                'content' => 'Your loan application has been submitted'
            ])];
        }
    }

    public function defineProperties()
    {
        return [
            'notificationEmailAddress' => [
                'title' => 'Notification Email Address',
                'description' => 'Notification Email Address',
                'type' => 'string',
                'default' => 'info@lendingscape.co.zm',
                'required' => true,
                'validationMessage' => 'Enter Notification Email Address'
            ],
            'notificationEmailName' => [
                'title' => 'Notification Email Name',
                'description' => 'Notification Email Name',
                'type' => 'string',
                'default' => 'LendingScape',
                'required' => true,
                'validationMessage' => 'Enter Notification Email Name'
            ]
        ];
    }
}
