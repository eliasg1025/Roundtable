<template>
	<section class="c18 container" id="pagar">
		<div class="r16 row">
			<div class="col-50">
				<div class="c18 container">
					<div class="r16 row">
						<div class="col-50">
							<h3
								style="font-family: 'Nunito',sans-serif; font-weight:400; color: #56ab2f;"
							>
								Proceso de pago
							</h3>
							<label class="lab" for="fname"
								>Tarjetas aceptadas</label
							>

							<div class="icon-container">
								<img src="/img/tarjetas/visa.jpg" id="visa" />
								<img
									src="/img/tarjetas/mastercard.jpg"
									id="master"
								/>
								<img src="/img/tarjetas/amex.jpg" id="amex" />
								<img src="/img/tarjetas/dc.jpg" id="diner" />
							</div>

							<!-- Datos producto -->
							<input
								type="hidden"
								id="cproduct"
								v-model="data.product.slug"
							/>
							<input
								type="hidden"
								id="ctype"
								v-model="data.type"
							/>
							<!-- End -->

							<label class="lab" for="cruc">R.U.C.</label>
							<input
								class="in16"
								type="text"
								maxlength="30"
								id="cruc"
								name="cardruc"
								v-model="data.user.ruc"
								disabled
							/>

							<label class="lab" for="cname"
								>Nombre en la tarjeta</label
							>
							<input
								class="in16"
								type="text"
								maxlength="30"
								id="cname"
								name="cardname"
								v-model="cardname"
								placeholder="Ej: Pedro Pérez"
							/>

							<label class="lab" for="ccemail"
								>Correo Electrónico</label
							>
							<input
								class="in16"
								maxlength="50"
								type="email"
								v-model="cardemail"
								data-culqi="card[email]"
								id="ccemail"
								placeholder="Ej: empresa@email.com"
							/>

							<div class="r16 row">
								<div class="col-70">
									<label class="lab" for="ccnum"
										>Número de tarjeta</label
									>
									<input
										class="in16"
										maxlength="19"
										type="text"
										v-model="cardnumber"
										data-culqi="card[number]"
										id="ccnum"
										name="cardnumber"
										placeholder="Ej: 1111 2222 3333 4444"
									/>
								</div>
								<div class="col-30">
									<label class="lab" for="cvv">CVC</label>
									<input
										class="in16"
										v-model="cvc"
										:maxlength="cvv_size"
										type="text"
										data-culqi="card[cvv]"
										id="cvv"
										name="cvv"
										placeholder="Ej: 352"
										v-bind="{ disabled: mos }"
									/>
								</div>
							</div>

							<div class="r16 row">
								<div class="col-50">
									<label class="lab" for="expmonth"
										>Mes de expiración</label
									>
									<select
										class="in16"
										v-bind="{ disabled: mos }"
										data-culqi="card[exp_month]"
										v-model="expmes"
									>
										<option value="01">01</option>
										<option value="02">02</option>
										<option value="03">03</option>
										<option value="04">04</option>
										<option value="05">05</option>
										<option value="06">06</option>
										<option value="07">07</option>
										<option value="08">08</option>
										<option value="09">09</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
									</select>
								</div>
								<div class="col-50">
									<label class="lab" for="expyear"
										>Año de expiración</label
									>
									<select
										class="in16"
										v-bind="{ disabled: mos }"
										data-culqi="card[exp_year]"
										v-model="expano"
									>
										<option :value="currentYear">{{
											currentYear
										}}</option>
										<option :value="currentYear + 1">{{
											currentYear + 1
										}}</option>
										<option :value="currentYear + 2">{{
											currentYear + 2
										}}</option>
										<option :value="currentYear + 3">{{
											currentYear + 3
										}}</option>
										<option :value="currentYear + 4">{{
											currentYear + 4
										}}</option>
										<option :value="currentYear + 5">{{
											currentYear + 5
										}}</option>
										<option :value="currentYear + 6">{{
											currentYear + 6
										}}</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div>
						<button
							v-if="!loading"
							class="b16"
							type="button"
							@click="processPayment()"
						>
							Realizar pago
						</button>
						<button
							v-else
							class="b16-disabled"
							type="button"
							disabled
						>
							<i class="fas fa-spinner fa-spin"></i> Procesando
						</button>
					</div>
				</div>
			</div>
			<div class="col-25">
				<div class="c18 container">
					<h4 class="producto">
						Producto
						<span class="precio" style="color:#56ab2f">
							<i class="fa fa-shopping-bag"></i>
						</span>
					</h4>
					<p v-if="data.type == 'coin_packs'">
						<span href="#" class="parr1"
							>Paquete de
							{{ data.product.amount_coins }} puntos</span
						>
						<span class="precio">$ {{ data.product.cost }}</span
						><br />
						<i class="parr2">{{ data.product.description }}</i>
					</p>
					<p v-else>
						<span href="#" class="parr1"
							>Plan {{ data.product.name }}</span
						>
						<span class="precio">$ {{ data.product.cost }}</span
						><br /><i class="parr2">{{
							data.product.description
						}}</i>
					</p>
					<hr />
					<p>
						<b class="total1">Total</b>
						<span class="precio" style="color:black"
							><b class="total1"
								>$ {{ data.product.cost }}</b
							></span
						>
					</p>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
