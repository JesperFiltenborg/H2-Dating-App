DROP DATABASE IF EXISTS DatingAppH2;
CREATE DATABASE DatingAppH2;
USE DatingAppH2;
									-- TABLES --
CREATE TABLE account(
    id INT AUTO_INCREMENT NOT NULL,
    username VARCHAR(256) NOT NULL,
    password VARCHAR(256) NOT NULL,
    phone INT(11) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address VARCHAR(35) NOT NULL,
    city VARCHAR(35) NOT NULL,
    secretKey VARCHAR(10) DEFAULT NULL,
    profileId int DEFAULT NULL
);
CREATE TALBE profile(
    id INT NOT NULL,
    firstName VARCHAR(20) NOT NULL,
    lastName VARCHAR(20) NOT NULL,
    sex, ENUM ('male','female','other') NOT NULL,
    text VARCHAR(300) NOT NULL,
    activeStatus ENUM ('notSearching', 'isSearching', 'deactivated') NOT NULL,
    appearance VARCHAR(40) NOT NULL,
    rating int(5) NOT NULL DEFAULT 2,
    creationDate DATE NOT NULL,
    banLenght NOT NULL,
    
);
CREATE TABLE preferences(
    id INT NOT NULL,
    sexuality ENUM ('male', 'female', 'other', 'all')
);
CREATE TABLE photos(
    id INT NOT NULL,
    url1 VARCHAR DEFAULT NULL,
    url2 VARCHAR DEFAULT NULL,
    url3 VARCHAR DEFAULT NULL,
    url4 VARCHAR DEFAULT NULL,
    url5 VARCHAR DEFAULT NULL,
    url6 VARCHAR DEFAULT NULL,
    url7 VARCHAR DEFAULT NULL,
    url8 VARCHAR DEFAULT NULL,
    url9 VARCHAR DEFAULT NULL
);
CREATE TALBE zip(
    zip INT(4) NOT NULL,
    city varchar(30) NOT NULL
);

									-- ALTERS --
ALTER TABLE account
ADD FOREIGN KEY (city) REFERENCES zipBy(city);
ALTER TABLE profile
ADD FOREIGN KEY (accountId) REFERENCES account(id);

