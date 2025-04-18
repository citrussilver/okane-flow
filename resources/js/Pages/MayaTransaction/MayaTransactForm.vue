<script setup>
import FormInputLabel from '@/Components/FormInputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AltButton from '@/Components/AltButton.vue';
import ElementsGrouper from '@/Components/ElementsGrouper.vue';
import BlockWideElementsGrouper from '@/Components/BlockWideElementsGrouper.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import consts from '@/constants/constants.js';


const selected_acct_balance = ref('');

const props = defineProps({
    form: {
        type: Object,
        required: true
    },
    maya_accounts: {
        type: Array,
        required: true
    },
    operation: {
        type: String,
    }
});

const trackSelection = (val, target) => {
    console.log(val, target);

    if(target == 'maya_account') {
        // get the balance with comma
        selected_acct_balance.value = props.maya_accounts[val-1].balance_wc;
        // update the form's current balance
        props.form.current_maya_balance = props.maya_accounts[val-1].balance;
        console.log(`props.form.current_maya_balance: ${props.form.current_maya_balance}`);
    }

    if(target == 'transact_type') {
        console.log(consts.maya_transacts[val-1]);
        props.form.remarks = `[${consts.maya_transacts[val-1].name}]`;
    }
};

// call in template
const emit = defineEmits(['submit'])
</script>

<template>
    <form class="relative bg-white rounded-lg shadow dark:bg-gray-800" @submit.prevent="emit('submit')">
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">

                <div class="cols-pan-6 sm:col-span-6">
                    <FormInputLabel for="maya_id" value="Maya Acct" />
                    <select 
                        class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-800 dark:text-gray-100"
                        name="role_id" 
                        v-model="form.maya_id" id="maya_id" 
                        @change="trackSelection($event.target.selectedIndex, 'maya_account')"
                    >
                        <option value="-1" disabled>-- Select Maya Account--</option>
                        <option v-for="maya_account in maya_accounts" :key="maya_account.id" :value="maya_account.id">ID: {{ maya_account.id }} - {{ maya_account.mobile_number }} - {{ maya_account.account_nickname }}</option>
                    </select>
                </div>

                <ElementsGrouper>
                    <FormInputLabel for="date_time" value="Date" />
                    <input type="datetime-local" id="date_time" v-model="form.date_time" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-800 dark:text-gray-100">
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="maya_id" value="Transaction" />
                    <select 
                        id="transact_type_id" 
                        class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-800 dark:text-gray-100"
                        name="transact_type_id" 
                        v-model="form.transact_type_id" 
                        @change="trackSelection($event.target.selectedIndex, 'transact_type')"
                    >
                        <option value="-1" disabled>-- Select Transaction--</option>
                        <option v-for="transaction in consts.maya_transacts" :key="transaction.id" :value="transaction.id">{{ transaction.name }}</option>
                    </select>
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="current_balance" value="Current Balance" />
                    <input 
                        id="current_balance" 
                        type="text" 
                        class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-800 dark:text-gray-100"
                        v-model="selected_acct_balance" 
                        disabled
                    />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="amount" value="Amount" />
                    <TextInput
                        id="amount"
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.amount" 
                        min="1" 
                        required
                        autofocus
                        autocomplete="number"
                    />
                </ElementsGrouper>

                <div class="col-span-6 sm:col-span-6">
                    <FormInputLabel for="remarks" value="Remarks" />
                    <textarea name="remarks" v-model="form.remarks" id="description" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-800 dark:text-gray-100" rows="3"></textarea>
                </div>

                <div class="col-span-6 sm:col-span-6">
                    <FormInputLabel for="ref_id" value="Ref. ID." />
                    <TextInput
                        id="ref_id"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.reference_id" 
                        required
                        autofocus
                    />
                </div>


                <BlockWideElementsGrouper>
                    <AltButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        {{ operation }}
                    </AltButton>
                    <Link :href="route('maya-transactions.index')" as="button" :disabled="form.processing" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</Link>
                </BlockWideElementsGrouper>
            </div>
        </div>
    </form>
</template>