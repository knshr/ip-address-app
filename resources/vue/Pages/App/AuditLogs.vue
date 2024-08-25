<script setup>
import { useAuditLogsStore } from "../../../js/store";
import moment from "moment";
const auditLog = useAuditLogsStore();
</script>
<template>
    <q-dialog
        v-model="auditLog.modal"
        transition-show="scale"
        transition-hide="scale"
    >
        <q-card>
            <q-card-section>
                <q-table
                    flat
                    bordered
                    :title="$t('label.audit.logs')"
                    :rows="auditLog.rows"
                    :columns="auditLog.columns"
                    row-key="index"
                    style="height: 50vh"
                >
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
                            <q-td key="date" :props="props">
                                {{
                                    moment(props.row.created_at).format(
                                        "MM/DD/YYYY h:m:s A"
                                    )
                                }}
                            </q-td>
                            <q-td key="event" :props="props">
                                {{ props.row.event }}
                            </q-td>
                            <q-td key="old_values" :props="props">
                                <pre>
                                    {{ props.row.old_values }}
                                </pre>
                            </q-td>
                            <q-td key="new_values" :props="props">
                                <pre>
                                    {{ props.row.new_values }}
                                </pre>
                            </q-td>
                            <q-td key="audited" :props="props">
                                {{ props.row.audited }}
                            </q-td>
                        </q-tr>
                    </template>
                </q-table>
            </q-card-section>
        </q-card>
    </q-dialog>
</template>
