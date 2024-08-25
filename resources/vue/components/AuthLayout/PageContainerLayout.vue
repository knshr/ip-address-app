<script setup>
import Loader from "../Loader.vue";
</script>
<template>
    <div class="column" style="height: 80vh">
        <div class="col self-center"></div>
        <div class="col self-center">
            <q-card flat class="page-card">
                <div class="column">
                    <div class="col text-center">
                        <q-img
                            src="/img/default/logo.png"
                            style="height: 100px; max-width: 100px"
                        ></q-img>
                    </div>
                </div>
                <q-card-section>
                    <div class="col self-center"></div>
                    <slot />
                </q-card-section>
            </q-card>
        </div>
        <div class="col self-center"></div>
        <Loader />
    </div>
</template>
<style lang="sass" scoped>
.page-card
    width: 100%
    max-width: 500px
    min-width: 500px
</style>
