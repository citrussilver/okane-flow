<script setup>
import FormInputLabel from '@/Components/FormInputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AltButton from '@/Components/AltButton.vue';
import ElementsGrouper from '@/Components/ElementsGrouper.vue';
import BlockWideElementsGrouper from '@/Components/BlockWideElementsGrouper.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import InputError from '@/Components/InputError.vue';
import { propsParser } from '@/functions/helpers';


const selected_acct_balance = ref('');

const props = defineProps({
    form: {
        type: Object,
        required: true
    },
    shopee_pays: {
        type: Array,
        required: true
    },
    transactsList: {
        type: Array,
        required: true
    },
    operation: {
        type: String,
    }
});

const refDateTime = ref('');

// to properly parse date_time to html datetime-local tag
propsParser(refDateTime, props.form.date_time);

const handleCurrentBalance = () => {
    props.form.shopee_pay = props.shopee_pays.find(shopee_pay => props.form.shopee_pay_id === shopee_pay.id);
            
    props.form.current_balance = props.form.shopee_pay.balance;
    propsParser(selected_acct_balance, props.form.current_balance);
}

const trackSelection = (val, target) => {

    if(target == 'shopee_pay') {
        handleCurrentBalance();
    }

    if(target == 'transact_type') {
        props.form.transact_type = props.transactsList.find(transaxn => props.form.transact_type_id === transaxn.id);
        props.form.remarks = `[${props.form.transact_type.name}] `;
    }
};

// call in template
const emit = defineEmits(['submit']);

onMounted(() => {
    handleCurrentBalance();
});

</script>

<template>
    <form class="relative bg-white rounded-lg shadow-sm dark:bg-gray-800" @submit.prevent="emit('submit')">
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">

                <div class="col-span-6 sm:col-span-6">
                    <FormInputLabel for="shopee_pay_id" value="ShopeePay Wallet" />
                    <select 
                        class="shadow-xs border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        name="role_id" 
                        v-model="form.shopee_pay_id" id="shopee_pay_id" 
                        @change="trackSelection($event.target.selectedIndex, 'shopee_pay')"
                    >
                        <option value="-1" disabled>-- Select ShopeePay Wallet--</option>
                        <option v-for="shopee_pay in shopee_pays" :key="shopee_pay.id" :value="shopee_pay.id">ID: {{ shopee_pay.id }} - {{ shopee_pay.shopee_username }} - ₱{{ shopee_pay.balance }}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.shopee_pay_id" />
                </div>

                <ElementsGrouper>
                    <FormInputLabel for="date_time" value="Date" />
                    <input type="datetime-local" id="date_time" v-model="form.date_time" class="shadow-xs border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">
                    <InputError class="mt-2" :message="form.errors.date_time" />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="transact_type_id" value="Transaction" />
                    <select 
                        id="transact_type_id" 
                        class="shadow-xs border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        name="transact_type_id" 
                        v-model="form.transact_type_id" 
                        @change="trackSelection($event.target.selectedIndex, 'transact_type')"
                    >
                        <option value="-1" disabled>-- Select Transaction--</option>
                        <option v-for="transaction in transactsList" :key="transaction.id" :value="transaction.id">{{ transaction.name }}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.transact_type_id" />
                </ElementsGrouper>

                <div class="col-span-6 sm:col-span-6">
                    <FormInputLabel for="description" value="Description" />
                    <textarea name="description" v-model="form.description" id="description" class="shadow-xs border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600" rows="3"></textarea>
                    <InputError class="mt-2" :message="form.errors.description" />
                </div>

                <ElementsGrouper>
                    <FormInputLabel for="current_balance" value="Current Balance" />
                    <input 
                        id="current_balance" 
                        type="text" 
                        class="shadow-xs border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        v-model="form.current_balance" 
                        disabled
                    />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="amount" value="Amount" />
                    <input
                        id="amount"
                        type="text"
                        class="shadow-xs border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        v-model="form.amount" 
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.amount" />
                </ElementsGrouper>

                <div class="col-span-6 sm:col-span-6">
                    <FormInputLabel for="remarks" value="Remarks" />
                    <textarea name="remarks" v-model="form.remarks" id="description" class="shadow-xs border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600" rows="3"></textarea>
                    <InputError class="mt-2" :message="form.errors.remarks" />
                </div>

                <ElementsGrouper>
                    <FormInputLabel for="order_sn" value="Order SN." />
                    <TextInput
                        id="order_sn"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.order_sn" 
                        required
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.order_sn" />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="ref_id" value="Ref. ID." />
                    <TextInput
                        id="ref_id"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.reference_id" 
                        required
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.reference_id" />
                </ElementsGrouper>


                <BlockWideElementsGrouper>
                    <AltButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        {{ operation }}
                    </AltButton>
                    <Link :href="route('shopee-pay-transactions.index')" as="button" :disabled="form.processing" class="text-gray-900 bg-white border border-gray-300 focus:outline-hidden hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</Link>
                </BlockWideElementsGrouper>
            </div>
        </div>
    </form>
</template>