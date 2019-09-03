<template>
	<div>
		<div v-if="data.length === 0">
			<p class="text-center d-block mt-5 text-muted" style="font-size: 25px;"> Aún no hay empresas en esta categoría</p>
		</div>
		<div :id="name_id" >
			<div class="container p-3" v-for="(company, index) in data" :key="index">
				<div class="card">
					<div class="view-overlay">
						<img :src="company.cover_img" alt="" class="" style="width:100%; height:150px;">
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-5 p-0">
								<img :src="company.profile_img" alt="" style="width:100%;" class="img-profile">
							</div>
							<div class="col-7">
								<h6 class="card-title">
									<a href="">{{company.name}}</a>
								</h6>
								<ul class="rating">
									<li><i class="fa fa-star amber-text"></i></li>
									<li><i class="fa fa-star amber-text"></i></li>
									<li><i class="fa fa-star amber-text"></i></li>
									<li><i class="fa fa-star amber-text"></i></li>
									<li><i class="fa fa-star-half amber-text"></i></li>
									<li><p class="text-muted m-0">{{company.rating}} (20)</p></li>
								</ul>
								<!-- <p class="card-text text-muted m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
								
								<a :href="'business/description/' + company.uuid">
									<button class="btn btn-outline-success">
										Ver más
									</button>
								</a>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>


export default {
    props: ['name', 'data'],
    data() {
        return {
			name_id: this.name
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
	.rating {
		color: #ffa000;
    	list-style-type: none;
    	padding: 0;
		margin: 0;
	}
	.rating li {
		display: inline-block;
	}
	.img-profile {
		border-radius: 50%;
	}
</style>
