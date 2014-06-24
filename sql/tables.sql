CREATE TABLE IF NOT EXISTS PROFILE (
    id              SERIAL PRIMARY KEY,
    username        VARCHAR(32) NOT NULL UNIQUE,
    level           INT DEFAULT 0 CHECK (level >= 0),  -- Administrative level
    last_seen       DATE
);

CREATE TABLE IF NOT EXISTS CONTENT (
    id              SERIAL PRIMARY KEY,
    profile_id      INT REFERENCES PROFILE(id),
    title           VARCHAR(64) NOT NULL,
    objective       VARCHAR(160) NOT NULL,
    image           VARCHAR(255),
    last_modified   DATE,
    date_created    DATE
);

CREATE TABLE IF NOT EXISTS TAG (
    id              SERIAL PRIMARY KEY,
    content_id      INT REFERENCES CONTENT(id),
    tag             VARCHAR(32),
    count           INT DEFAULT 1
);
