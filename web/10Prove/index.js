var express = require('express');
var app = express();
var url = require('url');
const { Pool } = require("pg"); // This is the postgres database connection module.
app.set('port', (process.env.PORT || 8080));

app.use(express.static(__dirname + '/public'));

const connectionString = process.env.DATABASE_URL || "postgres://qhvbaruwpovgpi:233ee1ddaa498b2f446b2d4d72a62ad4502b96d662417a81c2e1c30263e94234@ec2-75-101-133-29.compute-1.amazonaws.com:5432/da7gbku20f4le7";
      //"postgres://nechxmwfahplbu:ae293df502cdcda3bc915820af03cdb3209b2c21e88ed1ce752897ce93baab4d@ec2-107-20-185-27.compute-1.amazonaws.com:5432/d1ej482mabgne5";

// Establish a new connection to the data source specified the connection string.
const pool = new Pool({connectionString: connectionString});

// This says that we want the function "getPerson" below to handle
// any requests that come to the /getPerson endpoint
app.get('/getSeries', getSeries);


// views is directory for all template files
app.set('views', __dirname + '/views');
app.set('view engine', 'ejs');

app.get('/', function(req, res) {
  res.render('pages/index');
});

app.get('/home', function(req, res) {
    console.log("made it to home");
    var reqUrl = url.parse(req.url, true);
    var id = reqUrl.query.id;
    //https://github.com/vitaly-t/pg-promise/blob/master/examples/query.js
    
    const promise = require('bluebird'); // or any other Promise/A+ compatible library;
    const initOptions = {
        promiseLib: promise // overriding the default (ES6 Promise);
    };
    var pgp = require('pg-promise')(initOptions);
    var cn = {
        host: 'ec2-75-101-133-29.compute-1.amazonaws.com', // server name or IP address;
        port: 5432,
        database: 'da7gbku20f4le7',
        user: 'qhvbaruwpovgpi',
        password: '233ee1ddaa498b2f446b2d4d72a62ad4502b96d662417a81c2e1c30263e94234'
    };

    // alternative:
    // var cn = 'postgres://username:password@host:port/database';
    
    var db = pgp(cn); // database instance;

    // select and return user name from id:
    
    //db.any('SELECT * FROM book WHERE series_id = ' + id, 4)
    db.any('SELECT BOOK.ID, BOOK.BOOK_NUM, BOOK.NAME AS BOOK, BOOK.DESCRIPTION, SERIES.NAME AS SERIES FROM BOOK INNER JOIN SERIES ON BOOK.SERIES_ID=SERIES.ID WHERE SERIES.ID = ' + id, 4)

        .then(data => {
        console.log('DATA:', data); //print data
        console.log({'data': data}); //print data
        res.render('pages/sandersonBook', {'data': data});
    })
        .catch(error => {
        console.log(error); // print the error;
    })
    .finally(db.$pool.end);

});

app.get('/sanderson', function(req, res) {
    res.render('pages/sandersonBook');
});

app.get('/getRate', function(req, res) {
  console.log("made it to getRate");
  calcRate(req, res);
});

app.listen(app.get('port'), function() {
  console.log('Listening on ', app.get('port'));
});


function getSeries(req, res) {
	// First get the series' id
	//const id = req.query.id;
    const id = 1;
	// TODO: We should really check here for a valid id before continuing on...

	// use a helper function to query the DB, and provide a callback for when it's done
	getSeriesFromDb(id, function(error, result) {
		// This is the callback function that will be called when the DB is done.
		// The job here is just to send it back.

		// Make sure we got a row with the series, then prepare JSON to send back
		if (error || result == null || result.length != 1) {
			res.status(500).json({success: false, data: error});
		} else {
			const series = result[0];
			res.status(200).json(series);
		}
	});
}


function getSeriesFromDb(id, callback) {
	console.log("Getting series from DB with id: " + id);

	// Set up the SQL that we will use for our query. Note that we can make
	// use of parameter placeholders just like with PHP's PDO.
	const sql = "SELECT id, name FROM series WHERE id = 1"; //$1::int"; 

	// We now set up an array of all the parameters we will pass to fill the
	// placeholder spots we left in the query.
	const params = [id];

	// This runs the query, and then calls the provided anonymous callback function
	// with the results.
	pool.query(sql, params, function(err, result) {
		// If an error occurred...
		if (err) {
			console.log("Error in query: ")
			console.log(err);
			callback(err, null);
		}

		// Log this to the console for debugging purposes.
		console.log("Found result: " + JSON.stringify(result.rows));


		// When someone else called this function, they supplied the function
		// they wanted called when we were all done. Call that function now
		// and pass it the results.

		// (The first parameter is the error variable, so we will pass null.)
		callback(null, result.rows);
	});

} // end of getPersonFromDb













function calcRate(req, res) {
    var reqUrl = url.parse(req.url, true);
    var mail = reqUrl.query.mail;
    var weight = Number(reqUrl.query.weight);
    
    var price = "";
    
    switch(mail) {
        case 'stamp':
            mail = "Stamped Letter"
             if(weight <= 1.0){
                 price = "$0.55";
             } else if(weight <= 2.0){
                 price = "$0.70";
             } else if(weight <= 3.0){
                 price = "$0.85";
             } else if(weight <= 3.5){
                 price = "$1.00";
             } else {
                  price = "The price must be negociated at the counter.";
             }
            break;
        case 'meter':
            mail = "Metered Letter"
            if(weight <= 1.0){
                 price = "$0.55";
             } else if(weight <= 2.0){
                 price = "$0.65";
             } else if(weight <= 3.0){
                 price = "$0.80";
             } else if(weight <= 3.5){
                 price = "$0.95";
             } else {
                  price = "The price must be negociated at the counter.";
             }
            break;
        case 'flat':
            mail = "Large Envelop"
            if(weight <= 1.0){
                 price = "$1.00";
             } else if(weight <= 2.0){
                 price = "$1.15";
             } else if(weight <= 3.0){
                 price = "$1.30";
             } else if(weight <= 4.0){
                 price = "$1.45";
             } else if(weight <= 5.0){
                 price = "$1.60";
             } else if(weight <= 6.0){
                 price = "$1.75";
             } else if(weight <= 7.0){
                 price = "$1.90";
             } else if(weight <= 8.0){
                 price = "$2.05";
             } else if(weight <= 9.0){
                 price = "$2.20";
             } else if(weight <= 10.0){
                 price = "$2.35";
             } else if(weight <= 11.0){
                 price = "$2.50";
             } else if(weight <= 12.0){
                 price = "$2.65";
             } else if(weight <= 13.0){
                 price = "$2.80";
             } else {
                  price = "The price must be negociated at the counter.";
             }
            break;
        case 'fclass':
            mail = "Package Service"
            if(weight <= 4.0){
                 price = "$3.66";
             } else if(weight <= 8.0){
                 price = "$1.15";
             } else if(weight <= 12.0){
                 price = "$1.30";
             } else if(weight <= 13.0){
                 price = "$1.45";
             } else {
                  price = "The price must be negociated at the counter.";
             }
            break;
        default:
            price = "The price must be negociated at the counter.";
            console.log("Broken switch statement 001. Mail = " + mail);
    }
    
	var params = {mail: mail, weight: weight, price: price};
    
    res.render('pages/result', params);
    
}



