<template>
	<div>
		<h1>Feedback</h1>
		<h6 class="text-muted">Your feedback will be shown here.</h6>
		<div class="row mt-3">
			<div class="col shadow p-3">
				<button
					class="btn btn-primary my-4"
					@click="$bvModal.show('feedback-modal')"
				>
					<i class="bi bi-envelope"></i>
					Send a feedback
				</button>
				<div class="col-12 bg-light px-4">
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Name</th>
								<th scope="col">Email</th>
								<th scope="col" class="text-center">Content</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(feedback, index) in feedbacks" :key="index">
								<th scope="row">{{ index }}</th>
								<td>{{ `${feedback.student.student_basic_info.last_name}, 
                                    ${feedback.student.student_basic_info.first_name} 
                                    ${feedback.student.student_basic_info.middle_name == null ? '' : feedback.student.student_basic_info.middle_name}
                                    ${feedback.student.student_basic_info.suffix == null ? '' : feedback.student.student_basic_info.suffix}` }}</td>
								<td>{{ feedback.student.student_basic_info.email }}</td>
								<td class="text-center">
                                    {{ feedback.thread }}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<b-modal
			id="feedback-modal"
			title="Feedback"
			ok-variant="success"
			ok-title-html='<i class="bi bi-envelope"></i>  Send'
			@ok.prevent="sendFeedback"
			centered
		>
			<div class="form-group my-2">
				<label for="content">Content</label>
				<textarea
					name="content"
					v-model="feedback.content"
					class="form-control"
					id="content"
					cols="30"
					rows="10"
					placeholder="Enter your feedback here."
				></textarea>
			</div>
		</b-modal>
	</div>
</template>

<script>
import axios from "../../axios";
export default {
	data() {
		return {
			feedback: {
				content: "",
			},
			feedbacks: [],
		};
	},
	computed: {},
	methods: {
		async sendFeedback() {
			await axios
				.post(
					`student/send-feedback?token=${localStorage.getItem("access_token")}`,
					this.feedback
				)
				.then((response) => {
					this.$toast.success("Feedback Sent.");
					this.getData();
					this.$bvModal.hide("feedback-modal");
				})
				.catch((error) => {
					console.log(error);
				});
		},
		async getData() {
			await axios
				.get(
					`student/get-feedbacks?token=${localStorage.getItem("access_token")}`
				)
				.then((repsonse) => {
					this.feedbacks = { ...repsonse.data };
				})
				.catch((error) => {
					console.log(error);
				});
		},
	},
	async mounted() {
		this.getData();
	},
};
</script>

<style>
</style>