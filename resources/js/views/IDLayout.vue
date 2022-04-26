<template>
	<div class="id-container">
		<button class="btn btn-dark" @click="printDocument()">Print</button>

		<div id="alumni-id">
			<div class="content">
				<div class="back">
					<div class="main">
						<div class="text-id">
							<p>Address:</p>
							<span class="mt-3">{{ backInfo.address }}</span>
						</div>
						<div class="text-id">
							<p>Course:</p>
							<span>{{ backInfo.course }}</span>
						</div>
						<div class="text-id">
							<p>Date of Birth:</p>
							<span>{{ backInfo.birthdate }}</span>
						</div>
						<div class="text-id">
							<p>Email Address:</p>
							<span>{{ backInfo.email }}</span>
						</div>
						<div class="text-id">
							<p>Mobile No:</p>
							<span>{{ backInfo.mobile_number }}</span>
						</div>
						<div class="text-id">
							<p>Telephone No:</p>
							<span>{{ backInfo.telephone }}</span>
						</div>
					</div>
				</div>
				<div class="front">
					<p>Address:</p>
					<span>Brgy 74. Purok 6 Nula-Tula</span>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			backInfo: {
				address: "Brgy 74. Purok 6 Nula-Tula, Tacloban City, Leyte 500",
				course: "BSIT",
				birthdate: "December 20, 2020",
				email: "bucatcatcirilo@gmail.com",
				mobile_number: "0926 412 3123",
				telephone: "123 123 1234",
			},
		};
	},
	methods: {
		printDocument() {
			var printContents = document.getElementById("alumni-id").innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		},
	},
};
</script>

<style lang="scss" scoped>
/* h:  20.25rem, w: 12.756rem */

.id-container {
	width: 100vw;
	height: 100vh;
	display: flex;
	justify-content: center;
	align-items: center;
}
#alumni-id {
	padding: 5px;
	width: 60%;
	height: 40rem;
}
.content {
	display: flex;
	justify-content: center;
	align-items: center;
	padding: 5rem 0;

	.back,
	.front {
		width: 20rem;
		height: 30rem;
		border: 1px solid black;
		margin: 0 0.4rem;
	}

	.back {
		display: flex;
		justify-content: center;
		align-items: center;
		.main {
			height: 90%;
			width: 90%;
			border-radius: 1rem;
			border: 2px solid black;
			padding: 0 10px;

			.text-id {
				position: relative;
				width: 100%;
				height: 30px;

				p {
					font-weight: bold;
					font-size: 14px;
				}
				span {
					position: absolute;
					top: 0px;
					left: 45%;
				}

				&:first-child {
					margin-top: 2rem;
					margin-bottom: 3rem;


					span {
						left: 13%;
						top: 4px;
					}
				}

                &:nth-child(4) {
                    span {
                        font-size: 11px;
                    }
                }
			}
		}
	}
}
</style>