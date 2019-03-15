var express = require('express');
var app = express();
var url = require('url');

app.set('port', (process.env.PORT || 8080));

app.use(express.static(__dirname + '/public'));

// views is directory for all template files
app.set('views', __dirname + '/views');
app.set('view engine', 'ejs');

app.get('/', function(req, res) {
  res.render('pages/index');
});

/*app.get('/home', function(req, res) {
    console.log("made it to home");
});

app.get('/getRate', function(req, res) {
  console.log("made it to getRate");
  calcRate(req, res);
});

app.listen(app.get('port'), function() {
  console.log('Listening on ', app.get('port'));
});
    
	var params = {mail: mail, weight: weight, price: price};
    
    res.render('pages/result', params);
    
}*/