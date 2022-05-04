<template>
	<div class="d-flex flex-column align-items-center justify-content-center">
		<div class="col-5 d-flex align-items-center justify-content-between">
			<h4 class="text-center">Alumni ID</h4>
			<button class="btn btn-primary" @click="printDocument()">
				Print Now
			</button>
		</div>
		<div id="alumni-id">
			<div class="content" v-if="alumni_id">
				<div class="back">
					<div class="main">
						<div class="text-id">
							<p>Address:</p>
							<span class="mt-3">{{ alumni_id.alumni_info.address }}</span>
						</div>
						<div class="text-id">
							<p>Course:</p>
							<span>{{ alumni_id.alumni_info.course }}</span>
						</div>
						<div class="text-id">
							<p>Date of Birth:</p>
							<span>{{ alumni_id.alumni_info.date_of_birth }}</span>
						</div>
						<div class="text-id">
							<p>Email Address:</p>
							<span>{{ alumni_id.alumni_info.email }}</span>
						</div>
						<div class="text-id">
							<p>Mobile No:</p>
							<span>{{ alumni_id.alumni_info.mobile_no }}</span>
						</div>
						<div class="text-id">
							<p>Telephone No:</p>
							<span>{{ alumni_id.alumni_info.telephone_no }}</span>
						</div>
						<div class="text-id">
							<img
								:src="`http://localhost:8000${alumni_id.alumni_info.signature}`"
								alt=""
							/>
							<span>{{ alumni_id.alumni_info.full_name }}</span>
							<p>Alumni</p>
						</div>
					</div>
				</div>
				<div class="front">
					<div
						class="px-1 d-flex align-items-center justify-content-center mt-3"
					>
						<div>
							<img
								class="id-logo-lnu"
								:src="require('../../../../images/logo.png').default"
							/>
						</div>
						<div class="text-center text-light header-container">
							<p>Republic of the Philippines</p>
							<h4>LEYTE NORMAL UNIVERSITY</h4>
							<p>Tacloban City</p>
						</div>
						<div>
							<img
								class="id-logo-iso"
								:src="require('../../../../images/isologo.jpg').default"
							/>
						</div>
					</div>
					<div class="col-12 text-center mt-3">
						<h1 class="text-alumni">ALUMNI</h1>
					</div>
					<div class="id-body">
						<img :src="require('../../../../images/lnu.jpg').default" />
						<div class="id-body-inside">
							<img :src="require('../../../../images/logo-2.png').default" />

							<img
								class="img-fluid"
								:src="`http://localhost:8000${alumni_id.alumni_info.image}`"
							/>
						</div>
					</div>
					<div
						class="course-info-body d-flex justify-content-between px-3 pt-2"
					>
						<div class="d-flex flex-column justify-content-between">
							<h4>{{ alumni_id.alumni_info.course }}</h4>
							<h6 class="align-self-end">
								BATCH {{ alumni_id.alumni_info.batch }}
							</h6>
						</div>
						<div class="text-center mt-1">
							<h5 class="fw-bold">ID No. {{ alumni_id.alumni_info.student_number }}</h5>
						</div>
					</div>
					<div class="col-12 d-flex align-items-center justify-content-center">
						<div class="full-name bg-light">
							<h4>
								{{ alumni_id.alumni_info.full_name }}
							</h4>
						</div>
					</div>

					<div class="col-12 text-center president">
						<h6>EVELYN B. AGUIRRE, DA</h6>
						<h6>University President</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: ["request_id"],
	data() {
		return {
			backInfo: {
				address: "Brgy 74. Purok 6 Nula-Tula, Tacloban City, Leyte 500",
				course: "BSIT",
				birthdate: "December 20, 2020",
				email: "bucatcatcirilo@gmail.com",
				mobile_number: "0926 412 3123",
				telephone: "123 123 1234",
				fullName: "Cirilo E. Bucatcat Jr.",
			},
		};
	},
	computed: {
		alumni_id() {
			return this.$store.getters["ADMIN_ID_MANAGEMENT/GET_STUDENT_ID_REQUEST"];
		},
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
	async mounted() {
		await this.$store.dispatch(
			"ADMIN_ID_MANAGEMENT/FETCH_STUDENT_ID_REQUEST",
			this.request_id
		);
	},
};
</script>

<style lang="scss" scoped>
.id-logo-lnu {
	width: 50px;
	height: 50px;
}

.id-logo-iso {
	width: 60px;
	height: 35px;
}
.id-container {
	width: 100vw;
	height: 100vh;
	display: flex;
	justify-content: center;
	align-items: center;
}
.id-body {
	position: relative;
	width: 100%;
	img {
		width: 100%;
		height: 150px;
	}
	.id-body-inside {
		img {
			position: absolute;

			&:first-child {
				top: 20px;
				left: 40px;
				height: 90px;
				width: 90px;
			}
			&:last-child {
				top: 20px;
				right: 20px;
				height: 130px;
				width: 120px;
				border: 4px solid black;
			}
		}
	}
}

.course-info-body {
	background: #6396f7;
	height: 60px;
	h4 {
		color: #daa73d;
		font-style: italic;
		font-weight: bold;
		text-transform: uppercase;
		-webkit-text-stroke: 1px #0c3071;
	}

	h5 {
		padding: 2px 5px;
		font-size: 16px;
		background: #fff;
	}

	h6 {
		color: #fff;
		font-weight: bold;
		font-size: 16px;
		-webkit-text-stroke: 1px #000;
	}
}

.full-name {
	position: relative;
	display: flex;
	justify-content: center;
	align-items: center;
	margin: 10px 0 40px 0;
	width: 80%;
	height: 50px;
	text-align: center;
	h4 {
		font-size: 1rem;
		text-transform: uppercase;
		font-weight: bold;
		z-index: 100;
		margin-left: 20px;
		color: #10286b;
	}

	&::before {
		content: "\A";
		border-style: solid;
		border-width: 23px 29px 30px 0;
		transform: rotate(180deg);
		border-color: transparent #10286b transparent transparent;
		position: absolute;
		left: 0px;
	}
}

.president {
	color: #daa73d;
	h6 {
		&:first-child {
			font-weight: bold;
		}
		&:last-child {
			font-size: 12px;
		}
	}
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

				img {
					position: absolute;
					width: 100px;
					top: 35px;
					left: 30%;
				}
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

				&:last-child {
					text-align: center;
					span {
						width: 100%;
						left: 50%;
						transform: translate(-50%, 0);
						top: 5rem;
						text-transform: uppercase;
						font-weight: bold;
						font-size: 1rem;
					}
					p {
						position: absolute;
						left: 50%;
						transform: translate(-50%, 0);
						top: 6.2rem;
						font-weight: 500;
					}
				}
			}
		}
	}

	.front {
		background: #292484;

		.header-container {
			margin: 0 5px;

			p {
				font-size: 10px;
			}

			h4 {
				font-size: 13px;
			}
		}

		.text-alumni {
			font-weight: 800;
			color: #d3a537;
			-webkit-text-stroke: 0.4px #fff;
			letter-spacing: 8px;
			font-size: 36px;
		}
	}
}
</style>