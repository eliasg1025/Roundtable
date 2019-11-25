<template>
	<section class="plan container">
		<div class="row">
			<div class="col-lg-12">
				<div class="line"></div>
				<h4 style="text-align:center; padding:20px 0px 50px 0px; ">
					Elige tu Plan
				</h4>
			</div>
			<div class="columna col-lg-4">
				<ul
					class="price"
					style="border:1px solid #EBE2DD; box-shadow: 0 8px 12px 0 rgba(15, 15, 15, 0.2);"
				>
					<li class="gris">Plan Free</li>
					<li class="grey">
						<sup style="font-size:25px; color:gray;">$</sup
						><span style="font-size:40px; color:gray;">0</span>
						<span style="font-size:20px; color:gray;">al mes</span>
					</li>
					<li><span class="fa fa-check"></span> 10GB Storage</li>
					<li><span class="fa fa-check"></span>20 Emails</li>
					<li><span class="fa fa-check"></span>10 Domains</li>
					<li><span class="fa fa-check"></span>1GB Bandwidth</li>
					<li class="grey">
						<a href="" class="button">¡LO QUIERO!</a>
					</li>
				</ul>
			</div>
			<div class="columna col-lg-4 animacion">
				<ul
					class="price"
					style="border:1px solid #FFE296;box-shadow: 0 8px 12px 0 rgba(15, 15, 15, 0.2);"
				>
					<li class="verde">Plan Premium</li>
					<li class="grey">
						<sup style="font-size:25px; color:#FF8008;">$</sup
						><span style="font-size:40px; color:#FF8008;">200</span>
						<span style="font-size:20px; color:#FF8008;"
							>al mes</span
						>
					</li>
					<li><span class="izq fa fa-check"></span>10GB Storage</li>
					<li><span class="izq fa fa-check"></span>10 Emails</li>
					<li><span class="izq fa fa-check"></span>10 Domains</li>
					<li><span class="izq fa fa-check"></span>1GB Bandwidth</li>
					<li class="grey">
						<a href="#" class="button">¡LO QUIERO!</a>
					</li>
				</ul>
			</div>
			<div class="columna col-lg-4">
				<ul
					class="price"
					style="border:1px solid #FAA56E; box-shadow: 0 8px 12px 0 rgba(15, 15, 15, 0.2);"
				>
					<li class="claro">Plan Basic</li>
					<li class="grey">
						<sup style="font-size:25px; color:#C73A71;">$</sup
						><span style="font-size:40px; color:#C73A71;">90</span>
						<span style="font-size:20px; color:#C73A71;"
							>al mes</span
						>
					</li>
					<li><span class="izq fa fa-check"></span>10GB Storage</li>
					<li><span class="izq fa fa-check"></span>10 Emails</li>
					<li><span class="izq fa fa-check"></span>10 Domains</li>
					<li><span class="izq fa fa-check"></span>1GB Bandwidth</li>
					<li class="grey">
						<a href="#" class="button">¡LO QUIERO!</a>
					</li>
				</ul>
			</div>
		</div>
	</section>
</template>

<script>
export default {
	name: "planes",
	mounted() {
		console.log("Component mounted.");
	}
};
</script>

<style>
.plan {
	background-image: url("/img/fondo/latest-product-bg.png");
	padding: 0px 0px 50px 0px;
}
.line {
	width: 60px;
	height: 1px;
	margin: 65px auto 0;
	border-bottom: 2px solid #88be2e;
}

.columna {
	float: left;
	line-height: 1.5;
	padding-right: 45px;
	padding-left: 45px;
}

.animacion {
	transform: scale(1.1);
}
.gris {
	background-image: linear-gradient(
		to right,
		rgb(136, 141, 155) 0%,
		rgb(135, 141, 156) 51%,
		rgb(226, 229, 236) 100%
	);
	color: white;
	border-radius: 4px 4px 0 0;
	font-size: 22px;
	text-align: center;
	font-family: "Roboto", sans-serif;
}
.verde {
	/*background: #10b425;*/
	background-image: linear-gradient(
		to right,
		#ff8008 0%,
		#ff8008 51%,
		#eac102 100%
	);
	color: white;
	border-radius: 5px 5px 0 0;
	font-size: 22px;
	text-align: center;
	font-family: "Roboto", sans-serif;
}

.claro {
	background-image: linear-gradient(
		to right,
		#851532 0%,
		#c73a71 51%,
		#f07f36 100%
	);
	color: white;
	border-radius: 5px 5px 0 0;
	font-size: 22px;
	text-align: center;
	font-family: "Roboto", sans-serif;
}
/* Style the list */
.price {
	list-style-type: none;
	-webkit-transition: 0.3s;
	transition: 0.3s;
	border-radius: 5px;
}

.fa {
	color: gray;
	position: relative;
}

/* Add shadows on hover */
.price:hover {
	box-shadow: 0 8px 12px 0 rgba(15, 15, 15, 0.2);
}
/* Pricing header */
.price .header {
	background-color: #111;
	color: white;
	font-size: 25px;
}
/* List items */

.price li {
	border-bottom: 1.5px solid #eee;
	padding: 17px;
}

.price .izq {
	margin: 5px 0px 5px 0px;
	text-align: left;
}
/* Grey list item */
.price .grey {
	background-color: rgb(252, 248, 248);
	font-size: 20px;
	text-align: center;
}
/* The "Sign Up" button */
.button {
	background-image: linear-gradient(
		to right,
		#88be2e 0%,
		rgb(143, 214, 110) 51%,
		#10b725 100%
	);
	transition: 0.5s;
	background-size: 200% auto;
	border: none;
	color: white;
	padding: 7px 15px;
	text-align: center;
	text-decoration: none;
	font-size: 15px;
	font-family: "Roboto", sans-serif;
	border-radius: 3px;
}

.button:hover {
	background-position: right center;
	color: rgb(243, 245, 245);
}
/* Change the width of the three columns to 100%
(to stack horizontally on small screens)*/
@media only screen and (max-width: 400px) {
	.columna {
		width: 100%;
		margin: 15px 15px 20px 15px;
	}
}
</style>
