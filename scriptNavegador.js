var page = require('webpage').create();
var system = require('system');
var width=1280;
var height=1024;
page.viewportSize = {width: width, height: height};
page.paperSize={
    format: 'letter',
    orientation: 'portrait',
    margin: '2cm',
    headerStr:{left:'', center:'&T', right:''},
    footerStr:{left:'', center:'', right:'&P de &L'}
}
output = system.args[1];
page.open( 'http://localhost:8001/export.php?peticion=si', function( status ) {
    console.log( "Status: " + status );
    if ( status === "success" ) {
        // Se espera como 1 segundo a que la pagina cargue todas sus weas internas de javascript
        setTimeout( function() {
            page.render( output );
            phantom.exit();
        },1000);
    }
    else { phantom.exit(); }
});
