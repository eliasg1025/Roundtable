<template>
	<section class="c18 container" id="pagar">
		<div class="r16 row">
			<div class="col-50">
				<div class="c18 container">
					<form >
						<div class="r16 row">
							<div class="col-50">
								<h3 style="font-family: 'Nunito',sans-serif; font-weight:400; color: #56ab2f;">Proceso de pago</h3>
								<label class="lab" for="fname">Tarjetas aceptadas</label>
								
								<div class="icon-container">
									<img src="/img/tarjetas/visa.jpg"  id="visa">
									<img src="/img/tarjetas/mastercard.jpg" id="master">
									<img src="/img/tarjetas/amex.jpg" id="amex">
									<img src="/img/tarjetas/dc.jpg" id="diner">
								</div>
								
								<label class="lab" for="cname">Nombre en la tarjeta</label>
								<input class="in16" type="text" maxlength="30" id="cname" name="cardname" placeholder="Pedro A. Pérez">                     

								<label class="lab" for="ccnum" >Número de tarjeta</label>
								<input class="in16" maxlength="19" type="text" v-model="cardnumber" id="ccnum" name="cardnumber" placeholder="1111 2222 3333 4444">
								
								<label class="lab" for="expmonth">Mes de expiración</label>
								<select class="in16" v-bind="{'disabled':mos}" v-model="expmes">
									<option value="01">Enero</option>
									<option value="02">Febrero </option>
									<option value="03">Marzo</option>
									<option value="04">Abril</option>
									<option value="05">Mayo</option>
									<option value="06">Junio</option>
									<option value="07">Julio</option>
									<option value="08">Agosto</option>
									<option value="09">Setiembre</option>
									<option value="10">Octubre</option>
									<option value="11">Noviembre</option>
									<option value="12">Diciembre</option>
								</select>
								<!--<input class="in16" maxlength="9" type="text" v-model="expmes" id="expmonth" name="expmonth" placeholder="September">-->
								<div class="r16 row">
									<div class="col-50">
										<label class="lab" for="expyear">Año de expiración</label>
										<input class="in16" type="text" id="expyear" v-model="expaño" maxlength="4" name="expyear" placeholder="2018" v-bind="{'disabled':mos}">
									</div>
									<div class="col-50">
										<label class="lab" for="cvv">CVC</label>
										<input class="in16"  v-model="cvc" :maxlength="cvv_size" type="text" id="cvv" name="cvv" placeholder="352" v-bind="{'disabled':mos}">
									</div>
								</div>
							</div>
						</div>
						<button class="b16"  type="submit" >Realizar pago</button>
					</form>
				</div>
			</div>
			<div class="col-25" >
				
				<div class="c18 container">
				<h4 class="producto">Producto
				<span class="precio" style="color:#56ab2f">
				<i class="fa fa-shopping-bag"></i>
				</span>
				</h4>
				<p v-if="data.type == 'coin_packs'"><span href="#" class="parr1">Paquete de {{data.product.amount_coins}} puntos</span> 
				<span class="precio">$ {{data.product.cost}}</span><br/> <i class="parr2">{{data.product.description}}</i> </p>
				<p v-else ><span href="#" class="parr1">Plan {{data.product.name}}</span> 
				<span class="precio">$ {{data.product.cost}}</span><br/><i class="parr2">{{data.product.description}}</i></p>

				<hr>
				<p ><b class="total1">Total</b> <span class="precio" style="color:black"><b class="total1">$ {{data.product.cost}}</b></span></p>
				</div>
			</div>
		</div>
	</section>
</template>

