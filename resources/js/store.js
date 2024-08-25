import { defineStore } from "pinia";
import { trans } from "laravel-vue-i18n";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/dist/sweetalert2.css";
import { ref } from "vue";

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

export const useIpAddressStore = defineStore("ip_address", {
    state: () => {
        return {
            rows: [
                {
                    ip_address: "127.0.0.1",
                    label: "localhost",
                },
            ],
            columns: [
                {
                    name: "ip_address",
                    label: "ip.address",
                    align: "left",
                },
                {
                    name: "label",
                    label: "label",
                    align: "left",
                },
                {
                    name: "actions",
                    label: "actions",
                    align: "right",
                },
            ],
            form: ref({
                ip_address: "",
                label: "",
            }),
            addModal: false,
            editModal: false,
            auditModal: false,
            isSubmitting: false,
        };
    },
    actions: {
        async submit() {
            const app = useAppStore();
            app.toggleLoading();
            await axios.post("/ip_address", this.form);
            Swal.fire({
                title: trans("label.ip.address"),
                text: trans("success.created"),
                icon: "success",
                showConfirmButton: false,
                timer: 2000,
            });
            this.toggleAddModal();
            this.form = {
                ip_address: "",
                label: "",
            };
            this.init();
        },
        async update() {
            const app = useAppStore();
            app.toggleLoading();
            await axios.put(`/ip_address/${this.form.id}`, this.form);
            Swal.fire({
                title: trans("label.ip.address"),
                text: trans("success.updated"),
                icon: "success",
                showConfirmButton: false,
                timer: 2000,
            });
            this.toggleEditModal();
            this.form = {
                ip_address: "",
                label: "",
            };
            this.init();
        },
        async show(value) {
            const app = useAppStore();
            app.toggleLoading();
            this.form = value;
            app.toggleLoading();
            this.editModal = true;
        },
        async init() {
            const app = useAppStore();
            if (!app.loading) {
                app.toggleLoading();
            }
            const { data } = await axios.get(`/ip_address`);
            this.rows = data.values.data;
            app.toggleLoading();
        },
        async showLogs(id) {
            const app = useAppStore();
            const audit = useAuditLogsStore();

            app.toggleLoading();
            const { data } = await axios.get(`/audit-logs/${id}/ip-address`);
            audit.rows = data.values.data;
            audit.toggleModal();
            app.toggleLoading();
        },
        toggleAddModal() {
            this.addModal = !this.addModal;
            this.form = {
                ip_address: "",
                label: "",
            };
        },
        toggleEditModal() {
            this.editModal = !this.editModal;
            this.form = {
                ip_address: "",
                label: "",
            };
        },
        checkIfIP(val) {
            const ipChecker =
                /^(?!0)(?!.*\.$)((1?\d?\d|25[0-5]|2[0-4]\d)(\.|$)){4}$/;

            console.log(ipChecker.test(val));
            if (ipChecker.test(val)) {
                return false;
            }
            return true;
        },
    },
});

export const useAuditLogsStore = defineStore("audit_logs", {
    state: () => {
        return {
            rows: [],
            columns: [
                {
                    name: "date",
                    label: "date",
                    align: "left",
                },
                {
                    name: "event",
                    label: "event",
                    align: "left",
                },
                {
                    name: "old_values",
                    label: "old.values",
                    align: "left",
                },
                {
                    name: "new_values",
                    label: "new.values",
                    align: "left",
                },
                {
                    name: "audited",
                    label: "audited",
                    align: "left",
                },
            ],
            modal: false,
        };
    },
    actions: {
        toggleModal() {
            this.modal = !this.modal;
        },
        async showLogs() {
            const app = useAppStore();

            app.toggleLoading();
            const { data } = await axios.get(`/audit-logs`);
            this.rows = data.values.data;
            this.toggleModal();
            app.toggleLoading();
        },
    },
});
