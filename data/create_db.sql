/**
 * Database creation script
 */
DROP
    DATABASE IF EXISTS blog;
CREATE DATABASE blog; USE
    blog;
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
    DATE_ADD(CURDATE(), INTERVAL -2 MONTH)
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
    DATE_ADD(CURDATE(), INTERVAL -40 DAY)
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
    DATE_ADD(CURDATE(), INTERVAL -13 DAY)
);
-- create comment table
CREATE TABLE COMMENT(
    id INT AUTO_INCREMENT NOT NULL,
    post_id INT NOT NULL,
    created_at VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    website VARCHAR(255),
    text VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
); INSERT INTO COMMENT(
    post_id,
    created_at,
    name,
    website,
    text
)
VALUES(
    1,
    DATE_ADD(CURDATE(), INTERVAL -10 DAY),
    'Jimmy',
    'http://example.com/',
    "This is Jimmy's contribution"
);
INSERT INTO COMMENT(
    post_id,
    created_at,
    name,
    website,
    text
)
VALUES(
    1,
    DATE_ADD(CURDATE(), INTERVAL -8 DAY),
    'Jonny',
    'http://anotherexample.com/',
    "This is a comment from Jonny"
);