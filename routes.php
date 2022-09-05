<?php 
 
use ImpulseTechnologies\LoanManagement\Models\LoanProduct;

Route::get('/api/loan-products', function() {
	return LoanProduct::all();
});