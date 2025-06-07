<?php

if (!defined('CREDIT_CARDS')) {
    define('CREDIT_CARDS', ['Blue Mastercard', 'Platinum', 'Gold']);
}

if (!defined('PH_BANK_ABBREVS')) {
    define('PH_BANK_ABBREVS', ['BPI', 'SB', 'UB']);
}

if (!defined('MAYA_TRANSACTS')) {
    define('MAYA_TRANSACTS', [
        'Cash-In',
        'Online Payment',
        'QR Pay',
        'Self Buy Load',
        'Bills Payment',
        'Adjustment',
        'Refund'
    ]);
}

if (!defined('SAVINGS_ACCT_TRANSACTS')) {
    define('SAVINGS_ACCT_TRANSACTS', [
        'Deposit',
        'Withdraw',
        'Bills Payment',
        'Pay Credit Card',
        'GCash Cash-in',
        'Maya Cash-in',
        'Reload Prepaid Card',
        'Transfer Money',
        'Store payment',
        'Adjustment',
        'Earn Interest',
        'Tax Witheld',
        'Salary / Income',
        'Shopee - Online Banking',
        'Bank Charge',
        'ShopeePay Cash-in'
    ]);
}

if (!defined('SA_TRANSACTS_AS_AR')) {
    define('SA_TRANSACTS_AS_AR', [
        'deposit' => [ 
            'id' => 1,
            'name' => 'Deposit',
        ],
        'withdraw' => [ 
            'id' => 2,
            'name' => 'Withdraw',
        ],
        'bills_payment' => [ 
            'id' => 3,
            'name' => 'Bills Payment',
        ],
        'pay_credit_card' => [
            'id' => 14,
            'name' => 'Pay Credit Card',
        ],
        'gcash_cash_in' => [
            'id' => 4,
            'name' => 'GCash Cash-in',
        ],
        'maya_cash_in' => [ 
            'id' => 11,
            'name' => 'Maya Cash-in',
        ],
        'reload_prepaid_card' => [
            'id' => 5,
            'name' => 'Reload Prepaid Card',
        ],
        'transfer_money' => [ 
            'id' => 6,
            'name' => 'Transfer Money',
        ],
        'store_payment' => [ 
            'id' => 12,
            'name' => 'Store payment',
        ],
        'adjustment_1' => [ 
            'id' => 71,
            'name' => 'Adjustment - Deduct',
        ],
        'adjustment_2' => [ 
            'id' => 72,
            'name' => 'Adjustment - Add',
        ],
        'earn_interest' => [ 
            'id' => 8,
            'name' => 'Earn Interest',
        ],
        'tax_withheld' => [ 
            'id' => 9,
            'name' => 'Tax Witheld',
        ],
        'salary_income' => [ 
            'id' => 10,
            'name' => 'Salary / Income',
        ],
        'shopee_online_banking' => [
            'id' => 13,
            'name' => 'Shopee - Online Banking',
        ],
        'bank_charge' => [
            'id' => 15,
            'name' => 'Bank Charge',
        ],
        'shopee_pay_cash_in' => [
            'id' => 16,
            'name' => 'ShopeePay Cash-in',
        ],
        'globe_one_purchase' => [
            'id' => 17,
            'name' => 'Globe One Buy Promo/Load',
        ],
    ]);
}

if (!defined('SA_TRANSACTS_PLUS')) {
    // 1: deposit, 8: earn interest ,10: salary income
    define('SA_TRANSACTS_PLUS', [1, 8, 10]);
}


if (!defined('CC_TRANSACTS')) {
    define('CC_TRANSACTS', [
        'Online Payment',
        'Non-Online Payment',
        'Credit-to-Cash Loan',
        'Refund',
        'Adjustment'
    ]);
}

if (!defined('SHOPEEPAY_TRANSACTS')) {
    define('SHOPEEPAY_TRANSACTS', [
        'Cash-In',
        'Payment',
        'SPayLater Payment',
        'Refund'
    ]);
}