import Payform from "payform";
import store from "../store/index.js";

export default {
	name: "pago",
	props: ["pago", "data"],
	data() {
		return {
			cardname: "",
			cardnumber: "",
			cardemail: this.data.user.email,
			expmes: "",
			expano: "",
			cvc: "",
			mos: true,
			onlyNumber: "",
			cvv_size: "",
			reaPago: "",
			tarjetas: {
				visa: "",
				mastercard: "",
				imax: "",
				diner: ""
			},
			response: {},
			loading: false,
			currentYear: new Date().getFullYear()
		};
	},
	computed: {
		addbag() {
			return store.state.cart;
		}
	},
	mounted() {
		this.tarjetas.visa = $("#visa");
		this.tarjetas.imax = $("#amex");
		this.tarjetas.mastercard = $("#master");
		this.tarjetas.diner = $("#diner");
	},
	methods: {
		verifyForm() {
			let message = "";

			if (
				this.cardname == "" ||
				this.cardemail == "" ||
				this.cardnumber == "" ||
				this.expmes == "" ||
				this.expano == "" ||
				this.cvc == ""
			) {
				message = "Todos los campos son obligatorios";
			} else {
				if (this.cardname.length > 200) {
					message = "Nombre supera los 200 caracteres";
				} else if (
					isNaN(parseInt(this.cvc)) ||
					isNaN(parseInt(this.cardnumber))
				) {
					message = "Ingrese números donde corresponda";
				}
			}

			return message;
		},
		processPayment() {
			let verify = this.verifyForm();

			if (verify === "") {
				this.loading = true;
				Culqi.createToken();

				// Capturando los datos del producto
				const settings = {
					title: `${this.data.type} ${this.data.product.name}`,
					currency: "USD",
					description: `Compra: Tipo: ${this.data.type}, Producto: ${this.data.product.name} por ${this.data.product.cost} PEN`,
					amount: Math.ceil(this.data.product.cost)
				};

				Culqi.settings(settings);

				// Funcion de culqi
				window.culqi = function() {
					if (Culqi.token) {
						Swal.fire({
							title: "Procesando pago",
							onBeforeOpen: () => {
								Swal.showLoading();
							}
						});
						let token = Culqi.token;
						console.log("Se ha generado el token: " + token.id);

						axios
							.post("/pagos/process-payment", {
								token: token.id,
								email: token.email,
								cardholder: document.getElementById("cname")
									.value,
								ruc: document.getElementById("cruc").value,
								type: document.getElementById("ctype").value,
								product: document.getElementById("cproduct")
									.value
							})
							.then(res => {
								// console.log(res.data)
								Swal.fire({
									title: res.data.message,
									type: "success",
									text: res.data.text,
									timer: 2500,
									showConfirmButton: false
								}).then(res => {
									location.href = "/profile";
								});
							})
							.catch(err => {
								console.log(err.response);
								let message_error = JSON.parse(
									err.response.data.message
								);
								console.log(message_error);

								Swal.fire({
									title: "Error",
									text: message_error.user_message,
									type: "error"
								}).then(res => location.reload());
							});
					} else {
						// Mostramos JSON de objeto error en consola
						console.log(Culqi.error);
						console.log(Culqi.error.user_message);
					}
				};
				// End
			} else {
				Swal.fire({ title: verify, type: "warning" });
			}
		}
	},
	watch: {
		cardnumber: function(newValue) {
			this.cardnumber = Payform.formatCardNumber(newValue);
			//this.cardnumber = Payform(newValue);
			this.tarjetas.imax.removeClass("transparent");
			this.tarjetas.visa.removeClass("transparent");
			this.tarjetas.mastercard.removeClass("transparent");
			this.tarjetas.diner.removeClass("transparent");
			this.mos = true;

			if (Payform.parseCardType(newValue) == "visa") {
				this.tarjetas.mastercard.addClass("transparent");
				this.tarjetas.diner.addClass("transparent");
				this.tarjetas.imax.addClass("transparent");
				this.mos = false;
				this.cvv_size = 3;
			} else if (Payform.parseCardType(newValue) == "amex") {
				this.tarjetas.visa.addClass("transparent");
				this.tarjetas.mastercard.addClass("transparent");
				this.tarjetas.diner.addClass("transparent");
				this.mos = false;
				this.cvv_size = 4;
			} else if (Payform.parseCardType(newValue) == "mastercard") {
				this.tarjetas.visa.addClass("transparent");
				this.tarjetas.diner.addClass("transparent");
				this.tarjetas.imax.addClass("transparent");
				this.mos = false;
				this.cvv_size = 3;
			} else if (Payform.parseCardType(newValue) == "dinersclub") {
				this.tarjetas.visa.addClass("transparent");
				this.tarjetas.mastercard.addClass("transparent");
				this.tarjetas.imax.addClass("transparent");
				this.mos = false;
				this.cvv_size = 3;
			}
			/* if (newValue.length == 4 || newValue.length == 9 || newValue.length==14) {
				this.cardnumber = newValue + ' ';
				}*/
		},
		cvc: function(newValue) {
			/* this.cvc = window.event ? window.event.keyCode : e.which;
				if ((this.cvc == 8) || (this.cvc == 46))
				return true;

				return /\d/.test(String.fromCharCode(this.cvc));*/
		}
	}
};
</script>

