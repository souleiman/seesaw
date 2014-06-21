package main

import (
	"flag"
	"fmt"
	"net/http"
	"text/template"
)

type Flags struct {
	Port      int
	Root, Api string
}

func (f *Flags) initialize() {
	flag.IntVar(&f.Port, "p", 8080, "Port to listen to")
	flag.StringVar(&f.Root, "r", "/", "Root of the fileserver")
	flag.StringVar(&f.Api, "R", "/api/", "RESTful API Services")
	flag.Parse()
}

func main() {
	var flags Flags
	flags.initialize()

	http.HandleFunc(flags.Root,
		func(w http.ResponseWriter, r *http.Request) {
			fmt.Fprintln(w, r.URL.Path)
		})

	http.HandleFunc(flags.Api,
		func(w http.ResponseWriter, r *http.Request) {
			t := template.New("template")
			t, _ = t.Parse("{" +
				"\"port\"=\"{{.Port}}\"," +
				"\"root\"=\"{{.Root}}\"," +
				"\"api\"=\"{{.Api}}\"" +
				"}")
			t.Execute(w, flags)
		})

	http.ListenAndServe(fmt.Sprintf("localhost:%d", flags.Port), nil)
}
