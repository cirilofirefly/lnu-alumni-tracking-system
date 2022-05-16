<template>
	<div class="landing d-flex flex-column align-items-center">
		<div class="container vh-100 h-100">
			<div class="d-flex flex-column justify-content-center h-100">
				<div class="">
					<img src="/images/logo.png" alt="" height="100" />
				</div>
				<div class="text-white mt-4">
					<h5 class="ls-sm mb-1 text-uppercase">Leyte Normal University</h5>
					<h1 class="ls-sm fw-bold heading text-uppercase">
						Alumni Information <br />
						Tracking System
					</h1>
					<h1></h1>
				</div>
				<div class="d-block mt-3">
					<router-link to="signin" class="btn btn-outline-light btn-lg"
						>SIGN-IN</router-link
					>
				</div>
				<p class="text-white mt-2">
					Dont have an account?
					<router-link to="signup" class="text-white ml-2"
						>Create Account</router-link
					>
				</p>
			</div>
		</div>

		<div class="col-9 pb-5 mt-5">
			<div class="col-12 p-3 bg-light shadow-lg rounded">
				<div class="d-flex justify-content-between align-items-center">
					<h3 class="pt-4 pb-2 ps-4 text-uppercase fw-bold">Latest Event</h3>
				</div>
				<div
					v-if="loading"
					class="d-flex justify-content-center align-items-center"
				>
					<div class="spinner-border" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
				</div>
				<div v-else class="p-4">
					<div v-if="event">
						<h2 class="mb-2">{{ event.name }}</h2>
						<h6 v-if="event.category" class="mb-2 text-muted">
							{{ event.category.category }}
						</h6>
						<div class="mb-2" v-html="event.content"></div>
						<button
							class="btn btn-primary rounded"
							@click="
								hasToken()
									? $router.push({ path: `student/event/${event.slug}` })
									: $router.push({ path: `signin` })
							"
						>
							Learn More
						</button>
					</div>
					<div v-if="!event">
						<h5>No Latest Event</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import axios from "../axios";
export default {
	data() {
		return {
			event: null,
			loading: false,
		};
	},
	methods: {
		async latestEvent() {
			this.setLoading();
			const response = axios
				.get("latest-event")
				.then((response) => {
					this.event = { ...response.data };
					this.setLoading();
				})
				.catch((error) => {
					console.log(error);
					this.setLoading();
				});
		},
		setLoading() {
			this.loading = !this.loading;
		},
		hasToken() {
			return localStorage.getItem("access_token");
		},
	},
	mounted() {
		this.latestEvent();
	},
};
</script>