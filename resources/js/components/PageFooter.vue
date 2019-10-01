<template>
  <section class="footer">
		<div class="container">
			<div class="row text-center text-xs-center text-sm-left text-md-left">
				<div class="col-xs-12 col-sm-4 col-md-4 text-md-center">
                    <img src="/img/logo/logo.png" alt="" class="img-fluid img-brand">
				</div>
                <div class="col-xs-12 col-sm-4 col-md-4" style="margin-top: 15px;">
					<h5 class="text-uppercase">Roundtable Perú</h5>
					<p style="color:#7e7e7e;">contacto@roundtableperu.com</p>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<ul class="list-unstyled quick-links">
						<li><a href="#"><i class="fa fa-angle-double-right"></i>Empresas</a></li>
						<li><a href="#"><i class="fa fa-angle-double-right"></i>Nosotros</a></li>
						<li><a href="#"><i class="fa fa-angle-double-right"></i>Términos y Condiciones</a></li>
						<li><a href="#"><i class="fa fa-angle-double-right"></i>Políticas de Seguridad</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5" style="margin-top: 2rem !important;">
					<ul class="list-unstyled list-inline social text-center">
						<li class="list-inline-item"><a href="https://www.facebook.com/roundtableperu/"><i class="fab fa-facebook-square"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-linkedin"></i></a></li>
						<li class="list-inline-item"><a href="#" target="_blank"><i class="fa fa-envelope"></i></a></li>
					</ul>
				</div>
				<hr/>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center">
					<p class="h6"><a class="text-green ml-2" href="/" target="_blank">©2018-2019 <span class="name-brand text-uppercase">Roundtable Perú</span> . Todos los derechos reservados</a></p>
				</div>
				<hr/>
			</div>
		</div>
	</section>
</template>

<script>
export default {

}
</script>

<style>
    .footer {
        background: #f4f4f4 !important;
        padding: 40px 0;
    }
    .footer h5{
        padding-left: 10px;
        border-left: 3px solid #88be2e;
        padding-bottom: 6px;
        margin-bottom: 20px;
        color:#7e7e7e;
    }
    .footer a {
        color: #7e7e7e;
        text-decoration: none !important;
        background-color: transparent;
        -webkit-text-decoration-skip: objects;
    }
    .footer ul.social li{
        padding: 3px 0;
    }
    .footer ul.social li a i {
        margin-right: 5px;
        font-size:25px;
        -webkit-transition: .5s all ease;
        -moz-transition: .5s all ease;
        transition: .5s all ease;
    }
    .footer ul.social li:hover a i {
        font-size:30px;
        margin-top:-10px;
        color:#88be2e;
    }
    .footer ul.social li a,
    .footer ul.quick-links li a{
        color:#7e7e7e;
    }
    .footer ul.social li a:hover,
    .footer ul.quick-links li a:hover{
        color:#88be2e;
    }
    .footer ul.quick-links li{
        padding: 3px 0;
        -webkit-transition: .5s all ease;
        -moz-transition: .5s all ease;
        transition: .5s all ease;
    }
    .footer ul.quick-links li:hover{
        padding: 3px 0;
        margin-left:5px;
        font-weight:700;
        color:#88be2e;
    }
    .footer ul.quick-links li a i{
        margin-right: 5px;
    }
    .footer ul.quick-links li:hover a i {
        font-weight: 700;
        color:#88be2e;
    }

    @media (max-width:767px){
        .footer h5 {
            padding-left: 0;
            border-left: transparent;
            padding-bottom: 0px;
            margin-bottom: 10px;
        }
    }
    .name-brand {
        color: #88be2e;
        font-weight: 600;
    }
    .img-brand {
        max-height: 200px;
		margin-top: 55px;
    }
</style>
