<?php

namespace ImpulseTechnologies\LoanManagement\Components;

use Cms\Classes\ComponentBase;

use ImpulseTechnologies\LoanManagement\Models\LoanProduct;
use Input;
use Validator;
use Log;
use Illuminate\Support\Facades\Redirect;
use Session;

class LoanCalculator extends ComponentBase
{
    public $loanProducts;
    
    public function componentDetails()
    {
        return [
            'name'        => 'LoanCalculator Component',
            'description' => 'Loan Calculator Component'
        ];
    }

    public function onRun()
    {
        $this->loanProducts = $this->loadLoanProducts();
        $this->addJs('assets/js/nouislider.js');
        $this->addCss('assets/css/nouislider.css');
        $this->addJs('assets/js/loancalculator.js');
        
    }

    protected function loadLoanProducts()
    {
        return LoanProduct::all();
    }

    public function onSubmit()
    {

        $validator = Validator::make(
            Input::all(),
            [
                'loan_amount' => 'required',
                'tenure' => 'required',
                'savings_amount' => 'required',
                'loan_product_id' => 'required'
            ]
        );

        if ($validator->fails()) {

    
        } else {
            Session::put('loan_amount', Input::get('loan_amount'));
            Session::put('tenure', Input::get('tenure'));      
            Session::put('loan_product_id', Input::get('loan_product_id'));
            Session::put('savings_amount', Input::get('savings_amount'));
            return Redirect::to('/apply');
        }
    }


}
