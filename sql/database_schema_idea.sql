-- Registration and Login
drop table if exists users;
create table users (
    userId serial primary key,
    fname varchar(64) not null,
    lname varchar(64) not null,
    email varchar(64) unique not null,
    password varchar(64) not null,
    timstamp timestamp not null
);

drop table if exists logSheet;
create table logSheet (
    userId int,
    type char not null, -- 'I'n, 'O'ut
    timstamp timestamp not null
);


drop table if exists transactions;
create table transactions (
    userId bigserial primary key,
    ticker varchar(16) not null,
    count int not null,
    price float not null,
    type char not null, -- 'P'urchase, 'S'ale
    timstamp timestamp not null
);
