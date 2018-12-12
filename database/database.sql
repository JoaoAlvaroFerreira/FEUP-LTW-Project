
CREATE TABLE users (
    username VARCHAR NOT NULL PRIMARY KEY,
    passw VARCHAR NOT NULL,
    dataRegistered DATE
);

CREATE TABLE posts
(
    postID INTEGER UNIQUE NOT NULL PRIMARY KEY,
    title VARCHAR NOT NULL,
    content VARCHAR,
    type VARCHAR,
    dateWritten DATETIME,
    username INTEGER REFERENCES users Not NULL
);

CREATE TABLE comments
(
    commentID INTEGER UNIQUE NOT NULL PRIMARY KEY,
    content TEXT,
    dateWritten DATETIME NOT NULL,
    postID INTEGER REFERENCES posts Not NULL
);

CREATE TABLE votes
(
    commentID INTEGER NOT NULL REFERENCES Comments,
    username VARCHAR NOT NULL REFERENCES users,
    positive INTEGER,
    PRIMARY KEY(commentID,username)
);

INSERT INTO users VALUES ('Andre','12345',NULL);
INSERT INTO users VALUES ('Joao','234','2018-06-20');
INSERT INTO users VALUES ('Andre1','12345',NULL);

INSERT INTO posts VALUES (NULL,'SOMESADS','COTNESRTE',NULL,NULL,'Andre');
INSERT INTO posts VALUES (NULL,'SOSADAMESADS','COTNESRTE',NULL,NULL,'Andre');

INSERT INTO votes VALUES (1,'Joao',1);
INSERT INTO votes Values (1,'Andre',0);
INSERT INTO votes VALUES (2,'Joao',1);
