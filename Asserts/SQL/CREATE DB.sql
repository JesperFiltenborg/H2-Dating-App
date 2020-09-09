DROP DATABASE IF EXISTS DatingAppH2;
CREATE DATABASE DatingAppH2;
USE DatingAppH2;

									-- TABLES --
CREATE TABLE account(
    id INT AUTO_INCREMENT PRIMARY KEY,
    profileID INT,
    city int,
    username VARCHAR(255),
    password VARCHAR(255) CHARSET utf8 NOT NULL,
    phone int,
    email VARCHAR(255) CHARSET utf8,
    address VARCHAR(30),
    secretKey VARCHAR(10) DEFAULT NULL
);

CREATE TABLE profile(
    id INT AUTO_INCREMENT PRIMARY KEY,
    prefsId int,
    photosId int,
    firstName VARCHAR(20),
    lastName VARCHAR(20),
    age INT(3),
    sex ENUM ('male', 'female', 'other'),
    text VARCHAR(500),
    activeStatus ENUM ('notSearching', 'isSearching', 'deactivated'),
    appearance VARCHAR(30),
  	rating INT(5) DEFAULT 2,
    creationDate DATE DEFAULT NOW(),
    banLength DATE DEFAULT NULL
);

CREATE TABLE prefs(
	id INT PRIMARY KEY,
    sexuality ENUM ('male', 'female', 'all')
);

CREATE TABLE photos(
	ID INT PRIMARY KEY,
    url1 VARCHAR(500) DEFAULT NULL,
    url2 VARCHAR(500) DEFAULT NULL,
    url3 VARCHAR(500) DEFAULT NULL,
    url4 VARCHAR(500) DEFAULT NULL,
    url5 VARCHAR(500) DEFAULT NULL,
    url6 VARCHAR(500) DEFAULT NULL,
    url7 VARCHAR(500) DEFAULT NULL,
    url8 VARCHAR(500) DEFAULT NULL,
    url9 VARCHAR(500) DEFAULT NULL
);

CREATE TABLE city(
	city INT PRIMARY KEY,
    zipcode int(4)
);

									-- ALTERS --
ALTER TABLE account
ADD FOREIGN KEY (city) 
REFERENCES city(city);

ALTER TABLE profile
ADD FOREIGN KEY (id)
REFERENCES account(id);

ALTER TABLE prefs
ADD FOREIGN KEY (id)
REFERENCES profile(id);

ALTER TABLE photos
ADD FOREIGN KEY (id)
REFERENCES profile(id);
