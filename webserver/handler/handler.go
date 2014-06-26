package handler

import (
	"database/sql"
	"fmt"
	"net/http"
	"strings"

	"github.com/coopernurse/gorp"
)

const (
	API_SIZE = 4
	API_INDEX = 0
	DB_INDEX = 1
	FIELD_INDEX = 2
	VALUE_INDEX = 3
)

type HandleHelper func(http.ResponseWriter, *http.Request)
var api_map map[string] RestHelper

func init() {
	api_map = make(map[string] RestHelper)
	api_map["profile"] = RestProfile
}

func Root(db *sql.DB) HandleHelper {
	maps := make(map[string]string)
	return func(w http.ResponseWriter, r *http.Request) {
		fmt.Fprintf(w, maps["Test"])
	}
}

func Api(db *sql.DB) HandleHelper {
	dbmap := &gorp.DbMap{Db: db}

	return func(w http.ResponseWriter, r *http.Request) {
		path_len := len(r.URL.Path)
		split := strings.Split(r.URL.Path[1: path_len - 1], "/")

		if rest := api_map[split[DB_INDEX]]; len(split) == API_SIZE && rest != nil {
			rest(split, w, r, dbmap)
		} else {
			http.Error(w, http.StatusText(http.StatusNotAcceptable), http.StatusNotAcceptable)
			return
		}
	}
}
