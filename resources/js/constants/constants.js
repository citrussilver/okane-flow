export default {
    APP_NAME: import.meta.env.VITE_APP_NAME,
    USER_TABLE_COLS: [
        { label: 'User Full name', key: 'full_name', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Email', key: 'email', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Role', key: 'role', subKey: 'description', sortable: true, class: 'min-w-[5px] whitespace-nowrap' }
    ],
    ROLES_TABLE_COLS: [
        { label: 'Role Name', key: 'name', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Description', key: 'description', sortable: true, class: 'min-w-[5px] whitespace-nowrap' }
    ],
    SAVINGS_ACCTS_COLS: [
        { label: 'ID', key: 'id', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Bank Name', key: 'bank_name', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Bank Abbrev', key: 'bank_abbrev', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Acct #', key: 'account_number', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Balance', key: 'balance_wc', sortable: true, class: 'min-w-[5px] whitespace-nowrap' }
    ],
    SA_TRANSACTS_COLS: [
        { label: 'ID', key: 'id', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'SA Acct', key: 'savings_acct', subKey: 'bank_name', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Date Time', key: 'date_time_em', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Current Balance', key: 'current_balance_wc', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Amount', key: 'amount', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Post Balance', key: 'post_balance_wc', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Remarks', key: 'remarks', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Location', key: 'location', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Ref #', key: 'reference_number', sortable: true, class: 'whitespace-nowrap' }
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
        adjustment_1: { 
            id: 71,
            name: 'Adjustment - Deduct',
        },
        adjustment_2: { 
            id: 72,
            name: 'Adjustment - Add',
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
        },
        spaylater_payment: {
            id: 18,
            name: 'SPayLater Payment',
        },
    },
    CREDIT_CARDS_COLS: [
        { label: 'ID', key: 'id', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Last 4 Digits', key: 'last_4_digits', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Name', key: 'cc_name', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Credit Limit', key: 'credit_limit', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Avail Limit', key: 'avail_credit_limit', sortable: true, class: 'min-w-[5px] whitespace-nowrap' }
    ],
    CC_TRANSACTS_COLS: [
        { label: 'ID', key: 'id', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Credit Card ID', key: 'credit_card', subKey: 'cc_name', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Date Time', key: 'date_time_em', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Description', key: 'description', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Current Credit Limit', key: 'current_credit_limit_wc', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Amount', key: 'amount_wc', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Post Credit Limit', key: 'post_credit_limit_wc', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Remarks', key: 'remarks', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Ref No.', key: 'ref_no', sortable: true, class: 'whitespace-nowrap' }
    ],
    cc_transacts_table: [
        { field: 'id', header: 'ID' },
        { field: 'credit_card.cc_name', header: 'Credit Card' },
        { field: 'date_time_em', header: 'Date Time' },
        { field: 'description', header: 'Description' },
        { field: 'current_credit_limit_wc', header: 'Current Credit Limit' },
        { field: 'amount', header: 'Amount' },
        { field: 'post_credit_limit_wc', header: 'Post Credit Limit' },
        { field: 'remarks', header: 'Remarks' },
        { field: 'ref_no', header: 'Ref No.' }
    ],
    cc_transacts: {
        online_payment: {
            id: 1,
            name: 'Online Payment'
        },
        non_online_payment: {
            id: 2,
            name: 'Non-Online Payment'
        },
        loan_promo: {
            id: 3,
            name: 'Credit-to-Cash Loan'
        },
        cc_refund: {
            id: 4,
            name: 'Refund'
        },
        adjustment_1: {
            id: 51,
            name: 'Adjustment - Deduct'
        },
        adjustment_2: {
            id: 52,
            name: 'Adjustment - Add'
        }

    },
    MAYA_ACCTS_COLS: [
        { label: 'ID', key: 'id', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Mobile #', key: 'mobile_number', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Acct Nickname', key: 'account_nickname', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Last 4 Digits', key: 'last_4_digits', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Balance', key: 'balance', sortable: true, class: 'min-w-[5px] whitespace-nowrap' }
    ],
    MAYA_TRANSACTS_COLS: [
        { label: 'ID', key: 'id', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Maya Acct', key: 'maya_acct', subKey: 'account_nickname', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        // 'Type',
        { label: 'Current Balance', key: 'current_balance_wc', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Amount', key: 'amount', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Post Balance', key: 'post_balance_wc', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Remarks', key: 'remarks', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Reference ID', key: 'reference_id', sortable: true, class: 'whitespace-nowrap' }
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
        adjustment_1: {
            id: 81,
            name: 'Adjustment - Deduct',
        },
        adjustment_2: {
            id: 82,
            name: 'Adjustment - Add',
        },
        refund: {
            id: 10,
            name: 'Refund',
        },
        voucher_giveaway: {
            id: 6,
            name: 'Voucher Giveaway'
        }
    },
    SHOPEE_PAY_COLS: [
        { label: 'ID', key: 'id', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Username', key: 'shopee_username', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Balance', key: 'balance_wc', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
    ],
    SHOPEE_PAY_TRANSACTS_COLS: [
        { label: 'ID', key: 'id', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'ShopeePay Wallet', key: 'shopee_pay', subKey: 'shopee_username', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Date Time', key: 'date_time_em', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Description', key: 'description', sortable: true, class: 'min-w-[5px] whitespace-nowrap' },
        { label: 'Current Balance', key: 'current_balance_wc', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Amount', key: 'amount', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Post Balance', key: 'post_balance_wc', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Remarks', key: 'remarks', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Location', key: 'location', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Order SN', key: 'order_sn', sortable: true, class: 'whitespace-nowrap' },
        { label: 'Reference ID', key: 'reference_id', sortable: true, class: 'whitespace-nowrap' }
        // 'Type',
    ],
    shopee_pay_transacts: {
        cash_in: {
            id: 1,
            name: 'Cash-In',
        },
        payment: {
            id: 2,
            name: 'Payment',
        },
        spaylater_payment: {
            id: 2,
            name: 'SPayLater Payment',
        },
        refund: {
            id: 4,
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
        ],
        shopee_pays: [
            'shopee-pays.index',
            'shopee-pay-transactions.index'
        ]
    },
    global_data_table_pt_style: {
        column: {
            headerCell: {
                class: 'p-4 text-xs text-jp-indigo uppercase bg-azureish-white border-b'
            },
            bodyCell: {
                class: 'p-4 text-sm text-black-choco dark:bg-white border-b dark:bg-gray-800 dark:text-azureish-white'
            }
        },
        pcPaginator: {
            paginatorContainer: {
                class: 'py-2',
            }
        }
    },
    global_data_table_search: {
        root: {
            class: 'text-black-choco dark:bg-gray-800 border-b dark:text-azureish-white rounded-sm mb-2 lg:mr-2 focus:border-ceil'
        }
    }
}