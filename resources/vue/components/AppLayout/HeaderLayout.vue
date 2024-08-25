<script setup>
import { useLoginStore } from "../../../js/store";
const auth = useLoginStore();
</script>
<template>
    <q-header class="bg-primary text-white">
        <q-toolbar>
            <q-toolbar-title>
                {{ $t("label.ip.address") }}
            </q-toolbar-title>
            <q-btn
                dense
                flat
                round
                icon="mdi-logout"
                @click="auth.logout"
            ></q-btn>
        </q-toolbar>
    </q-header>
</template>
