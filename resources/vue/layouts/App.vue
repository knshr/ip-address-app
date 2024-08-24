<script setup>
import HeaderLayout from "../components/AppLayout/HeaderLayout.vue";
import FooterLayout from "../components/AppLayout/FooterLayout.vue";
import { useAppStore } from "@/services/AppStore";
let app = useAppStore();
</script>
<script>
export default {
    components: {
        HeaderLayout,
        FooterLayout,
    },
};
</script>
<template lang="">
    <q-layout view="lHh LpR fFf">
        <HeaderLayout />
        <q-page-container>
            <slot />
        </q-page-container>
        <FooterLayout />
    </q-layout>
</template>
