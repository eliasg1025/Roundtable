<template>
	<div>
		<div v-if="showCountdown">
			<b
				>Videoconferencia en :
				<span
					>{{ days }}d {{ hours }}h {{ minutes }}m
					{{ seconds }}s</span
				></b
			>
		</div>
		<div v-if="!showCountdown && !expired">
			<h4>En proceso</h4>
		</div>
		<div v-if="!expired">
			<a :href="link" class="btn btn-roundtable">
				Ir Conferencia
			</a>
		</div>
		<div v-if="expired">
			<h4 class="text-muted">Concluido</h4>
		</div>
	</div>
</template>

<script>
export default {
	props: ["meeting"],
	data() {
		return {
			countdownDate: "",
			days: "",
			hours: "",
			minutes: "",
			seconds: "",
			showCountdown: true,
			link: ""
		};
	},
	computed: {
		expiration_date() {
			return new Date(
				new Date(this.meeting.date).getTime() +
					this.meeting.max_duration * 60 * 1000
			);
		},
		expired() {
			return new Date().getTime() > this.expiration_date;
		}
	},
	mounted() {
		let { date, timezone, link } = this.meeting;
		this.link = link;
		this.countdownDate = new Date(date).getTime();

		let interval = setInterval(() => {
			let distance = this.countdownDate - new Date().getTime();

			this.days = Math.floor(distance / (1000 * 60 * 60 * 24));
			this.hours = Math.floor(
				(distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
			);
			this.minutes = Math.floor(
				(distance % (1000 * 60 * 60)) / (1000 * 60)
			);
			this.seconds = Math.floor((distance % (1000 * 60)) / 1000);

			if (distance < 0) {
				clearInterval(interval);
				this.showCountdown = false;
			}
		}, 1000);
	}
};
</script>

<style lang="sass"></style>
