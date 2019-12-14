<template>
	<div>
		<a :href="meeting.link" class="btn btn-roundtable">Ir Conferencia</a>
	</div>
</template>

<script>
export default {
	props: ["meeting"]
};
</script>

<style></style>
