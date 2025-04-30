export default {
    user_table_cols: [
        'User Full name',
        'Email',
        'Role'
    ],
    roles_table_cols: [
        'Role Name',
        'Description'
    ],
    savings_accts_cols: [
        'ID',
        'Bank Name',
        'Bank Abbrev',
        'Acct #',
        'Balance'
    ],
    savings_accts_transacts_cols: [
        'ID',
        'Savings Acct',
        'Date Time',
        // 'Type',
        'Current Balance',
        'Amount',
        'Post Balance',
        'Remarks',
        'Reference #'
    ],
    savings_accts_transacts: {
        deposit: { 
            id: 1,
            name: 'Deposit',
        },
        withdraw: { 
            id: 2,
            name: 'Withdraw',
        },
        bills_payment: { 
            id: 3,
            name: 'Bills Payment',
        },
        pay_credit_card: {
            id: 14,
            name: 'Pay Credit Card',
        },
        gcash_cash_in: {
            id: 4,
            name: 'GCash Cash-in',
        },
        maya_cash_in: { 
            id: 11,
            name: 'Maya Cash-in',
        },
        reload_prepaid_card: {
            id: 5,
            name: 'Reload Prepaid Card',
        },
        transfer_money: { 
            id: 6,
            name: 'Transfer Money',
        },
        store_payment: { 
            id: 12,
            name: 'Store payment',
        },
        adjustment: { 
            id: 7,
            name: 'Adjustment',
        },
        earn_interest: { 
            id: 8,
            name: 'Earn Interest',
        },
        tax_withheld: { 
            id: 9,
            name: 'Tax Witheld',
        },
        salary_income: { 
            id: 10,
            name: 'Salary / Income',
        },
        shopee_online_banking: {
            id: 13,
            name: 'Shopee - Online Banking',
        },
        bank_charge: {
            id: 15,
            name: 'Bank Charge'
        },
        shopee_pay_cash_in: {
            id: 16,
            name: 'ShopeePay Cash-in',
        },
        globe_one_purchase: {
            id: 17,
            name: 'Globe One Buy Promo/Load'
        }
    },
    credit_cards_cols: [
        'ID',
        'Last 4 Digits',
        'Name',
        'Credit Limit',
        'Avail Limit'
    ],
    maya_accts_cols: [
        'ID',
        'Mobile #',
        'Acct Nickname',
        'Last 4 Digits',
        'Balance'
    ],
    maya_transacts_cols: [
        'ID',
        'Maya Acct',
        'Date Time',
        // 'Type',
        'Current Balance',
        'Amount',
        'Post Balance',
        'Remarks',
        'Reference ID'
    ],
    maya_transacts: {
        cash_in: {
            id: 3,
            name: 'Cash-In',
        },
        online_payment: {
            id: 1,
            name: 'Online Payment',
        },
        qr_pay: {
            id: 2,
            name: 'QR Pay',
        },
        self_buy_load: {
            id: 5,
            name: 'Self Buy Load',
        },
        bills_payment: {
            id: 4,
            name: 'Bills Payment',
        },
        adjustment: {
            id: 8,
            name: 'Adjustment',
        },
        refund: {
            id: 10,
            name: 'Refund',
        }
    },
    toasts_detail: {
        delete: {
            header: 'Delete Confirmation',
            message: 'Are you sure?',
            confirm: 'Delete success',
            cancel: 'Cancelled'
        }
    },
    global_page_routes: {
        savings_acct: [
            'savings-accounts.index',
            'sa-transactions.index'
        ],
        maya: [
            'maya-accounts.index',
            'maya-transactions.index'
        ],
        cc: [
            'credit-cards.index'
        ]
    }
}