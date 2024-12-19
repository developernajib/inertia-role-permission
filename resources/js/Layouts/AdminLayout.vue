<script>
import Sidebar from '@/Components/Admin/Sidebar.vue';
import Header from '@/Components/Admin/Header.vue';

export default {
    components: {
        Sidebar,
        Header,
    },
};
</script>
<template>
    <div class="w-full h-full">
        <Sidebar />
        <div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
            <Header />

            <div class="px-6 pt-6 2xl:container">
                <slot />
            </div>
        </div>
    </div>
</template>
