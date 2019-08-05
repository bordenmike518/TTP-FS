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

-- Login / Logout 
drop table if exists logSheet;
create table logSheet (
    userId int,
    type char not null, -- 'I'n, 'O'ut
    timstamp timestamp not null
);

-- Transactions
drop table if exists transactions;
create table transactions (
    transId bigserial primary key,
    userId int not null,
    transName varchar(16) not null,
    transAmount float not null,
    transCount int not null,
    timstamp timestamp not null
);

-- Init params for verification
insert into transactions (userId, transName, transAmount, transCount, timstamp)
    values(3, '$', 5000.00, -1, now());
insert into transactions (userId, transName, transAmount, transCount, timstamp)
    values(3, 'goog', 1111.25, 2, now());
insert into transactions (userId, transName, transAmount, transCount, timstamp)
    values(3, 'nflx',  375.43, 3, now());
insert into transactions (userId, transName, transAmount, transCount, timstamp)
    values(3,  'ibm',  140.22, 5, now());

-- Sample query to get shares per ticker for the given userId.
select transName, 
    sum(transCount) as transCount
from transactions
where userId = 3
    and transName != '$'
group by transName;

to_char(timstamp, 'Mon DD, YYYY HH:MI:SS')