<style>
.disabled {
	color: darkgray;
}
/* .r16 {
		display: -ms-flexbox; 
		display: flex;
		-ms-flex-wrap: wrap; 
		flex-wrap: wrap;
		margin: 0 -16px;
	}*/

.col-25 {
	-ms-flex: 25%; /* IE10 */
	flex: 25%;
}

.col-30 {
	-ms-flex: 30%;
	flex: 30%;
}

.col-50 {
	-ms-flex: 50%; /* IE10 */
	flex: 50%;
}

.col-75 {
	-ms-flex: 75%; /* IE10 */
	flex: 75%;
}

.col-70 {
	-ms-flex: 70%;
	flex: 70%;
}

.col-25,
.col-30,
.col-50,
.col-70,
.col-75 {
	padding: 0 16px;
}

.c18 {
	padding: 25px 20px 15px 20px;
	border: 1px solid lightgrey;
	border-radius: 3px;
	margin-top: 25px;
	margin-bottom: 25px;
}

.in16 {
	width: 100%;
	margin-bottom: 20px;
	padding: 12px;
	border: 1px solid #ccc;
	border-radius: 3px;
}
input[class="in16"]:focus {
	outline: 1px solid #70f36b;
	border-radius: 3px;
}

.lab {
	font-size: 17px;
	color: black;
	margin-bottom: 10px;
	display: block;
	font-family: "Nunito", sans-serif;
}

/*.grupo input:placeholder-shown ~ label{
		color:#999;
		font-weight: 400;
		
	}*/

.icon-container {
	margin-bottom: 20px;
	padding: 7px 0;
	font-size: 24px;
}

.b16 {
	background-image: linear-gradient(
		to right,
		#56ab2f 0%,
		#a8e063 51%,
		#56ab2f 100%
	);
	transition: 0.5s;
	background-size: 200% auto;
	border: none;
	color: white;
	padding: 8px 15px;
	text-align: center;
	text-decoration: none;
	font-size: 15px;
	font-family: "Nunito", sans-serif;
	border-radius: 3px;
	width: 100%;
}

.b16:hover {
	background-position: right center;
	color: rgb(231, 255, 255);
}

.b16-disabled {
	background-color: #56ab2f;
	color: white;
	border: none;
	padding: 8px 15px;
	text-align: center;
	text-decoration: none;
	font-size: 15px;
	font-family: "Nunito", sans-serif;
	border-radius: 3px;
	width: 100%;
}

span.precio {
	float: right;
	color: black;
	font-family: "Nunito", sans-serif;
	font-size: 20px;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
	.r16 {
		flex-direction: column-reverse;
	}
	.col-25,
	.col-30 {
		margin-bottom: 20px;
	}
}

.parr1 {
	font-family: "Nunito", sans-serif;
	color: black;
	font-size: 20px;
}
.parr2 {
	font-size: 17px;
	color: darkgray;
	margin: 2%;
}
.producto {
	color: #56ab2f;
	font-family: "Nunito", sans-serif;
}
.total1 {
	font-family: "Nunito", sans-serif;
	color: black;
	font-size: 23px;
}

.transparent {
	opacity: 0.2;
}
</style>
