<template>
	<div class="sidebar">
		<div class="logo">
			<img src="../../images/logo.png" />
			<h3>LNU AITS</h3>
			<button>
				<span class="material-icons-sharp"> menu </span>
			</button>
		</div>
		<div class="main">
			<router-link class="sidebar-link" :to="{ name: 'admin.dashboard' }">
				<span class="material-icons-sharp"> dashboard </span>
				<h3>Dashboard</h3>
			</router-link>
			<div class="sidebar-link" @click="showSubMenu">
				<span class="material-icons-sharp"> people </span>
				<h3>Alumni Management</h3>
				<span class="material-icons-sharp" :class="{ clicked: toggled }">
					keyboard_arrow_up
				</span>
			</div>
			<div class="sidebar-sub-link" :class="{ shown: toggled }">
				<router-link
					class="sidebar-link"
					:to="{ name: 'admin.alumni.approval' }"
				>
					<span class="material-icons-sharp"> approval </span>
					<h3>Approval</h3>
				</router-link>
				<router-link
					class="sidebar-link"
					:to="{ name: 'admin.alumni.id-request' }"
				>
					<span class="material-icons-sharp"> credit_card </span>
					<h3>ID Request</h3>
				</router-link>
				<router-link class="sidebar-link" :to="{ name: 'admin.alumni.batch' }">
					<span class="material-icons-sharp"> view_timeline </span>
					<h3>Batch</h3>
				</router-link>
				<router-link
					class="sidebar-link"
					:to="{ name: 'admin.alumni.records' }"
				>
					<span class="material-icons-sharp"> folder </span>
					<h3>Records</h3>
				</router-link>
			</div>
			<router-link class="sidebar-link" :to="{ name: 'admin.event' }">
				<span class="material-icons-sharp"> event </span>
				<h3>Event Management</h3>
			</router-link>
			<router-link class="sidebar-link" :to="{ name: 'admin.account' }">
				<span class="material-icons-sharp"> manage_accounts </span>
				<h3>Account Setting</h3>
			</router-link>
			<router-link class="sidebar-link" :to="{ name: 'admin.feedback' }">
				<span class="material-icons-sharp"> question_answer </span>
				<h3>Feedback</h3>
			</router-link>
			<router-link class="sidebar-link" :to="{ name: 'admin.notification' }">
				<span class="material-icons-sharp"> notifications_active </span>
				<h3>Notification</h3>
			</router-link>
			<button class="sidebar-link" @click.prevent="logout">
				<span class="material-icons-sharp"> logout </span>
				<h3>Logout</h3>
			</button>
		</div>
		<div class="user-profile" v-if="user">
			<b-avatar class="avatar shadow" size="5rem"></b-avatar>
			<div class="user-info">
				<h1>
					{{ `${user.admin_info.first_name} ${user.admin_info.last_name}` }}
				</h1>
				<span>({{ user.username }})</span>
			</div>
		</div>
	</div>
</template>

<script>
import "boxicons";
export default {
	props: ["user"],
	data() {
		return {
			toggled: false,
		};
	},
	methods: {
		showSubMenu() {
			this.toggled = !this.toggled;
		},
		async logout() {
			const response = await this.$store.dispatch("ADMIN_AUTH/LOGOUT");
			if (response.status == 200) {
				this.$router.push({ name: "signin" });
				this.$toast.success(response.data.message);
			}
		},
	},
};
</script>

<style>
</style>