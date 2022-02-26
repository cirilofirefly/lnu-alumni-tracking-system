<template>
  <div class="signin">
    <div class="navbar">
      <router-link to="/" class="nav-item me-5">
        <span>
          <i class="bi bi-house-fill"></i>
          MAIN PAGE
        </span>
      </router-link>
    </div>
    <div class="signin-content">
      <div class="signin-main">
        <div class="signin-info">
          <div class="logo mb-3"></div>
          <h1 class="m-0 mb-3">Good day, User!</h1>
          <h5 class="m-0">Sign In to our system</h5>
          <p>
            Enter your <strong> username</strong> and
            <strong>password</strong> to sign in
          </p>
          <span class="mt-3 text-muted">
            You don't have an account?
            <router-link to="/signup">Sign up</router-link>
          </span>
        </div>
        <div class="signin-form">
          <form class="w-75" @submit.prevent="signinUser">
            <div class="form-floating mb-3">
              <input
                v-model="credentials.username"
                type="text"
                class="form-control"
                id="floatingInput"
                placeholder="Username"
              />
              <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating mb-2">
              <input
                v-model="credentials.password"
                type="password"
                class="form-control"
                id="floatingPassword"
                placeholder="Password"
              />
              <label for="floatingPassword">Password</label>
            </div>
            <div class="mb-4 form-check">
              <input
                v-model="isAdmin"
                type="checkbox"
                class="form-check-input"
                id="exampleCheck1"
              />
              <label class="form-check-label" for="exampleCheck1">Admin</label>
            </div>
            <button
              @click.prevent="signin"
              class="btn-signin btn btn-primary w-100 py-2"
            >
              <span>
                <i class="bi bi-box-arrow-in-left"></i>
                SIGN IN
              </span>
            </button>
          </form>

          <span
            class="mt-3 text-muted align-self-end"
            style="margin-right: 60px"
          >
            Forgot password? Click
            <router-link to="/forgot-password">here</router-link>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      credentials: {
        username: "",
        password: "",
      },
      isAdmin: false,
    };
  },
  methods: {
    async signin() {
      if (this.isAdmin) {
        const response = await this.$store.dispatch(
          "ADMIN_AUTH/LOGIN",
          this.credentials
        );
        if (response.status == 200) {
          this.$toast.success("Successfully logged in.");
          this.$router.push("/admin");
        } else {
          this.$toast.error(response.data.error);
        }
      }

      if (!this.isAdmin) {
        const response = await this.$store.dispatch(
          "STUDENT_AUTH/LOGIN",
          this.credentials
        );
        if (response.status == 200) {
          if (response.data?.access_token) {
            this.$toast.success("Successfully logged in.");
            this.$router.push("/student");
          } else {
            this.$toast.info(response.data.message);
          }
        } else {
          this.$toast.error(response.data.error);
        }
      }
    },
  },
  mounted() {},
};
</script>
