// Llave publica
Culqi.publicKey = 'pk_test_yBO69zr5GMGC99uH'
Culqi.init()

function culqi() {
    if (Culqi.token) { // ¡Objeto Token creado exitosamente!
        var token = Culqi.token.id;
        alert('Se ha creado un token:' + token)
        //En esta linea de codigo debemos enviar el "Culqi.token.id"
        //hacia tu servidor con Ajax
    } else {
        // Mostramos JSON de objeto error en consola
        console.log(Culqi.error)
        alert(Culqi.error.user_message)
    }
}

// Generar token
$('#btn_pagar').on('click', function(e) {
    // Crea el objeto Token con Culqi JS
    Culqi.createToken()
    e.preventDefault()
});
