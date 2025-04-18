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
    maya_transacts_cols: [
        'ID',
        'Maya ID',
        'Date Time',
        'Type',
        'Current Balance',
        'Amount',
        'Post Balance',
        'Remarks',
        'Reference ID'
    ],
    maya_transacts: [
        {
            id: 3,
            name: 'Cash-In',
        },
        {
            id: 1,
            name: 'Online Payment',
            route: 'maya/save-ol-shop-pay'
        },
        {
            id: 2,
            name: 'QR Pay',
            route: 'maya/save-qr-pay'
        },
        {
            id: 5,
            name: 'Self Buy Load',
            route: 'maya/save-maya-self-load'
        },
        {
            id: 4,
            name: 'Bills Payment',
            route: 'maya/save-bills-pay'
        },
        {
            id: 8,
            name: 'Adjustment',
            route: 'maya/save-adjustment'
        },
        {
            id: 10,
            name: 'Refund',
            route: 'maya/save-refund'
        }
    ],
}