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
