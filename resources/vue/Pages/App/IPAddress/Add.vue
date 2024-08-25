<script setup>
import { useIpAddressStore } from "../../../../js/store";
const ipAddress = useIpAddressStore();
let form = ipAddress.form;
</script>
<template>
    <q-dialog
        v-model="ipAddress.addModal"
        persistent
        transition-show="scale"
        transition-hide="scale"
    >
        <q-card style="width: 300px">
            <q-card-section class="bg-primary text-white">
                <div class="text-h6">{{ $t("label.add.ip.address") }}</div>
            </q-card-section>
            <q-separator></q-separator>
            <q-card-section>
                <q-input
                    outlined
                    :label="$t('label.ip.address')"
                    type="text"
                    class="q-pa-md"
                    dense
                    v-model="form.ip_address"
                    :readonly="ipAddress.isSubmitting"
                    lazy-rules
                    :rules="[
                        (val) => !!val || 'IP Address field is required',
                        (val) =>
                            !ipAddress.checkIfIP(val) ||
                            'IP Address field is not a valid IP',
                    ]"
                ></q-input>
                <q-input
                    outlined
                    :label="$t('label.label')"
                    type="text"
                    class="q-pa-md"
                    dense
                    v-model="form.label"
                    :readonly="ipAddress.isSubmitting"
                    :rules="[(val) => !!val || 'Label field is required']"
                ></q-input>
            </q-card-section>
            <q-card-actions align="right">
                <q-btn
                    flat
                    :label="$t('label.cancel')"
                    @click="ipAddress.toggleAddModal()"
                ></q-btn>
                <q-btn
                    color="primary"
                    class="q-ml-xs"
                    :label="$t('label.add')"
                    unelevated
                    @click="ipAddress.submit()"
                >
                </q-btn>
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>
