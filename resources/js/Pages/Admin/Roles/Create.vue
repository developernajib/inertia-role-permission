<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/Admin/PrimaryButton.vue";
import InputLabel from "@/Components/Admin/chunks/InputLabel.vue";
import InputError from "@/Components/Admin/chunks/InputError.vue";
import TextInput from "@/Components/Admin/TextInput.vue";
import VueMultiselect from "vue-multiselect";

defineProps({
    permissions: Array,
});

const form = useForm({
    name: "",
    permissions: [],
});
</script>

<template>

    <Head title="Create Role" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between" v-if="$hasPermission('view.role')">
                <Link :href="route('admin.roles.index')"
                    class="px-3 py-2 text-white font-semibold bg-sky-500 hover:bg-sky-700 rounded">Back</Link>
            </div>
            <div class="mt-6 max-w-6xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-semibold text-sky-600">Create new role</h1>
                <form @submit.prevent="form.post(route('admin.roles.store'))">
                    <div class="mt-4">
                        <InputLabel for="name" value="Name" />
                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                            autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="permissions" value="Permissions" />
                        <VueMultiselect v-model="form.permissions" :options="permissions" :multiple="true"
                            :close-on-select="false" placeholder="Pick some" label="name" track-by="id" />
                    </div>
                    <div class="flex items-center mt-4" v-if="$hasPermission('create.role')">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Create
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
<style>
@import '@/assets/css/vueMultiSelect.css';
</style>