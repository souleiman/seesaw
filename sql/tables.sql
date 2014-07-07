CREATE TABLE IF NOT EXISTS PROFILE (
    id              SERIAL PRIMARY KEY,
    username        VARCHAR(32) NOT NULL UNIQUE,
    level           INT DEFAULT 0 CHECK (level >= 0),  -- Administrative level
    last_seen       DATE NOT NULL,
    date_joined     DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS CONTENT (
    id              SERIAL PRIMARY KEY,
    author          VARCHAR(32) REFERENCES PROFILE(username),
    title           VARCHAR(64) NOT NULL,
    summary         VARCHAR(160) NOT NULL,
    description     VARCHAR(512) NOT NULL,
    image           VARCHAR(255),
    last_modified   DATE NOT NULL,
    date_created    DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS TAG (
    id              SERIAL PRIMARY KEY,
    content_id      INT REFERENCES CONTENT(id),
    tag             VARCHAR(32) NOT NULL
);

CREATE TABLE IF NOT EXISTS COMMENT (
    id              SERIAL PRIMARY KEY,
    username        VARCHAR(32) REFERENCES PROFILE(username),
    content_id      INT REFERENCES CONTENT(id),
    post_number     INT DEFAULT 1,
    comment         VARCHAR(160),
    last_modified   DATE NOT NULL,
    date_created    DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS CHARGE (
    id              SERIAL PRIMARY KEY,
    content_id      INT REFERENCES CONTENT(id),
    username        VARCHAR (32) REFERENCES PROFILE(username),
    charged         BOOLEAN DEFAULT FALSE
)