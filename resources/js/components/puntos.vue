<template>
    <section class="container e14">
        <div class="col-lg-12">
                    <div class="titulo_seccion">
                        <h3 class="text-uppercase">paquetes de puntos</h3>
                        <h5>Elige el paquete que mas te convenga</h5>
                    </div>
                </div>
        <div id="demo" class="carousel slide" data-ride="carousel">

     <!-- Indicators -->
        <ul class="carousel-indicators">
          <li data-target="#demo" data-slide-to="0" class="active"></li>
          <li data-target="#demo" data-slide-to="1"></li>
          <li data-target="#demo" data-slide-to="2"></li>
          <li data-target="#demo" data-slide-to="3"></li>
          </ul>
  
       <!-- The slideshow -->
       

          <div class="carousel-inner"  v-for="(pack_data,index) in pack_data" :key="index">
            <div class="carousel-item active">
               <div class="card" >
            <!-- https://www.microsoft.com/es-ar/p/paquete-bronce-de-puntos-de-equipo/bnlj01wc3pg6?activetab=pivot:overviewtab -->
            <!--paquete de puntos 10, 25, 40 y 90-->
            <div class="row ">
              
                <div class="col-md-4">
                <img src="/img/tabla-precio/monedi.jpg" class="w-100">
            </div>
          <div class="e15 col-md-5 px-3">
            <div class="card-block px-3">
              <div><h4 class="card-title">{{pack_data.packs.name}}</h4></div>
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
            <!--<div class="carousel-item">
                 <div class="card">
             https://www.microsoft.com/es-ar/p/paquete-bronce-de-puntos-de-equipo/bnlj01wc3pg6?activetab=pivot:overviewtab 
            paquete de puntos 10, 25, 40 y 90
            <div class="row ">
              
                <div class="col-md-4">
                <img src="/img/tabla-precio/monedi.jpg" class="w-100">
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
               </div>-->
            <!-- <div class="carousel-item">
               <div class="card">
            <div class="row ">
              
                <div class="col-md-4">
                <img src="/img/tabla-precio/monedi.jpg" class="w-100">
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
                </div>-->
                <!--<div class="carousel-item">
                <div class="card">
            
            <div class="row ">
              
                <div class="col-md-4">
                <img src="/img/tabla-precio/monedi.jpg" class="w-100">
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
                </div>-->
            </div>
  
          <!-- Left and right controls 
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
             <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
              <span class="carousel-control-next-icon"></span>
            </a>-->

            
        
      </div>
    </section>
</template>

<script>
export default {
  name:'puntos',
  props:['pack_data'],
  mounted(){
    
  }
}
</script>

<style>
  .e14{
    margin-bottom: 50px;
  }
.carousel-indicators li{
  background-color: darkgray;
} 
.carousel-indicators .active{
  background-color: black;
}
.carousel{
  box-shadow: 0 8px 12px 0 rgba(15, 15, 15, 0.2)
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