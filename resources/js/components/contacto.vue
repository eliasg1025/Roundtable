<template>
    <section class="container">
        <div class="row">
            <div class="e12 col-sm-6">
                    <div>
                        <div>
                            <div class="ca">
                                 <h4 class="cabeza">Contacto</h4>
                             </div>
                             <div class="cuerpo">
                                 <div style="margin-left:10px;"><span class="emo fa fa-map-marker"></span> </div>
                                 <div class="parrafo"><p>Lun - Vie: 8:00am - 5:00pm <br/>Sab: 8:00am - 12:00pm</p></div>
                             </div>    
                             <div class="cuerpo">
                                 <div style="margin-left:10px;"><span class="emo fa fa-mobile"></span> </div>
                                 <div class="parrafo"><p>(+51) 987 785 052</p></div>
                             </div>
                             <div class="cuerpo">
                                  <div><span class="emo fa fa-envelope-o"></span> </div>
                                 <div class="parrafo"><p>informes@roundtableperu.com</p></div>
                             </div>
                            

                        </div>
                    </div>
            </div>
            <div class="e12 col-sm-6">
                <div>
                    <div class="ce">
                        <h4 class="cabeza">Formulario de contacto</h4>
                    </div>
                    <div class="cuerpo">
                        <form action="">
                           <ul class="lista">
                               <li class="lis">
                                   <label for="">Nombres<span>*</span></label>
                                   <div class="caja">
                                       <div style="display:inline-block; padding-right:16px;">
                                           <input type="text" placeholder=" Nombres">
                                       </div>
                                       <div  style="display:inline-block; ">
                                           <input type="text" placeholder=" Apellidos">
                                       </div>
                                   </div>
                               </li>
                               <li class="lis">
                                   <label  for="">Correo electrónico<span>*</span></label>
                                   <div class="caja" >
                                       <input type="text" style="width:100%;">
                                   </div>
                               </li>
                               <li class="lis">
                                   <label for="">Tu mensaje</label>
                                   <div class="caja">
                                       <textarea style="resize:none; width:100%;" name="" id="" rows="8"></textarea>
                                   </div>
                               </li>
                            </ul> 
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
        
</template>
<script>
    export default{
		name:'contacto',
		props: ['data'],
		data() {
			
		}
	}
</script>
<style >

.e12{
    margin-top: -100px;
    width:50%;
    padding-left: 0px;
    padding-right: 0px;
   
}
.ca .cabeza{
    color: #ffffff;
    background-color: #ce1b28!important;
    margin-bottom: 40px;
    padding-top: 130px!important;
    padding-bottom: 20px!important;
    padding-left: 20px!important;
    padding-right: 20px!important;
}
.ce .cabeza{
    color: #ffffff!important;
    background-color: #000000!important;
    margin-bottom: 40px!important;
    padding-top: 130px!important;
    padding-bottom: 20px!important;
    padding-left: 20px!important;
    padding-right: 20px!important;
}
.cabeza{
    position: relative;
    display: inline-block;
    width: auto;
    text-decoration: none;
}
.emo{
    float:left;
    font-size: 2.4em;
    color: #ce1b28;
    
}

.cuerpo{
    color:#10b725;
    margin-top: 10px;
    font-size: 16px;
}
.parrafo{
    margin-left: 60px;
    margin-bottom: 40px;
    font-family: 'Roboto',sans-serif;
    /*font-style: normal;*/
}
.lista{
    list-style-type: none;
}
.caja{
    margin-top:4px;
    border-color: #e8e8e8;
   /* width: 100%;*/
}
.lis{
    margin-top: 16px;
    padding-right: 16px;
}
.lis>label{
    font-family: 'Roboto',sans-serif;
    /*font-size: normal;*/
}
.lis label>span{
    color: #ce1b28;
    font-size: 1.3em;
}
.caja>input{
    /*width: 100%;*/
    height: 2.8em;
}
.caja>div>input{
    margin-top:4px;
    border-color: #7777;
    height: 2.8em;
    width:266px;
    border-style: solid;
    padding:7px 7px 7px 7px;
    border-width: 2px;
}
::-webkit-input-placeholder { color: #7777; }

</style>