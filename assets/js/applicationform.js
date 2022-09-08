function data() {
    return {
        errors: [],
        amountSlider: null,
        tenureSlider: null,
        amount: null,
        maximumAmount: null,
        minimumAmount: null,
        minimumTenure: null,
        maximumTenure: null,
        loanAmount: null,
        tenure: null,
        interestRate: null,
        loanProductName: null,
        loanProductId: null,
        loanProducts: [],
        showOtherLoanInput: false,
        insurance: null,
        processingFee: null,
        insuranceCharge: null,
        membershipFee: null,
        savingsSlider: null,
        showSavingsSlider: false,
        savingsAmount: null,
        minimumSavings: 100,
        maximumSavings: 5000,
        maximumAmountSavingsMultiplier: 0,
        updateAmountSlider: function () {
            this.amountSlider.noUiSlider.set(this.loanAmount);
        },
        updateTenureSlider: function () {
            this.tenureSlider.noUiSlider.set(this.tenure);
        },
        updateSavingsSlider: function () {
            this.savingsSlider.noUiSlider.set(this.savingsAmount);
        },
        onLoanPurposeChange(e) {
            if (e.target.value === '') {
                this.showOtherLoanInput = true;
            } else {
                this.showOtherLoanInput = false;
            }
        },
        onLoanProductChange(e) {
            loanProductsArray = JSON.parse(JSON.stringify(this.loanProducts));
            let selectedLoanProduct = loanProductsArray.find((loanProduct) => {
                return loanProduct.id == e.target.value;
            });

            this.minimumAmount = parseInt(selectedLoanProduct.minimum_amount);
            this.maximumAmount = parseInt(selectedLoanProduct.maximum_amount);
            this.maximumTenure = parseInt(selectedLoanProduct.maximum_tenure);
            this.minimumTenure = parseInt(selectedLoanProduct.minimum_tenure);
            this.interestRate = parseInt(selectedLoanProduct.interest_rate);
            this.loanProductName = selectedLoanProduct.name;
            this.loanProductId = parseInt(selectedLoanProduct.id);
            this.insuranceCharge = parseInt(selectedLoanProduct.insurance_charge);
            this.processingFee = parseInt(selectedLoanProduct.processing_fee);
            this.membershipFee = parseInt(selectedLoanProduct.membership_fee);
            this.maximumAmountSavingsMultiplier = selectedLoanProduct.maximum_amount_savings_multiplier;
            this.showSavingsSlider = parseInt(selectedLoanProduct.depends_on_savings) === 1 ? true : false;
            if (selectedLoanProduct.minimum_savings !== null && this.showSavingsSlider) {
                this.minimumSavings = parseFloat(selectedLoanProduct.minimum_savings);
            }
            if (selectedLoanProduct.maximumSavings !== null && this.showSavingsSlider) {
                this.maximumSavings = parseFloat(selectedLoanProduct.maximum_savings);
            }

            if (this.showSavingsSlider) {
                maxBasedOnSavings = this.savingsAmount * 3;
                this.maximumAmount = maxBasedOnSavings;
            }

            this.amountSlider.noUiSlider.updateOptions({
                range: {
                    min: this.minimumAmount,
                    max: this.maximumAmount
                },
            });

            this.tenureSlider.noUiSlider.updateOptions({
                range: {
                    min: this.minimumTenure,
                    max: this.maximumTenure
                },
            });

            this.savingsSlider.noUiSlider.updateOptions({
                range: {
                    min: this.minimumSavings,
                    max: this.maximumSavings
                },
            });
        },
        emi() {
            let decimalInterest = this.interestRate / 100;
            let top = Math.pow((1 + decimalInterest), this.tenure);
            let bottom = top - 1;
            let ratio = top / bottom;
            return (Math.round(this.loanAmount * decimalInterest * ratio)).toFixed(2);
        },
        processingFeeAmount() {
            return (this.loanAmount * (this.processingFee / 100)).toFixed(2);
        },
        insuranceAmount() {
            return (this.loanAmount * (this.insuranceCharge / 100)).toFixed(2);
        },
        netLoanAmount() {
            return this.loanAmount - (parseFloat(this.processingFeeAmount()) + parseFloat(this.insuranceAmount()));
        }
    }
}
