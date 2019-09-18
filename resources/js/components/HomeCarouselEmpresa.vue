<template>
	<div>
		<div v-if="data.length === 0">
			<p class="text-center d-block mt-5 text-muted" style="font-size: 25px;"> Aún no hay empresas en esta categoría</p>
		</div>
		<div :id="name_id" >
			<card-business
				v-for="(company, index) in data" :key="index"
				:company="company"
				:loged="loged"
			>
			</card-business>
		</div>
	</div>
</template>

<script>


export default {
    props: ['name', 'data', 'loged'],
    data() {
        return {
			name_id: this.name,
        }
	}
}
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
		font-weight: 600;
		font-size: 17px;
    }

	.view-overlay {
		min-height: 150px;
	}

	.view-overlay img {
		object-fit: cover;
	}

	.img-profile {
		border-radius: 50%;
	}

	.business-card-container {
		height: 380px;
	}

	.business-card-container .card {
		height: 100%;
	}

	.business-card-logo-container {
		display: flex;
		align-items: center;
	}
</style>
