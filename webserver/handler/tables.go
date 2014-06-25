package handler

import "time"

/**
 * Nullable items should use pointers
 */

type Profile struct {
	Id          int
	Username    string
	Level       int
	Last_seen   time.Time
	Date_joined time.Time
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
