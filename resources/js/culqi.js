// Llave publica
/*
 * Test
 */
// Culqi.publicKey = "pk_test_yBO69zr5GMGC99uH";

/*
 * Produccion
 */
Culqi.publicKey = "pk_live_n18g0MOWb1ohz3mL";

Culqi.init();

// Generar token
$("#btn_pagar").on("click", function(e) {
	// Crea el objeto Token con Culqi JS
	Culqi.createToken();
	e.preventDefault();
});
