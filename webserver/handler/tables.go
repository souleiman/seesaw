package handler

import "time"

/**
 * Nullable items should use pointers
 */

type Profile struct {
	Id          int			`json:"id"`
	Username    string		`json:"username"`
	Level       int			`json:"level"`
	Last_seen   time.Time	`json:"last_seen"`
	Date_joined time.Time	`json:"date_joined"`
}

type Content struct {
	Id            int		`json:"id"`
	Author		  string	`json:"author"`
	Title         string	`json:"title"`
	Summary       string	`json:"summary"`
	Description   string	`json:"description"`
	Comments	  []Comment	`json:"comments",db:"-"`
	Tags		  []Tag		`json:"tags",db:"-"`
	Charges		  int		`json:"charges",db:"-"`
	Image         *string	`json:"image"`
	Last_modified time.Time	`json:"last_modfied"`
	Date_created  time.Time	`json:"date_created"`
}

type Tag struct {
	Id         int			`json:"id"`
	Content_id int			`json:"content_id"`
	Tag        string		`json:"tag"`
}

type Comment struct {
	Id            int		`json:"id"`
	Username	  string	`json:"username"`
	Content_id    int		`json:"content_id"`
	Post_number   int		`json:"post_number"`
	Comment       string	`json:"comment"`
	Last_modified time.Time	`json:"last_modified"`
	Date_created  time.Time	`json:"date_created"`
}

type Charge struct {
	Id         	int			`json:"id"`
	Content_id 	int			`json:"content_id"`
	Username	string		`json:"username"`
	Charged     bool		`json:"charged"`
}
