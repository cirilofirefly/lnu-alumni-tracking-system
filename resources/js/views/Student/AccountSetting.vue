<template>
	<div>
		<h1>Account Settings</h1>
		<div class="row">
			<div class="col">
				<button
					@click="$bvModal.show('password-modal')"
					class="btn btn-primary mt-5"
				>
					Change Password
				</button>
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
</template>

<script>
import axios from '../../axios'
export default {
    data() {
        return {
            changePassword: {
                oldPassword: '',
                password: '',
                password_confirmation: ''
            }
        }
    },
    computed: {
        user() {
            return
        }
    },
	methods: {
		async savePassword() {
            await axios.put(`auth/student/change-password?token=${localStorage.getItem('access_token')}`, this.changePassword)
                .then(response => {
                    this.$toast.success('Password saved')
                    this.$bvModal.hide('password-modal')
                })
                .catch(error => {
                    console.log(error)
                });
        },
	},
};
</script>

<style>
</style>