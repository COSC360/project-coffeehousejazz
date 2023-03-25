CREATE TABLE user (
    username varchar(100) NOT NULL,
    firstname varchar(100) NOT NULL,
    lastname varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    password varchar(100) NOT NULL,
    isAdmin boolean NOT NULL DEFAULT FALSE,
    profileImage BLOB,
    primary key (username),
    unique key (email)
);

CREATE TABLE post(
    username varchar(100) NOT NULL,
    profileImage BLOB,
    content text not null,
    postImage BLOB,
    topic varchar(100) NOT NULL,
    likes integer NOT NULL DEFAULT 0,
    dislikes integer NOT NULL DEFAULT 0,
    postID integer,
    primary key (postID)
    FOREIGN KEY (username) REFERENCES user(username)
);

CREATE TABLE comments(
    username varchar(100) NOT NULL,
    profileImage BLOB,
    content text not null,
    likes integer NOT NULL DEFAULT 0,
    dislikes integer NOT NULL DEFAULT 0,
    commentID integer,
    primary key (commentID),
);