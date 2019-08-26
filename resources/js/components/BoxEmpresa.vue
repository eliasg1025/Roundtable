<template>
    
</template>

<script>
export default {
	data: ['company'],
	data() {
		return {}
	},
	created() {
		console.log(this.company);
	}
};
</script>

<style>
    .card {
        box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
        border: 0;
        font-weight: 400;
        border-radius: 0.25rem;
    }
    .card-title a{
        text-decoration: none;
        color: black;
    }
</style>
