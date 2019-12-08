<template>
	<div>
		<a :href="link" class="btn btn-roundtable">Ir Conferencia</a>
	</div>
</template>

<script>
export default {
	props: ["meeting"],
	data() {
		return {
			link: ""
		};
	},
	mounted() {
		axios.get(`/calendar-event/${this.meeting.id}`).then(res => {
			let { link } = res.data;
			this.link = link;
		});
	}
};
</script>

<style></style>
