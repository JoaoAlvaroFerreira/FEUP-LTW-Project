DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS commentvotes;
DROP TABLE IF EXISTS postvotes;

CREATE TABLE users (
    username VARCHAR NOT NULL PRIMARY KEY,
    passw VARCHAR NOT NULL,
    profileimg VARCHAR,
    email VARCHAR,
    description VARCHAR,
    dateofbirth DATE,
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
    commentID INTEGER NOT NULL,
    content TEXT,
    dateWritten DATETIME NOT NULL,
    postID INTEGER REFERENCES posts Not NULL,
    username INTEGER REFERENCES users Not NULL,
    PRIMARY KEY(postID, commentID, username)
);

CREATE TABLE commentvotes
(
    
    postID INTEGER UNIQUE NOT NULL REFERENCES posts,
    commentID INTEGER UNIQUE NOT NULL REFERENCES comments,
    username VARCHAR NOT NULL REFERENCES users,
    positive INTEGER,
    PRIMARY KEY(postID, commentID,username)
);

CREATE TABLE postvotes
(
    postID INTEGER NOT NULL REFERENCES posts,
    username VARCHAR NOT NULL REFERENCES users,
    positive INTEGER,
    PRIMARY KEY(postID,username)
);

INSERT INTO users VALUES ('Andre','12345',NULL,NULL,NULL,NULL,'2018-06-25');
INSERT INTO users VALUES ('Joao','234',NULL,NULL,NULL,NULL,'2018-06-20');
INSERT INTO users VALUES ('Ricardo','12345',NULL,NULL,NULL,NULL,'2018-06-28');

INSERT INTO posts VALUES (NULL,'Titulo Teste','Conteudo','text','2018-09-25','Andre');
INSERT INTO posts VALUES (NULL,'Post do Catano','Ai que dor de costas','text','2018-11-25','Andre');
INSERT INTO posts VALUES (NULL,'Ta frio','https://external-preview.redd.it/i5-BV_QyddvJBPJVzUIabvUVrqeWGjqFDnE-I2yLSiw.png?width=640&crop=smart&auto=webp&s=5f68cf9528ab40b5988397b7bab8c8f981b07818','img','2018-06-29','Ricardo');

INSERT INTO postvotes VALUES (1,'Joao',1);
INSERT INTO postvotes VALUES (1,'Ricardo',1);
INSERT INTO postvotes Values (1,'Andre',0);
INSERT INTO postvotes VALUES (2,'Joao',0);