/*const express = require('express')
const path = require('path')
const PORT = process.env.PORT || 8080
var app = express();
var url = require('url')

app
  .use(express.static(__dirname, 'public'))
  .set('views', __dirname, 'views')
  .set('view engine', 'ejs')
  .get('/', (req, res) => res.render('form'));
  

app.get('/getRate', function(req, res) {
    console.log("entered getRate")
    calcRate(req, res);
});


app.listen(PORT, () => console.log(`Listening on ${ PORT }`))

*/
/*
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

app.get('/home', function(req, res) {
    console.log("made it to home");
});

app.get('/getRate', function(req, res) {
  console.log("made it to getRate");
  calcRate(req, res);
});

app.listen(app.get('port'), function() {
  console.log('Listening on ', app.get('port'));
});


function calcRate(req, res) {
    var reqUrl = url.parse(req.url, true);
    var mail = reqUrl.query.mail;
    var weight = Number(reqUrl.query.weight);
    
    var price = "";
    
    switch(mail) {
        case 'stamp':
            mail = "Stamped Letter"
             if(weight <= 1.0){
                 price = "$0.55";
             } else if(weight <= 2.0){
                 price = "$0.70";
             } else if(weight <= 3.0){
                 price = "$0.85";
             } else if(weight <= 3.5){
                 price = "$1.00";
             } else {
                  price = "The price must be negociated at the counter.";
             }
            break;
        case 'meter':
            mail = "Metered Letter"
            if(weight <= 1.0){
                 price = "$0.55";
             } else if(weight <= 2.0){
                 price = "$0.65";
             } else if(weight <= 3.0){
                 price = "$0.80";
             } else if(weight <= 3.5){
                 price = "$0.95";
             } else {
                  price = "The price must be negociated at the counter.";
             }
            break;
        case 'flat':
            mail = "Large Envelop"
            if(weight <= 1.0){
                 price = "$1.00";
             } else if(weight <= 2.0){
                 price = "$1.15";
             } else if(weight <= 3.0){
                 price = "$1.30";
             } else if(weight <= 4.0){
                 price = "$1.45";
             } else if(weight <= 5.0){
                 price = "$1.60";
             } else if(weight <= 6.0){
                 price = "$1.75";
             } else if(weight <= 7.0){
                 price = "$1.90";
             } else if(weight <= 8.0){
                 price = "$2.05";
             } else if(weight <= 9.0){
                 price = "$2.20";
             } else if(weight <= 10.0){
                 price = "$2.35";
             } else if(weight <= 11.0){
                 price = "$2.50";
             } else if(weight <= 12.0){
                 price = "$2.65";
             } else if(weight <= 13.0){
                 price = "$2.80";
             } else {
                  price = "The price must be negociated at the counter.";
             }
            break;
        case 'fclass':
            mail = "Package Service"
            if(weight <= 4.0){
                 price = "$3.66";
             } else if(weight <= 8.0){
                 price = "$1.15";
             } else if(weight <= 12.0){
                 price = "$1.30";
             } else if(weight <= 13.0){
                 price = "$1.45";
             } else {
                  price = "The price must be negociated at the counter.";
             }
            break;
        default:
            price = "The price must be negociated at the counter.";
            console.log("Broken switch statement 001. Mail = " + mail);
    }
    
	var params = {mail: mail, weight: weight, price: price};
    
    res.render('pages/result', params);
    
}

/*

// load the things we need
var express = require('express');
var app = express();

app.set("views", "views");

// set the view engine to ejs
app.set('view engine', 'ejs');

// use res.render to load up an ejs view file
app.use(express.static('public'));
app.use(express.static('pages'));
app.use(express.static('pages/math'));


app.use(express.static(path.join(__dirname, 'views')))

// index page 
app.get('/', function(req, res) {
	console.log("Received a request for /");
    res.render('pages/index');    
});

// test
app.get('/home', function(req, res) {
    //controller
    console.log("Received a request for the home page");
    var name = getName();
    var emailAddress = "nunya@bidnes.com"
    var params = {username: name, email: emailAddress};
    res.render("home", params);
    
});

app.listen(8080, function() {
    console.log('8080 is the magic port');
});

function renderHomePage(name, res) {
    //View
    res.write("<html><head><title>Home</title></head>");
    res.write("<body><h1>Testing</h1><h2>Welcome " + name +"</h2></body></html>");
	res.write("this is the root");
    res.end();
}

//Model
function getName() {
    return "John";
}
*/