<template>
    <section class="e14 container">
        <div class="col-lg-12">
                    <div class="titulo_seccion">
                        <h3 class="text-uppercase">paquetes de puntos</h3>
                        <h5>Elige el paquete que mas te convenga</h5>
                    </div>
                </div>
        <div id="carousel-puntos">
        <div class="card">
            <!--https://www.microsoft.com/es-ar/p/paquete-bronce-de-puntos-de-equipo/bnlj01wc3pg6?activetab=pivot:overviewtab -->
            <!--paquete de puntos 10, 25, 40 y 90-->
            <div class="row ">
              
                <div class="col-md-4">
                <img src="/img/empresa/empresa1/portada_enpresa.jpg" class="w-100">
            </div>
          <div class="e15 col-md-5 px-3">
            <div class="card-block px-3">
              <div><h4 class="card-title">Paquete de 10 puntos</h4></div>
              <div><p class="card-text">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p></div>           
            </div>
          </div>
          <div class="e15 col-md-3 px-3">
            <div class="c1 card-block">
               <div><h4 class="card-title">$ 20.00</h4></div>
               <div>
                 <a href="#" class="b1 btn btn-primary card-text">Comprar</a>
               </div>
               
            </div> 
           </div> 
        </div>
      </div>
      </div>
    </section>
</template>

<script>
export default {
  name:'puntos',
  props:['data_puntos'],
  mounted(){
    if(document.querySelector('#carousel-puntos')!==null){
      const slider_puntos=Tiny.tns({
        containe:'#carousel-puntos',
        nav:false,
        mouseDrag: true,

      })
    }
  }
}
</script>

<style>
  .e14{
    margin-bottom: 50px;
  }
 
  .e15 .card-block {
    margin-top: 35px; 
  }
  
 .comprar{
   float:right;

 }
 div>.b1{
   background-color: #0067b8;
   border-radius: 0px;
   width: 50%;
 }
 .c1{
   text-align: center;
 }
</style>