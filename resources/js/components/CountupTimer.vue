<template>
	<div class="reloj" :class="{ almost_over: almost_over }">
		<div v-if="!expired">
			<p id="minutos">
				{{ countduration_minutes }}
			</p>
			<p>:</p>
			<p id="segundos">
				{{ countduration_seconds }}
			</p>
		</div>
		<div v-else>
			<p id="minutos">
				00
			</p>
			<p>:</p>
			<p id="segundos">
				00
			</p>
		</div>
	</div>
</template>

<script>
export default {
	name: "countup-timer",
	props: ["expiration_date", "meeting_date", "meeting_id"],
	data() {
		return {
			countduration_minutes: "",
			countduration_seconds: "",
			almost_over: false,
			expired: false
		};
	},
	mounted() {
		let expiration_time = this.expiration_date.getTime();
		let max_duration =
			expiration_time - new Date(this.meeting_date).getTime();

		let interval = setInterval(() => {
			let current_time = new Date().getTime();
			let minutes = Math.floor((expiration_time - current_time) / 60000);
			let seconds =
				Math.floor((expiration_time - current_time) / 1000) % 60;

			minutes = minutes >= 10 ? minutes : "0" + minutes;
			seconds = seconds >= 10 ? seconds : "0" + seconds;

			// console.log(`${minutes} minutos y ${seconds} segundos`);
			this.countduration_minutes = minutes;
			this.countduration_seconds = seconds;

			if (minutes <= 3) {
				this.almost_over = true;
			}

			if (current_time > expiration_time) {
				clearInterval(interval);
				this.expired = true;
				this.$emit("expired", this.expired);
				$("#addRatingModal").modal("toggle");

				axios
					.post("/meet/end-meet", {
						meeting_id: this.meeting_id
					})
					.then(res => {
						console.log(res.data);
					})
					.catch(err => {
						console.log(err);
					});
			}
		}, 1000);
	}
};
</script>

<style lang="scss" scoped>
.almost_over {
	background-color: #f8d7da;
	border-color: #f5c6cb;
}

.almost_over p {
	color: #721c24;
}
</style>
