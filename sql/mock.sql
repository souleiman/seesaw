-- Profiles
INSERT INTO PROFILE (username, last_seen, date_joined) VALUES ('Soul', '12-12-12', '12-12-12');
INSERT INTO PROFILE (username, last_seen, date_joined) VALUES ('Ty', '12-12-13', '12-12-13');
INSERT INTO PROFILE (username, last_seen, date_joined) VALUES ('Ankit', '12-12-13', '12-12-13');
INSERT INTO PROFILE (username, last_seen, date_joined) VALUES ('Abdullah', '12-12-14', '12-12-14');

-- Contents
INSERT INTO CONTENT (profile_id, title, summary, description, last_modified, date_created)
    VALUES (1, 'Title A', 'This is a summary', 'This is a description', '12-12-12', '12-12-12');
INSERT INTO CONTENT (profile_id, title, summary, description, last_modified, date_created)
    VALUES (2, 'Title B', 'This is a summary 2', 'This is a description 2', '12-12-12', '12-12-12');

-- Tags
INSERT INTO TAG (content_id, tag) VALUES (1, '#YOLO');
INSERT INTO TAG (content_id, tag) VALUES (1, '#SWAG');
INSERT INTO TAG (content_id, tag) VALUES (1, '#AgilexInterns');
INSERT INTO TAG (content_id, tag) VALUES (2, '#Sushi');

-- Comments
INSERT INTO COMMENT (profile_id, content_id, post_number, comment, last_modified, date_created)
    VALUES (2, 1, 1, 'This is a comment', '12-12-12', '12-12-12');
INSERT INTO COMMENT (profile_id, content_id, post_number, comment, last_modified, date_created)
    VALUES (4, 2, 1, 'This is a comment 2', '12-12-12', '12-12-12');