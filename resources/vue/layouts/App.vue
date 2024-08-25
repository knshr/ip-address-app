<script setup>
import HeaderLayout from "../components/AppLayout/HeaderLayout.vue";
import FooterLayout from "../components/AppLayout/FooterLayout.vue";
import Loader from "../components/Loader.vue";
import AuditLogs from "../Pages/App/AuditLogs.vue";
</script>
<template>
    <q-layout view="lHh LpR fFf">
        <HeaderLayout />
        <q-page-container>
            <slot />
        </q-page-container>
        <FooterLayout />
        <Loader />
        <AuditLogs />
    </q-layout>
</template>
