var http = require('http');
var url = require('url');
var mysql = require('mysql');
var qs = require('querystring');

var connection = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "mountain",
    database: "imagine"
});

http.createServer(function (request, response) {
	var pathname = url.parse(request.url).pathname;
	var parameter = pathname.split("/");
	
	console.log(parameter);
    if (parameter[1] == "compose" && parameter.length == 2 && request.method == 'POST') {
        var body = '';
        request.on('data', function (data) {
            body += data;

            // Too much POST data, kill the connection! Thank you stack overflow: http://stackoverflow.com/questions/4295782/how-do-you-extract-post-data-in-node-js
            if (body.length > 1e6)
                req.connection.destroy();
        });
        request.on('end', function () {
            var post = qs.parse(body);
			var theQuery = "INSERT INTO content (title, summary, description, username, last_modified, date_created) VALUES ('"+post['title']+"', '"+post['summary']+"', '"+post['description']+"', '"+post['username']+"', '12-12-12', '12-12-12')";
			connection.query(theQuery, function (error, rows, fields) {
				if (error) {
					console.log(error);
					response.writeHead(200, {
						'Access-Control-Allow-Origin': '*',
						'Content-Type': 'text/plain'
					});
					response.write(JSON.stringify(error));
					response.end();
				}
			});
			console.log(post);
        });
    }
	else if (parameter[1] == "newfeed" && parameter.length == 2 && request.method == 'POST') {
		connection.query('SELECT * FROM content ORDER BY id DESC', function (error, rows, fields) {
			response.writeHead(200, {
				'Access-Control-Allow-Origin': '*',
				'Content-Type': 'text/plain'
			});
			response.write(JSON.stringify(rows));
			response.end();
		});	
	}
}).listen(1110, 'localhost');