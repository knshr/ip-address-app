import { defineStore } from "pinia";

export let useAppStore = defineStore("app", {
    state() {
        return {
            leftNavigation: true,
        };
    },
    actions: {
        toggleLeftNav() {
            this.leftNavigation = !this.leftNavigation;
        },
    },
});
