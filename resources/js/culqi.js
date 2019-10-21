// Llave publica
Culqi.publicKey = 'pk_test_yBO69zr5GMGC99uH'
Culqi.init()

// Generar token
$('#btn_pagar').on('click', function(e) {
    // Crea el objeto Token con Culqi JS
    Culqi.createToken()
    e.preventDefault()
});
