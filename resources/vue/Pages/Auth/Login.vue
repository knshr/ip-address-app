<template lang="">
    <AuthLayout>
        <PageContainerLayout>
            <q-input
                outlined
                :label="$t('label.username')"
                rounded
                type="text"
                class="q-pa-sm"
                dense
            />
            <q-input
                outlined
                :label="$t('label.password')"
                rounded
                type="password"
                class="q-pa-sm"
                dense
            />
            <div class="q-pa-sm">
                <q-btn
                    color="primary"
                    dense
                    rounded
                    unelevated
                    outline
                    class="full-width"
                    :label="$t('label.login')"
                ></q-btn>
            </div>
        </PageContainerLayout>
    </AuthLayout>
</template>
<script>
import PageContainerLayout from "../../components/AuthLayout/PageContainerLayout.vue";
export default {
    components: {
        PageContainerLayout,
    },
};
</script>
<style lang=""></style>
