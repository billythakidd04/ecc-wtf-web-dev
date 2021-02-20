create DATABASE IF NOT EXISTS ecc_demo;

use ecc_demo;

create table if not exists ecc_demo.groups (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    groupNumber INT NOT NULL,
    repositoryURL VARCHAR(100) NOT NULL
);

create table if not exists ecc_demo.students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(30) NOT NULL,
    lastName VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
    repositoryURL VARCHAR(100) NOT NULL,
    groupID int not null,
    FOREIGN KEY (groupID) REFERENCES ecc_demo.groups(id)
);