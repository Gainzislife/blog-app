/**
 * Database creation script
 */
DROP DATABASE IF EXISTS blog;
CREATE DATABASE blog;
USE blog;

CREATE TABLE post(
    id INT AUTO_INCREMENT NOT NULL,
    title VARCHAR(255) NOT NULL,
    body VARCHAR(1000) NOT NULL,
    user_id INT NOT NULL,
    created_at VARCHAR(50) NOT NULL,
    updated_at VARCHAR(50),
    PRIMARY KEY(id)
);

-- create post table
INSERT INTO post(
    title,
    body,
    user_id,
    created_at
)
VALUES(
    "Here's our first post",
    "This is the body of the first post.

	It is split into paragraphs.",
    1,
    DATE_ADD(CURDATE(), INTERVAL '-60 0:-45:10' DAY_SECOND)
);

INSERT INTO post(
    title,
    body,
    user_id,
    created_at
)
VALUES(
    "Now for a second article",
    "This is the body of the second post.
	This is another paragraph.",
    1,
    DATE_ADD(CURDATE(), INTERVAL '-40 10:55:51' DAY_SECOND)
);

INSERT INTO post(
    title,
    body,
    user_id,
    created_at
)
VALUES(
    "Here's a third post",
    "This is the body of the third post.
	This is split into paragraphs.",
    1,
    DATE_ADD(CURDATE(), INTERVAL '-13 3:18:24' DAY_SECOND)
);

-- create comment table
CREATE TABLE comment(
    id INT AUTO_INCREMENT NOT NULL,
    post_id INT NOT NULL,
    created_at VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    website VARCHAR(255),
    text VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);

INSERT INTO comment(
    post_id,
    created_at,
    name,
    website,
    text
)
VALUES(
    1,
    DATE_ADD(CURDATE(), INTERVAL '-10 0:-30:7' DAY_SECOND),
    'Jimmy',
    'http://example.com/',
    "This is Jimmy's contribution"
);

INSERT INTO comment(
    post_id,
    created_at,
    name,
    website,
    text
)
VALUES(
    1,
    DATE_ADD(CURDATE(), INTERVAL '-8 9:9:32' DAY_SECOND),
    'Jonny',
    'http://anotherexample.com/',
    "This is a comment from Jonny"
);

CREATE TABLE user (
    id INT AUTO_INCREMENT NOT NULL,
    username VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    created_at VARCHAR NOT NULL,
    is_enabled BOOLEAN NOT NULL DEFAULT 1,
    PRIMARY KEY(id)
);