var http = require('http');
var url = require('url');
var events = require('events');
var nodemailer = require('nodemailer');

//Feel free to log into this email to verify that it works.
var transporter = nodemailer.createTransport({
  service: 'gmail',
  auth: {
    user: 'testingmyautoemail@gmail.com',
    pass: 'QWer1234'
  }
});

var mailOptions = {
  from: 'testingmyautoemail@gmail.com',
  to: 'testingmyautoemail@gmail.com',
  subject: 'Sending Email using Node.js to a dummy account',
  text: 'Error: You just got a 404 error from my hello world project'
};

var onRequest = function (path, req, res){
    if (path == '/home') {
        res.writeHead(404, {"Content-Type": "text/html"});
        res.write("<h1>Welcome to the Home Page</h1>");
        res.end();
    } else if (path == '/getData') {
        res.writeHead(200, {"Content-Type": "application/json"});
        res.write('{"name":"Harlen Hobbs","class":"CS313"}');
        res.end();
    } else {
        res.writeHead(404, {"Content-Type": "text/html"});
        res.write("<h1>404: Page Not Found</h1>");
        res.end();
        
        transporter.sendMail(mailOptions, function(error, info){
            if (error) {
                console.log(error);
            } else {
                console.log('Email sent: ' + info.response);
            }
        });
    }    
}
   
http.createServer(function (req, res) {
    var path = url.parse(req.url).pathname; 
    onRequest(path, req, res);

}).listen(8888);

