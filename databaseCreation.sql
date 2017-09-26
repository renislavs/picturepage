/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Marianne
 * Created: 25-09-2017
 */

drop database if exists projectKoldingImages;
create database projectKoldingImages;
use projectKoldingImages;

create table photo (
    id int not null auto_increment primary key,
    caption varchar(64) not null,
    imagedata blob not null,
    mimetype varchar(32) not null,
    story text not null,
    tags varchar(128) not null,
    credit varchar(64) not null
);

create table voter (
    email varchar(64) not null primary key,
    password varchar(128) not null,
    firstname varchar(32) not null
);

create table vote (
    photoid int not null,
    voter varchar(64) not null,
    primary key(photoid, voter),
    foreign key(photoid) references photo(id),
    foreign key(voter) references voter(email)
);
