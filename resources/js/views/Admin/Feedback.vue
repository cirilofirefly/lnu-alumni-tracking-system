<template>
	<div class="container-fluid d-flex justify-content-center">
		<div class="col-6 shadow p-3 rounded">
			<div class="col-12">
				<h5>{{ feedback.thread }}</h5>
			</div>
			<div
				id="message-container"
				class="col-12 mt-5"
				style="overflow-y: scroll; height: 50vh"
			>
				<div
					class="my-3"
					v-for="(message, index) in feedback.messages"
					:key="index"
				>
					<div
						v-if="message.isAdmin"
						class="col-12 d-flex align-items-end justify-content-end"
					>
						<div class="d-flex align-items-center">
							<span
								class="me-3"
								style="
									word-break: break-all;
									word-wrap: break-word;
									white-space: pre-wrap;
                                    text-align: start;

								"
							>
								{{ message.message }}
							</span>
							<div>
								<img
									src="https://ui-avatars.com/api/?name=System+Admin"
									width="40"
									height="40"
									class="bg-dark rounded-circle img-fluid mx-2"
								/>
							</div>
						</div>
					</div>
					<div v-else class="col-12 d-flex align-items-start justify-content-start">
						<div class="d-flex align-items-center">
							<div class="me-3">
								<img
                                    :src="feedback.student.id_image"
									class="bg-dark rounded-circle img img-fluid mx-2"
									width="40"
									height="40"
								/>
							</div>
							<span
								class="me-3"
								style="
									word-break: break-all;
									white-space: pre-wrap;
                                    text-align: start;

								"
							>
								{{ message.message }}
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 mt-4 pb-3">
				<div class="d-flex">
					<input
						v-model="message"
						type="text"
						class="form-control rounded-pill"
					/>
					<button
						@click="sendMessage"
						:disabled="isLoading"
						class="btn btn-primary rounded-circle ms-2"
					>
						<i class="bi bi-send"></i>
					</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import axios from "../../axios";
export default {
	props: ["id"],
	data() {
		return {
			feedback: {},
			message: "",
			isLoading: false,
		};
	},
	computed: {},
	methods: {
		scrollDown() {
			var element = document.getElementById("message-container");
			if (element) {
				element.scrollTop = element.scrollHeight;
			}
		},
		async sendMessage() {
			this.isLoading = this.isLoading;
			await axios
				.post(
					`admin/send-message/${this.id}?token=${localStorage.getItem(
						"access_token"
					)}`,
					{ message: this.message }
				)
				.then((response) => {
					this.getData();
					this.message = "";
					this.isLoading = !this.isLoading;
				})
				.catch((error) => {
					console.log(error);
					this.isLoading = !this.isLoading;
				});
		},
		async getData() {
			await axios
				.get(
					`admin/get-feedback/${this.id}?token=${localStorage.getItem(
						"access_token"
					)}`
				)
				.then((repsonse) => {
					this.feedback = { ...repsonse.data };
					this.scrollDown();
				})
				.catch((error) => {
					console.log(error);
				});
		},
	},
	mounted() {
		this.getData();
	},
};
</script>

<style>
</style>