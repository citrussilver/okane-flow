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
    maya_accts_cols: [
        'ID',
        'Mobile #',
        'Acct Nickname',
        'Last 4 Digits',
        'Balance'
    ],
    maya_transacts_cols: [
        'ID',
        'Maya ID',
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
    }
}