<script setup>
import { WhenVisible } from '@inertiajs/vue3'
import TableLoading from '@/Components/Admin/TableLoading.vue'
</script>
<template>
    <WhenVisible data="permissions">
        <template #fallback>
            <TableLoading />
        </template>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <slot name="header" />
                </thead>
                <tbody>
                    <slot />
                </tbody>
            </table>
        </div>
    </WhenVisible>
</template>