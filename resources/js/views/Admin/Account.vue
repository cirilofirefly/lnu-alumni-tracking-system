<template>
	<div class="container-fluid">
		<div class="row p-5">
			<div class="col-12">
				<h1 class="text-uppercase fw-bold" style="letter-spacing: 3px">
					Account Settings
				</h1>
			</div>
		</div>
		<div class="col-6 mt-3 shadow px-5 pb-5 pt-3 bg-light">
			<div class="d-flex justify-content-between mb-5 mt-3">
				<div>
					<button
						v-if="!isEditing"
						@click="isEditing = !isEditing"
						class="btn btn-primary"
					>
						Edit
					</button>
					<button
						v-if="isEditing"
						@click="cancelAction"
						class="btn btn-secondary"
					>
						Cancel
					</button>
					<button
						v-if="isEditing"
						@click="updateAccount"
						class="btn btn-primary"
					>
						Save
					</button>
				</div>
				<div>
					<button
						@click="$bvModal.show('password-modal')"
						class="btn btn-primary"
					>
						Change Password
					</button>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="form-group my-2">
						<label for="first_name">First Name</label>
						<input
							type="text"
							:disabled="!isEditing"
							class="form-control"
							id="first_name"
							v-model="account.first_name"
							placeholder="Enter First Name"
						/>
					</div>
					<div class="form-group my-2">
						<label for="last_name">Last Name</label>
						<input
							type="text"
							:disabled="!isEditing"
							class="form-control"
							id="last_name"
							v-model="account.last_name"
							placeholder="Enter Last Name"
						/>
					</div>
					<div class="form-group my-2">
						<label for="middle_name">Middle Name</label>
						<input
							type="text"
							:disabled="!isEditing"
							class="form-control"
							id="middle_name"
							v-model="account.middle_name"
							placeholder="Enter Middle Name"
						/>
					</div>
					<div class="form-group my-2">
						<label for="email">Email</label>
						<input
							type="text"
							:disabled="!isEditing"
							class="form-control"
							id="email"
							v-model="account.email"
							placeholder="Enter Middle Name"
						/>
					</div>
					<div class="form-group my-2">
						<label for="contact_number">Contact Number</label>
						<input
							type="text"
							:disabled="!isEditing"
							class="form-control"
							id="contact_number"
							v-model="account.contact_number"
							placeholder="Enter Contact Number"
						/>
					</div>
				</div>
			</div>

			<b-modal
				id="password-modal"
				title="Change Password"
				@ok.prevent="savePassword"
				ok-variant="success"
				ok-title="Save"
				centered
			>
				<div class="row">
					<div class="col-12">
						<div class="form-group my-2">
							<label for="current-password">Current Password</label>
							<input
								type="password"
								class="form-control"
								id="current-password"
								v-model="changePassword.oldPassword"
								placeholder="Enter current password"
							/>
						</div>
						<div class="form-group my-2">
							<label for="new-password">New Password</label>
							<input
								type="password"
								class="form-control"
								id="new-password"
								v-model="changePassword.password"
								placeholder="Enter new password"
							/>
						</div>
						<div class="form-group my-2">
							<label for="confirm-new-password">Confirm New Password</label>
							<input
								type="password"
								class="form-control"
								id="confirm-new-password"
								v-model="changePassword.password_confirmation"
								placeholder="Enter confirm new password"
							/>
						</div>
					</div>
				</div>
			</b-modal>
		</div>
	</div>
</template>


<script>
import axios from "../../axios";
export default {
	data() {
		return {
			changePassword: {
				oldPassword: "",
				password: "",
				password_confirmation: "",
			},
			isEditing: false,
			account: {},
		};
	},
	computed: {
		user() {
			return this.$store.getters["ADMIN_AUTH/GET_ADMIN_USER"];
		},
	},
	methods: {
		async savePassword() {
			await axios
				.put(
					`auth/admin/change-password?token=${localStorage.getItem(
						"access_token"
					)}`,
					this.changePassword
				)
				.then((response) => {
					this.$toast.success("Password saved");
					this.$bvModal.hide("password-modal");
				})
				.catch((error) => {
					console.log(error);
				});
		},

		async updateAccount() {
			await axios
				.put(
					`auth/admin/update-account?token=${localStorage.getItem(
						"access_token"
					)}`,
					this.account
				)
				.then((response) => {
					this.$toast.success("Account saved");
                    this.user.admin_info = { ...this.account }
				})
				.catch((error) => {
					console.log(error);
				});
            this.isEditing = !this.isEditing
		},
        cancelAction() {
            this.isEditing = !this.isEditing;
            this.account = { ...this.user.admin_info}
        }
	},
	async mounted() {
		this.account = { ...this.user.admin_info };
	},
};
</script>
<style>
</style>