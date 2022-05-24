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
		<div class="d-flex min-vh-100 justify-content-center align-items-center">
			<div class="col-12 col-sm-10 col-md-9 col-lg-8 col-xl-7">
				<div class="card pt-5 pb-5 ps-4 pe-4">
					<div class="row justify-content-center align-items-center">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<img src="/images/logo.png" alt="" height="100" />
							<h1 class="ls-sm m-0 mb-3">Good day, Admin!</h1>
							<p class="mb-2">
								Please enter credentials to proceed.
							</p>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6">
							<h2 class="mb-2 fw-bold">Log-in</h2>
							<p class="mb-2">
								Enter your <strong> username</strong> and
								<strong>password</strong><br />
								to proceed to your account.
							</p>
							<form class="pe-4" @submit.prevent="signinUser">
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
								<button
									@click.prevent="signin"
									class="btn btn-signin btn-primary w-100"
								>
									<span>
										<i class="bi bi-box-arrow-in-left"></i>
										SIGN-IN
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
export default {
	data() {
		return {
			credentials: {
				username: "",
				password: "",
			},
		};
	},
	methods: {
		async signin() {
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
		},
	},
	mounted() {},
};
</script>
