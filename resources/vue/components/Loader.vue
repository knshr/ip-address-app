<script setup>
import { useAppStore } from "../../js/store";
const app = useAppStore();
</script>
<template>
    <q-dialog
        v-model="app.loading"
        persistent
        transition-show="scale"
        transition-hide="scale"
    >
        <q-card class="bg-transparent" flat style="width: 300px">
            <q-card-section>
                <div class="text-center">
                    <q-spinner-ball color="primary" size="5.5em" />
                </div>
            </q-card-section>
        </q-card>
    </q-dialog>
</template>
