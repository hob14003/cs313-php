const express = require('express');
const app = express();


// Following the "Single query" approach from: https://node-postgres.com/features/pooling#single-query

const { Pool } = require("pg"); // This is the postgres database connection module.

// This says to use the connection string from the environment variable, if it is there,
// otherwise, it will use a connection string that refers to a local postgres DB
const connectionString = process.env.DATABASE_URL || "postgres://nechxmwfahplbu:ae293df502cdcda3bc915820af03cdb3209b2c21e88ed1ce752897ce93baab4d@ec2-107-20-185-27.compute-1.amazonaws.com:5432/d1ej482mabgne5";


//const connectionString = process.env.HEROKU_POSTGRESQL_NAVY_URL || 
"postgres://xbtnscppclodxq:7d52869b0a77e947dad6f86bb491b5d96933e78d64d9e55aad45ce3650ad55c7@ec2-54-83-17-151.compute-1.amazonaws.com:5432/dnvigannpu1g3";


// Establish a new connection to the data source specified the connection string.
const pool = new Pool({connectionString: connectionString});


app.set('port', (process.env.PORT || 5000));
app.use(express.static(__dirname + '/public'));

// This says that we want the function "getPerson" below to handle
// any requests that come to the /getPerson endpoint
app.get('/getPerson', getPerson);

// Start the server running
app.listen(app.get('port'), function() {
  console.log('Node app is running on port', app.get('port'));
});


// This function handles requests to the /getPerson endpoint
// it expects to have an id on the query string, such as: http://localhost:5000/getPerson?id=1
function getPerson(request, response) {
	// First get the person's id
	const id = request.query.id;

	// TODO: We should really check here for a valid id before continuing on...

	// use a helper function to query the DB, and provide a callback for when it's done
	getPersonFromDb(id, function(error, result) {
		// This is the callback function that will be called when the DB is done.
		// The job here is just to send it back.

		// Make sure we got a row with the person, then prepare JSON to send back
		if (error || result == null || result.length != 1) {
			response.status(500).json({success: false, data: error});
            console.log("test1");
		} else {
			const person = result[0];
			response.status(200).json(person);
            console.log("test2");
		}
	});
}

// This function gets a person from the DB.
// By separating this out from the handler above, we can keep our model
// logic (this function) separate from our controller logic (the getPerson function)
function getPersonFromDb(id, callback) {
	console.log("Getting person from DB with id: " + id);
    console.log("test3");

	// Set up the SQL that we will use for our query. Note that we can make
	// use of parameter placeholders just like with PHP's PDO.
	const sql = "SELECT id, first_name, last_name, dob FROM person WHERE id = 1";

	// We now set up an array of all the parameters we will pass to fill the
	// placeholder spots we left in the query.
	const params = [id];

	// This runs the query, and then calls the provided anonymous callback function
	// with the results.
	pool.query(sql, params, function(err, result) {
		// If an error occurred...
		if (err) {
            console.log("test4");
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

/*
const app = require('express');
const path = require('path');

// this works too
const connectionString = 'postgres://nechxmwfahplbu:ae293df502cdcda3bc915820af03cdb3209b2c21e88ed1ce752897ce93baab4d@ec2-107-20-185-27.compute-1.amazonaws.com:5432/d1ej482mabgne5?ssl=TRUE';

//postgres://xbtnscppclodxq:7d52869b0a77e947dad6f86bb491b5d96933e78d64d9e55aad45ce3650ad55c7@ec2-54-83-17-151.compute-1.amazonaws.com:5432/dnvigannpu1g3
//process.env.DATABASE_URL || 
// Finally pool works!
const { Pool } = require('pg');
const pool = new Pool({connectionString: connectionString});


app.set('port', (process.env.PORT || 5000));

app.get('/getPerson', getPerson);

app.listen(app.get('port'), function() {
  console.log('On Port', app.get('port'));
});


function getPerson(req, res) {
    const id = req.query.id;
    getPersonFromDb(id, function(error, result){
        if(error || result == null || result.length != 1) {
            res.status(500).json({success: false, data: error});
        } else {
            const person = result[0];
            response.status(200).json(person);
        }
    });
}

function getPersonFromDb(id, callback) {
	console.log("Getting person from DB with id: " + id);
	const sql = "SELECT id, first, last, birthdate FROM person WHERE id = $1::int";
	const params = [id];
	pool.query(sql, params, function(err, result) {
		// If an error occurred...
		if (err) {
			console.log("Error in query: ")
			console.log(err);
			callback(err, null);
		}

		console.log("Found result: " + JSON.stringify(result.rows));

		// (The first parameter is the error variable, so we will pass null.)
		callback(null, result.rows);
	});

}
/*
var sql = "SELECT * FROM person;";

pool.query(sql, function(err, result) {
    // If an error occurred...
    if (err) {
        console.log("Error in query: ")
        console.log(err);
    }

    // Log this to the console for debugging purposes.
    console.log("Back from DB with result:");
    console.log(result.);


});     


// express()
//   .use(express.static(path.join(__dirname, 'public')))
//   .set('views', path.join(__dirname, 'views'))
//   .set('view engine', 'ejs')
//   .get('/', (req, res) => res.render('pages/index'))

//   // for the database connections
//   .get('/users', function(req, res, next) {

//    pool.query(sql, function(err, result) {
//     // If an error occurred...
//     if (err) {
//         console.log("Error in query: ")
//         console.log(err);
//     }

//     // Log this to the console for debugging purposes.
//     console.log("Back from DB with result:");
//     console.log(result.rows);


//    });     

//  })


//   .listen(PORT, () => console.log(`Listening on ${ PORT }`))
*/