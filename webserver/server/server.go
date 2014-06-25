package main

import (
	"flag"
	"fmt"
	"net/http"
	"database/sql"
	
	"github.com/souleiman/seesaw/webserver/handler"
	_ "github.com/lib/pq"
)

func main() {
	port := flag.Int("p", 8080, "Port to listen to")
	root := flag.String("r", "/", "Root of the fileserver")
	api := flag.String("R", "/api/", "RESTful API Services")
	dbuser := flag.String("U", "", "User for database")
	dbname := flag.String("D", "", "Database to use")
	flag.Parse()


	db, _ := sql.Open("postgres", fmt.Sprintf("user=%s dbname=%s sslmode=disable", *dbuser, *dbname))
	defer db.Close()

	http.HandleFunc(*root, handler.Root(db))
	http.HandleFunc(*api, handler.Api(db))

	http.ListenAndServe(fmt.Sprintf(":%d", *port), nil)
}
