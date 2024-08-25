<template>
    <q-layout view="lHh LpR fFf">
        <q-page-container>
            <slot />
        </q-page-container>
        <FooterLayout />
    </q-layout>
</template>
<script>
import FooterLayout from "../components/AuthLayout/FooterLayout.vue";
export default {
    components: {
        FooterLayout,
    },
};
</script>
<style lang="sass">
.pointer
    cursor: pointer
</style>
