<script setup>
import Add from "./Add.vue";
import Update from "./Update.vue";
import { useIpAddressStore } from "../../../../js/store";
const ipAddress = useIpAddressStore();
ipAddress.init();
</script>
<template>
    <AppLayout>
        <q-table
            flat
            bordered
            :title="$t('label.ip.addresses')"
            :rows="ipAddress.rows"
            :columns="ipAddress.columns"
            row-key="index"
            style="height: 50vh"
        >
            <template v-slot:top="props">
                <div class="col-2 q-table__title">
                    {{ $t("label.ip.addresses") }}
                </div>
                <q-space />
                <q-btn
                    dense
                    icon="mdi-plus"
                    color="primary"
                    unelevated
                    :label="$t('label.add')"
                    @click="ipAddress.toggleAddModal()"
                ></q-btn>
            </template>
            <template v-slot:header="props">
                <q-tr :props="props">
                    <q-th
                        v-for="col in props.cols"
                        :key="col.name"
                        :props="props"
                    >
                        {{ $t(`label.${col.label}`) }}
                    </q-th>
                </q-tr>
            </template>
            <template v-slot:body="props">
                <q-tr :props="props">
                    <q-td key="ip_address" :props="props">
                        {{ props.row.ip_address }}
                    </q-td>
                    <q-td key="label" :props="props">
                        {{ props.row.label }}
                    </q-td>
                    <q-td key="actions" :props="props" class="text-right">
                        <q-btn
                            dense
                            rounded
                            flat
                            icon="mdi-pencil"
                            @click="ipAddress.show(props.row)"
                        >
                            <q-tooltip>{{ $t("label.edit") }}</q-tooltip>
                        </q-btn>
                        <q-btn
                            dense
                            rounded
                            flat
                            icon="mdi-list-box-outline"
                            @click="ipAddress.showLogs(props.row.id)"
                        >
                            <q-tooltip>{{ $t("label.audit.logs") }}</q-tooltip>
                        </q-btn>
                    </q-td>
                </q-tr>
            </template>
        </q-table>
        <Add />
        <Update />
    </AppLayout>
</template>
