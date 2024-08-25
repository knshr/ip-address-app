import { defineStore } from "pinia";
import { trans } from "laravel-vue-i18n";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/dist/sweetalert2.css";

export let useAppStore = defineStore("app", {
    state: () => {
        return {
            loading: false,
        };
    },
    actions: {
        toggleLoading() {
            this.loading = !this.loading;
        },
    },
});

export const useLoginStore = defineStore("login", {
    state: () => {
        return {
            isSubmitting: false,
            form: {
                remember_me: false,
            },
            message: "",
            usernameRules: [(val) => !!val || "Username field is required"],
            passwordRules: [(val) => !!val || "Password field is required"],
        };
    },
    actions: {
        async onSubmit() {
            const app = useAppStore();
            app.toggleLoading();
            await axios
                .post("/login", this.form)
                .then((response) => {
                    Swal.fire({
                        title: trans("label.login"),
                        text: trans("message.login.success"),
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                })
                .catch((err) => {
                    console.log();
                    Swal.fire({
                        title: trans("label.login"),
                        text: err.response.data.message,
                        icon: "error",
                        showConfirmButton: true,
                    });
                });

            app.toggleLoading();
        },
        async logout() {
            try {
                await axios.get("/logout", this.form);
            } catch (error) {
                window.location.reload();
            }
        },
    },
});
