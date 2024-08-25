<script setup>
import PageContainerLayout from "../../components/AuthLayout/PageContainerLayout.vue";
import { useLoginStore } from "../../../js/store";

const login = useLoginStore();
let form = login.form;
</script>
<template>
    <AuthLayout>
        <PageContainerLayout>
            <q-form class="qa-pa-md" @submit="login.onSubmit">
                <q-input
                    outlined
                    :label="$t('label.username')"
                    rounded
                    type="text"
                    class="q-pa-md"
                    dense
                    v-model="form.username"
                    :readonly="login.isSubmitting"
                    lazy-rules
                    :rules="login.usernameRules"
                />
                <q-input
                    outlined
                    :label="$t('label.password')"
                    rounded
                    type="password"
                    class="q-pa-md"
                    dense
                    v-model="form.password"
                    :readonly="login.isSubmitting"
                    lazy-rules
                    :rules="login.passwordRules"
                />
                <div class="q-pa-md">
                    <q-checkbox
                        v-model="form.remember_me"
                        dense
                        :label="$t('label.remember.me')"
                        :disabled="login.isSubmitting"
                    />
                </div>
                <div class="q-pa-md">
                    <q-btn
                        type="submit"
                        color="primary"
                        dense
                        rounded
                        unelevated
                        outline
                        class="full-width"
                        :label="$t('label.login')"
                        :disabled="login.isSubmitting"
                    ></q-btn>
                </div>
            </q-form>
        </PageContainerLayout>
    </AuthLayout>
</template>
