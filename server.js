var http = require('http');
var fs = require('fs');

const PORT=8080;
// first run node server.js in terminal
// then navigate to http://localhost:8080/ in browwer 

fs.readFile('./index.html', function (err, html) {

    if (err) throw err;    

    http.createServer(function(request, response) {  
        response.writeHeader(200, {"Content-Type": "text/html"});  
        response.write(html);  
        response.end();  
    }).listen(PORT);
});