<script >
	import Payform from 'payform'
	import store from '../store/index.js'
	export default {
		name:'pago',
		props:['pago', 'data'], 
		data() {
			return  {
				cardname:'',
				cardnumber:'',
				expmes:'',
				expaño:'',
				cvc:'',
				mos:true,
				onlyNumber:'',
				cvv_size:'',
				reaPago:'',
				tarjetas :{
					visa:'',
					mastercard:'',
					imax :'',
					diner:'',
				},
				response: {}
			}
		},
		computed: {
			addbag() {
				return store.state.cart
			}
		},
		mounted() {
			this.tarjetas.visa=$('#visa');
			this.tarjetas.imax=$('#amex');
			this.tarjetas.mastercard=$('#master');
			this.tarjetas.diner=$('#diner');
		},
		methods :{
			/*sendForm(e) {

				e.preventDefault();

				if(this.cardname="" || this.cardnumber=="" || this.expmes=="" || this.expaño=="" || this.cvc=="")
				alert('Todos los campos son obligatorios')

				else 
				if(this.cardname.length>30)
				alert("Nombre supera los 30 caracteres");
				else
				if(isNaN(this.cvc) || isNaN(this.expaño) || isNaN(this.cardnumber)){
				alert("Ingrese números donde corresponda");

				}
			},*/
		},
		watch : {
			cardnumber : function( newValue) {
				this.cardnumber=Payform.formatCardNumber(newValue);
				//this.cardnumber = Payform(newValue);
				this.tarjetas.imax.removeClass('transparent');
				this.tarjetas.visa.removeClass('transparent');
				this.tarjetas.mastercard.removeClass('transparent');
				this.tarjetas.diner.removeClass('transparent');
				this.mos=true; 

				if (Payform.parseCardType(newValue) == 'visa') {

					this.tarjetas.mastercard.addClass('transparent');
					this.tarjetas.diner.addClass('transparent');
					this.tarjetas.imax.addClass('transparent');        
					this.mos=false; 
					this.cvv_size = 3 ;

				} else if (Payform.parseCardType(newValue) == 'amex') {
					this.tarjetas.visa.addClass('transparent');
					this.tarjetas.mastercard.addClass('transparent');
					this.tarjetas.diner.addClass('transparent');
					this.mos=false; 
					this.cvv_size = 4 ;

				} else if (Payform.parseCardType(newValue) == 'mastercard') {
					this.tarjetas.visa.addClass('transparent');
					this.tarjetas.diner.addClass('transparent');
					this.tarjetas.imax.addClass('transparent');
					this.mos=false; 
					this.cvv_size = 3 ;

				} else if (Payform.parseCardType(newValue) == 'dinersclub') {
					this.tarjetas.visa.addClass('transparent');
					this.tarjetas.mastercard.addClass('transparent');
					this.tarjetas.imax.addClass('transparent');
					this.mos=false; 
					this.cvv_size = 3 ;
				}
				/* if (newValue.length == 4 || newValue.length == 9 || newValue.length==14) {
				this.cardnumber = newValue + ' ';
				}*/
			},
			cvc: function (newValue) {
				/* this.cvc = window.event ? window.event.keyCode : e.which;
				if ((this.cvc == 8) || (this.cvc == 46))
				return true;

				return /\d/.test(String.fromCharCode(this.cvc));*/
			},
		}
	}
</script>

<style >
	.disabled{
		color:darkgray;
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

	.col-50 {
		-ms-flex: 50%; /* IE10 */
		flex: 50%;
	}

	.col-75 {
		-ms-flex: 75%; /* IE10 */
		flex: 75%;
	}

	.col-25,
	.col-50,
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
	input[class="in16"]:focus{
	  outline: 1px solid #70f36b;  
	  border-radius: 3px;
}

	.lab {
		font-size: 17px;
		color: black;
		margin-bottom: 10px;
		display: block;
		font-family: 'Nunito',sans-serif;
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
		background-image: linear-gradient(to right, #56ab2f 0%, #a8e063 51%, #56ab2f 100%);
		transition: 0.5s;
		background-size: 200% auto;
		border: none;
		color: white;
		padding: 8px 15px;
		text-align: center;
		text-decoration: none;
		font-size: 15px;
		font-family: 'Nunito',sans-serif;
		border-radius: 3px;
        width: 100%;
	}

	.b16:hover {
		background-position: right center;
		color:rgb(231, 255, 255);
	}

	span.precio {
		float: right;
		color:black;
		font-family: 'Nunito',sans-serif;
		font-size: 20px;

	}

	/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
	@media (max-width: 800px) {
		.r16 {
			flex-direction: column-reverse;
		}
		.col-25 {
			margin-bottom: 20px;
		}
	}

	.parr1{
		font-family: 'Nunito',sans-serif;
		color: black;
		font-size: 20px;
	}
	.parr2{
		font-size: 17px;
		color:darkgray;
		margin: 2%;
		
	}
	.producto{
		color: #56ab2f;
		font-family: 'Nunito',sans-serif;

	}
	.total1{
		font-family: 'Nunito',sans-serif;
		color: black;
		font-size: 23px;
	
	}

	.transparent {
		opacity: 0.2;
	}
</style>
