<template>
	<div>
		<div v-if="!showButton">
			<b
				>Videoconferencia en :
				<span
					>{{ days }}d {{ hours }}h {{ minutes }}m
					{{ seconds }}s</span
				></b
			>
		</div>
		<div>
			<a :href="link" class="btn btn-roundtable">Ir Conferencia</a>
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
			showButton: false,
			link: ""
		};
	},
	mounted() {
		axios.get(`/calendar-event/${this.meeting.id}`).then(res => {
			let { date, timezone, link } = res.data;
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
					this.showButton = true;
				}
			}, 1000);
		});
	},
	methods: {}
};
</script>

<style lang="sass"></style>
