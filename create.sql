DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Posts;
DROP TABLE IF EXISTS Comments;
DROP TABLE IF EXISTS To-doLists;

CREATE TABLE Users (
    userID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY;
    username UNIQUE TEXT NOT NULL;
    passw TEXT NOT NULL;
    dataRegistered DATETIME NOT NULL;
    posts TEXT REFERENCES Posts;
    comments TEXT REFERENCES comments;
    userStatus TEXT NOT NULL;
);

CREATE TABLE Posts(
    postID INTEGER UNIQUE NOT NULL PRIMARY KEY;
    title TEXT NOT NULL;
    content TEXT;
    link TEXT;
    image TEXT;
    dateWritten DATETIME NOT NULL;
    votes INTEGER;
    comments TEXT REFERENCES Comments;
);

CREATE TABLE Comments(
    commentID INTEGER UNIQUE NOT NULL PRIMARY KEY;
    content TEXT;
    dateWritten DATETIME NOT NULL;
    votes INTEGER;
    comments TEXT REFERENCES Comments;
    
);

ALTER TABLE posts ADD FOREIGN KEY(post_by) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE comments ADD FOREIGN KEY(topic_by) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE;