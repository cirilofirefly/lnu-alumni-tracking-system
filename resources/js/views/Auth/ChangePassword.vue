<template>
    <div>
        <div class="signin">
            <div class="navbar">
                <router-link to="/" class="nav-item me-5">
                    <span>
                        <i class="bi bi-house-fill"></i>
                        HOME
                    </span>
                </router-link>
            </div>
        </div>
        <div
            class="d-flex min-vh-100 justify-content-center align-items-center"
        >
            <div class="col-12 col-sm-10 col-md-9 col-lg-8 col-xl-7">
                <div class="card pt-5 pb-5 ps-4 pe-4">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <img src="/images/logo.png" alt="" height="100" />
                            <h1 class="ls-sm m-0 mb-3">Good day, User!</h1>
                            <p class="mb-2">
                                Please enter credentials to proceed.
                            </p>
                            <!-- <p class="mt-2 mb-3 text-muted align-self-end">
                                Forgot password? Click
                                <router-link
                                    to="/forgot-password"
                                    class="text-decoration-none"
                                    >here</router-link
                                >
                            </p> -->
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <h2 class="mb-2 fw-bold">Forgot Password</h2>
                            <p class="mb-2">
                                Enter your <strong> new password</strong>
                                to proceed.
                            </p>
                            <form class="pe-4" @submit.prevent="signinUser">
                                <div class="form-floating mb-3">
                                    <input
                                        v-model="credentials.password"
                                        type="password"
                                        class="form-control"
                                        id="floatingInput"
                                        placeholder="Email Address"
                                    />
                                    <label for="floatingInput"
                                        >Enter New Password</label
                                    >
                                </div>
                                <div class="form-floating mb-3">
                                    <input
                                        v-model="credentials.confirm_password"
                                        type="password"
                                        class="form-control"
                                        id="floatingInput"
                                        placeholder="Email Address"
                                    />
                                    <label for="floatingInput"
                                        >Re-enter Password</label
                                    >
                                </div>
                                <button
                                    @click.prevent="signin"
                                    class="btn btn-signin btn-primary w-100"
                                >
                                    <span>
                                        <i class="bi bi-box-arrow-in-left"></i>
                                        SUBMIT
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "../../axios";
export default {
    data() {
        return {
            credentials: {
                password: "",
                confirm_password: "",
            },
        };
    },
    methods: {
        async signin() {
            const userID = localStorage.getItem("userID");
            if (this.password === this.confirm_password) {
                var data = {
                    id: userID,
                    password: this.credentials.password,
                };

                const res = axios
                    .post(`student/resetPassword`, data)
                    .then((res) => {
                        if (res.status == 200) {
                            this.$router.replace("/");
                        }
                    });
            }
        },
    },
    mounted() {},
};
</script>
