<template>
	<div>
		<div v-if="loaded">
			<StudentSidebar />
			<StudentHeader />
			<div class="router-container">
				<div class="container-fluid">
					<router-view class=""></router-view>
				</div>
			</div>
		</div>
		<div
			v-else
			class="
				w-100
				vh-100
				d-flex
				flex-column
				justify-content-center
				align-items-center
			"
		>
			<div><h4>Now Loading...</h4></div>
			<div>
				<div class="spinner-grow mx-2" role="status"></div>
				<div class="spinner-grow mx-2" role="status"></div>
				<div class="spinner-grow mx-2" role="status"></div>
			</div>
		</div>
	</div>
</template>
<script>
import StudentHeader from "../../components/Student/Header.vue";
import StudentSidebar from "../../components/Student/Sidebar.vue";
export default {
	components: {
		StudentHeader,
		StudentSidebar,
	},
	data() {
		return {
			loaded: true,
		};
	},
	async mounted() {
		this.loaded = !this.loaded;
		await this.$store.dispatch("STUDENT_AUTH/CHECK");
		this.loaded = !this.loaded;
	},
};
</script>