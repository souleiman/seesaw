package handler

import (
	"database/sql"
	"fmt"
	"net/http"

	"github.com/coopernurse/gorp"
)

type handle_helper func(w http.ResponseWriter, r *http.Request)

func Root(db *sql.DB) handle_helper {
	maps := make(map[string]string)
	return func(w http.ResponseWriter, r *http.Request) {
		fmt.Fprintf(w, maps["Test"])
	}
}

func Api(db *sql.DB) handle_helper {
	dbmap := &gorp.DbMap{Db: db}

	return func(w http.ResponseWriter, r *http.Request) {
		var profiles []Profile
		var contents []Content
		var tags []Tag
		var comments []Comment

		dbmap.Select(&profiles, "SELECT * FROM PROFILE")
		dbmap.Select(&contents, "SELECT * FROM CONTENT")
		dbmap.Select(&tags, "SELECT * FROM TAG")
		dbmap.Select(&comments, "SELECT * FROM COMMENT")

		fmt.Fprintln(w, "Users")
		for x, p := range profiles {
			fmt.Fprintf(w, "%d: %v\n", x, p)
		}

		fmt.Fprintln(w, "Contents")
		for x, c := range contents {
			fmt.Fprintf(w, "%d: %v\n", x, c)
		}

		fmt.Fprintln(w, "Tags")
		for x, t := range tags {
			fmt.Fprintf(w, "%d: %v\n", x, t)
		}

		fmt.Fprintln(w, "Comments")
		for x, c := range comments {
			fmt.Fprintf(w, "%d: %v\n", x, c)
		}
	}
}
