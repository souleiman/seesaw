package handler

import "time"

/**
 * Nullable items should use pointers
 */

type Profile struct {
	Id          int			`json:"id,string"`
	Username    string		`json:"username"`
	Level       int			`json:"level,string"`
	Last_seen   time.Time	`json:"last_seen"`
	Date_joined time.Time	`json:"date_joined"`
}

type Content struct {
	Id            int
	Profile_id    int
	Title         string
	Summary       string
	Description   string
	Image         *string
	Last_modified time.Time
	Date_created  time.Time
}

type Tag struct {
	Id         int
	Content_id int
	Tag        string
}

type Comment struct {
	Id            int
	Profile_id    int
	Content_id    int
	Post_number   int
	Comment       string
	Last_modified time.Time
	Date_created  time.Time
}
