package handler

import (
	"net/http"
	"fmt"
	"encoding/json"
	"encoding/base64"
	"net/url"

	"github.com/coopernurse/gorp"
)

type RestHelper func([]string, http.ResponseWriter, *http.Request, *gorp.DbMap)

func RestProfile(rest []string, w http.ResponseWriter, r *http.Request, dbmap *gorp.DbMap) {
	var profiles []Profile
	var sql_query string

	switch rest[FIELD_INDEX] {
	case "id", "level":
		sql_query = fmt.Sprintf("SELECT * FROM PROFILE WHERE %s = %s", rest[FIELD_INDEX], rest[VALUE_INDEX])
	case "username":
		sql_query = fmt.Sprintf("SELECT * FROM PROFILE WHERE %s = '%s'", rest[FIELD_INDEX], rest[VALUE_INDEX])
	default:
		http.Error(w, http.StatusText(http.StatusNotAcceptable), http.StatusNotAcceptable)
		return
	}

	if _, err := dbmap.Select(&profiles, sql_query); err != nil {
		http.Error(w, fmt.Sprintf("%v", err), http.StatusConflict)
		return
	}

	var iface interface {} = profiles //Determines if we need to create an Array of JSON or Single
	if len(profiles) == 1 {
		iface = profiles[0]
	}

	json, _ := json.MarshalIndent(iface, "", "\t")
	qMap, _ := url.ParseQuery(r.URL.RawQuery)

	var output string = string(json)
	if encode := qMap["encode"]; encode != nil && encode[0] == "true" {
		output = base64.StdEncoding.EncodeToString(json)
	}
	fmt.Fprintf(w, "%v\n", output)
}


