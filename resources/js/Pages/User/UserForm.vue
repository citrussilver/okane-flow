<script setup>
import FormInputLabel from '@/Components/FormInputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import AltButton from '@/Components/AltButton.vue';
import ElementsGrouper from '@/Components/ElementsGrouper.vue';
import BlockWideElementsGrouper from '@/Components/BlockWideElementsGrouper.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    form: {
        type: Object,
        required: true
    },
    roles: {
        type: Array,
        required: true
    },
    operation: {
        type: String,
    }
});

// call in template
const emit = defineEmits(['submit'])

</script>

<template>
    <form class="relative bg-white rounded-lg shadow" @submit.prevent="emit('submit')">
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-6">
                    <FormInputLabel for="full_name" value="Full Name" />
                    <TextInput
                        id="full_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.full_name"
                        required
                        autofocus
                        autocomplete="name"
                    />
                </div>
                <ElementsGrouper>
                    <FormInputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </ElementsGrouper>
                <ElementsGrouper>
                    <FormInputLabel for="role_id" value="Role" />
                    <select name="role_id" v-model="form.role_id" id="role_id" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                        <option value="-1" disabled>-- Select a role --</option>
                        <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                    </select>
                </ElementsGrouper>

                <ElementsGrouper v-if="props.operation == 'Save'">
                    <FormInputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password" />
                </ElementsGrouper>

                <ElementsGrouper v-if="props.operation == 'Save'">
                    <FormInputLabel for="password_confirmation" value="Confirm Password"/>
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                </ElementsGrouper>


                <BlockWideElementsGrouper>
                    <AltButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        {{ operation }}
                    </AltButton>
                    <Link :href="route('users.index')" as="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</Link>
                </BlockWideElementsGrouper>

            </div>
        </div>
    </form>
</template>