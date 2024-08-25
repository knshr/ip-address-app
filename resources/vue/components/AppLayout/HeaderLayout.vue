<script setup>
import { useLoginStore } from "../../../js/store";
import { useAuditLogsStore } from "../../../js/store";
const auth = useLoginStore();
const audit = useAuditLogsStore();
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
                icon="mdi-list-box-outline"
                @click="audit.showLogs"
            >
                <q-tooltip>{{ $t("label.audit.logs") }}</q-tooltip>
            </q-btn>
            <q-btn dense flat round icon="mdi-logout" @click="auth.logout">
                <q-tooltip>{{ $t("label.logout") }}</q-tooltip>
            </q-btn>
        </q-toolbar>
    </q-header>
</template>
