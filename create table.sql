#drop table if exists `projgroup`;
#drop table if exists `statusrecord`;
drop table if exists `follow`;
drop table if exists `comments`;
drop table if exists `pledge`;
drop table if exists `payhistory`;
drop table if exists `interests`;
drop table if exists `tags`;
drop table if exists `sample`;
drop table if exists `creditcard`;
drop table if exists `project`;
drop table if exists `user`;


DROP TABLE IF EXISTS `user`;
create table user (
	`username` varchar(36) not null,
    `truename` varchar(36) null,
    `password` varchar(36) not null,
    `email` varchar(36) null,
    `gender` varchar(7) not null,
    `hometown` varchar(36) null,
    `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    primary key (username),
    key `email` (`email`),
	check (gender in ('Male', 'Female', 'Unknown'))
);

insert into `user` values ('A', 'Alice', '1', 'a@gmail.com', 'Female', 'Arooklyn', '2014-01-03 12:04:23');
insert into `user` values ('B', 'Bob', '1', 'b@gmail.com', 'Male', 'Brooklyn', '2016-01-03 12:04:23');
insert into `user` values ('C', 'Cathy', '1', 'c@gmail.com', 'Female', 'Crooklyn', '2015-01-03 12:04:23');
insert into `user` values ('D', 'Dylan', '1', 'd@gmail.com', 'Unknown', 'Drooklyn', '2016-02-03 12:04:23');
insert into `user` values ('E', 'Elle', '1', 'e@gmail.com', 'Female', 'Erooklyn', '2011-01-03 12:04:23');
insert into `user` values ('F', 'Frank', '1', 'f@gmail.com', 'Male', 'Frooklyn', '2004-01-03 12:04:23');
insert into `user` values ('G', 'George', '1', 'g@gmail.com', 'Male', 'Grooklyn', '2011-01-03 12:04:23');
insert into `user` values ('H', 'Holly', '1', 'h@gmail.com', 'Female', 'Hrooklyn', '2014-01-03 12:04:23');
insert into `user` values ('I', 'Irvin', '1', 'i@gmail.com', 'Unknown', 'Irooklyn', '1991-01-03 12:04:23');
insert into `user` values ('BobInBrooklyn', 'Bob', '1', 'bb@gmail.com', 'Unknown', 'Brooklyn', '1991-01-03 12:04:23');
insert into `user` values ('ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ', 'ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ', 'ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ', 'ZZZZZZZZZZZZZZZZZZZZZZZZZZ@gmail.com', 'Unknown', 'ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ', '1991-01-03 12:04:23');

DROP TABLE IF EXISTS `project`;
create table project (
	`pid` int not null,
    `username` varchar(36) not null,
    `pname` varchar(36) not null,
    `description` varchar(36) null,
    `posttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `minfund` int not null default '0',
    `maxfund` int not null default '0',
    `endtime` datetime NOT NULL,
    `completiontime` datetime NULL,
    `moneysum` int not null default '0',
    `status` varchar(10) not null default 'funding',
    `finaltime` datetime null,
    primary key (pid),
    key `pname` (`pname`),
    constraint `project_ibfk_1` foreign key (`username`) references `user` (`username`),
    check(status in ('funding', 'working', 'failed', 'complete', 'uncomplete'))
);

insert into `project` values ('1', 'H', 'House Holding', 'HHHHHHHHHHH', '2017-03-03 12:04:23', '0', '10000', '2018-01-04 12:04:23', '2019-01-03 12:04:23', '0', 'funding', null);
insert into `project` values ('2', 'A', 'An Apple', 'A', '2016-03-03 12:04:23', '10000', '100000', '2017-01-04 12:04:23', '2017-02-03 12:04:23', '10001', 'complete', '2017-02-03');
insert into `project` values ('8', 'A', 'Apartment Abadon', 'A', '2017-03-03 12:04:23', '1', '5000', '2017-04-04 12:04:23', '2018-02-03 12:04:23', '1000', 'complete', '2017-04-05');
insert into `project` values ('9', 'A', 'Ancle Amen', 'A', '2015-03-03 12:04:23', '5000', '100000', '2017-01-03 12:04:23', '2017-07-03 12:04:23', '100000', 'complete', '2017-03-03');
insert into `project` values ('3', 'A', 'Afraid of Anna', 'AAAAA', '2017-04-03 12:04:23', '0', '20000', '2019-04-05 12:04:23', '2019-06-03 12:04:23', '1', 'funding', null);
insert into `project` values ('4', 'B', 'Basic Battle Behaving', 'BbBbBb123:./fs!@#$%^&*()_+}{:">?<KJL', '2016-03-04 12:04:23', '10', '100', '2017-01-03 12:04:23', '2017-02-03', '0', 'failed', '2017-01-01');
insert into `project` values ('5', 'C', 'Cat Catching', 'CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC', '2015-06-03', '0', '10000', '2018-01-03', '2019-01-03', '0', 'funding',null);
insert into `project` values ('6', 'H', 'House HoldingHHHHHHHHHHHHHHHHHHHHHHH', 'HHHHHHH', '2017-03-03 12:04:23', '0', '10000', '2017-04-03 12:04:23', '2019-01-03 12:04:23', '0', 'working',null);
insert into `project` values ('7', 'H', 'House Holding', 'HHHHHHHHHHH', '2017-03-03 12:04:23', '0', '10000', '2017-04-03 12:04:23', '2019-01-03 12:04:23', '0', 'uncomplete', '2017-04-04');


DROP TABLE IF exists `follow`;
create table follow (
	`fanusername` varchar(36) not null,
    `followedusername` varchar(36) not null,
    primary key (fanusername, followedusername),
    constraint `follow_ibfk_1` foreign key (`fanusername`) references `user` (`username`),
    constraint `follow_ibfk_2` foreign key (`followedusername`) references `user` (`username`)
);

insert into `follow` values ('A', 'B');
insert into `follow` values ('A', 'C');
insert into `follow` values ('A', 'D');
insert into `follow` values ('B', 'A');
insert into `follow` values ('B', 'C');
insert into `follow` values ('B', 'G');
insert into `follow` values ('C', 'F');
insert into `follow` values ('D', 'A');
insert into `follow` values ('E', 'A');
insert into `follow` values ('E', 'B');
insert into `follow` values ('G', 'A');
insert into `follow` values ('G', 'B');
insert into `follow` values ('H', 'A');
insert into `follow` values ('H', 'B');
insert into `follow` values ('A', 'H');
insert into `follow` values ('BobInBrooklyn', 'A');
insert into `follow` values ('BobInBrooklyn', 'B');
insert into `follow` values ('BobInBrooklyn', 'C');

drop table if exists `comments`;
create table comments (
    `cid` int not null,
    `username` varchar(36) not null,
    `pid` int not null,
    `commenttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `content` varchar(140) not null,
    primary key (cid),
    constraint `comments_ibfk_1` foreign key (`pid`) references `project` (`pid`),
    constraint `comments_ibfk_2` foreign key (`username`) references `user` (`username`)
);

insert into `comments` values ('1', 'A', '8', '2017-04-05 12:04:23', 'LOL1');
insert into `comments` values ('2', 'B', '8', '2017-04-06 12:04:23', 'LOL2');
insert into `comments` values ('3', 'C', '8', '2017-04-04 12:04:23', 'LOL3');

drop table if exists `payhistory`;
create table payhistory (
	`username` varchar(36) not null,
    `pid` int not null,
    `amountsum` int not null default '0',
    `chargetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `rate` int null default 0,
	primary key (pid, username),
    constraint `payhistory_ibfk_1` foreign key (`pid`) references `project` (`pid`),
    constraint `payhistory_ibfk_2` foreign key (`username`) references `user` (`username`)
);

insert into `payhistory` values ('A', '2', '10000', '2017-01-04 12:04:23', '3');
insert into `payhistory` values ('B', '2', '1', '2017-01-04 12:04:23', '5');
insert into `payhistory` values ('F', '8', '3000', '2017-04-04 12:04:23', '3');
insert into `payhistory` values ('G', '9', '2500', '2017-01-03 12:04:23', '4');
insert into `payhistory` values ('I', '9', '4500', '2017-01-03 12:04:23', '5');

drop table if exists `creditcard`;
create table creditcard (
	`cardnumber` varchar(16) not null,
    `nameoncard` varchar(36) not null,
    `cvv` int not null,
    `expiration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`username` varchar(36) not null,
	primary key (cardnumber),
    constraint `cardnumber_ibfk_1` foreign key (`username`) references `user` (`username`)
);

insert into `creditcard` values ('1234123412341234', 'Annal', '123', '2017-09-01 00:00:01', 'A');
insert into `creditcard` values ('1234123412341231', 'Annal', '123', '2018-09-01 00:00:01', 'A');
insert into `creditcard` values ('1234123412341232', 'Dob', '123', '2017-08-01 00:00:01', 'B');
insert into `creditcard` values ('1234123412341233', 'Bob', '123', '2017-10-01 00:00:01', 'C');
insert into `creditcard` values ('1234123412341230', 'Sfjkd', '123', '2019-09-01 00:00:01', 'C');
insert into `creditcard` values ('1234123412341235', 'fjdfkdj', '123', '2020-09-01 00:00:01', 'C');
insert into `creditcard` values ('1234123412341236', 'Were', '123', '2019-09-01 00:00:01', 'D');
insert into `creditcard` values ('1234123412341237', 'Jkfjd', '123', '2024-09-01 00:00:01', 'E');
insert into `creditcard` values ('1234123412341238', 'fjdlfjd', '123', '2019-09-01 00:00:01', 'F');
insert into `creditcard` values ('1234123412341239', 'KLlfdfj', '123', '2037-09-01 00:00:01', 'G');
insert into `creditcard` values ('1234123412341210', 'Jkfjdik', '123', '2027-09-01 00:00:01', 'H');
insert into `creditcard` values ('1234123412341211', 'Jkfjdf', '123', '2027-10-01 00:00:01', 'I');

DROP table IF exists `pledge`;
create table pledge (
	`pid` int not null,
    `cardnumber` varchar(16) not null,
    `pledgetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `username` varchar(36) not null,
    `amount` int not null default '0',
    `charge` bool not null default false,
    primary key (pid, username, pledgetime),
    constraint `pledge_ibfk_1` foreign key (`pid`) references `project` (`pid`),
    constraint `pledge_ibfk_2` foreign key (`username`) references `user` (`username`),
    constraint `pledge_ibfk_3` foreign key (`cardnumber`) references `creditcard` (`cardnumber`)
);

insert into `pledge` values ('2', '1234123412341234', '2016-04-04 12:04:23', 'A', '4999', true);
insert into `pledge` values ('2', '1234123412341231', '2016-04-05 12:04:23', 'A', '5001', true);
insert into `pledge` values ('2', '1234123412341232', '2017-01-04 12:04:24', 'B', '1', true);
insert into `pledge` values ('3', '1234123412341231', '2017-04-04 12:04:23', 'A', '1', false);
insert into `pledge` values ('8', '1234123412341238', '2017-03-24 12:04:23', 'F', '3000', true);
insert into `pledge` values ('9', '1234123412341239', '2016-07-04 12:04:23', 'G', '2500', true);
insert into `pledge` values ('9', '1234123412341211', '2016-01-24 12:04:23', 'I', '2000', true);
insert into `pledge` values ('9', '1234123412341211', '2016-01-23 12:04:23', 'I', '2500', true);



drop table if exists `interests`;
create table interests (
	`username` varchar(36) not null,
    `interest` varchar(36) not null,
    primary key (username, interest),
    constraint `interests_ibfk_1` foreign key (`username`) references `user` (`username`)
);

insert into `interests` values ('A', 'Apple');
insert into `interests` values ('A', 'Banana');
insert into `interests` values ('A', 'Cherry');
insert into `interests` values ('A', 'Durian');
insert into `interests` values ('A', 'Fig');
insert into `interests` values ('A', 'Grape');
insert into `interests` values ('A', 'Haw');
insert into `interests` values ('A', 'Juicy Peach');
insert into `interests` values ('A', 'Kiwifruit');
insert into `interests` values ('B', 'Apple');
insert into `interests` values ('B', 'Banana');
insert into `interests` values ('B', 'Haw');
insert into `interests` values ('B', 'Juicy Peach');
insert into `interests` values ('B', 'Kiwifruit');
insert into `interests` values ('C', 'Apple');
insert into `interests` values ('C', 'Banana');
insert into `interests` values ('C', 'Cherry');
insert into `interests` values ('C', 'Durian');
insert into `interests` values ('C', 'Fig');
insert into `interests` values ('D', 'Apple');
insert into `interests` values ('D', 'Banana');
insert into `interests` values ('D', 'Kiwifruit');
insert into `interests` values ('E', 'Apple');
insert into `interests` values ('F', 'Apple');
insert into `interests` values ('F', 'Banana');
insert into `interests` values ('F', 'Cherry');
insert into `interests` values ('F', 'Durian');
insert into `interests` values ('F', 'Fig');
insert into `interests` values ('F', 'Grape');
insert into `interests` values ('F', 'Haw');
insert into `interests` values ('F', 'Juicy Peach');
insert into `interests` values ('F', 'Kiwifruit');
insert into `interests` values ('H', 'Apple');
insert into `interests` values ('H', 'Kiwifruit');
insert into `interests` values ('I', 'Apple');
insert into `interests` values ('I', 'Banana');
insert into `interests` values ('I', 'Cherry');
insert into `interests` values ('I', 'Fig');
insert into `interests` values ('I', 'Grape');
insert into `interests` values ('I', 'Haw');
insert into `interests` values ('ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ', 'Apple');

drop table if exists `tags`;
create table tags (
	`pid` int not null,
    `tag` varchar(36) not null,
    primary key (pid,tag),
    constraint `tags_ibfk_1` foreign key (`pid`) references `project` (`pid`)
);

insert into `tags` values ('1', 'Apple');
insert into `tags` values ('1', 'Banana');
insert into `tags` values ('1', 'Cherry');
insert into `tags` values ('1', 'Durian');
insert into `tags` values ('1', 'Fig');
insert into `tags` values ('1', 'Grape');
insert into `tags` values ('1', 'Haw');
insert into `tags` values ('1', 'Juicy Peach');
insert into `tags` values ('1', 'Jazz');
insert into `tags` values ('1', 'Kiwifruit');
insert into `tags` values ('2', 'Apple');
insert into `tags` values ('2', 'Banana');
insert into `tags` values ('2', 'Haw');
insert into `tags` values ('2', 'Jazz');
insert into `tags` values ('2', 'Juicy Peach');
insert into `tags` values ('2', 'Kiwifruit');
insert into `tags` values ('3', 'Apple');
insert into `tags` values ('3', 'Banana');
insert into `tags` values ('3', 'Cherry');
insert into `tags` values ('3', 'Durian');
insert into `tags` values ('3', 'Fig');
insert into `tags` values ('3', 'Jazz');
insert into `tags` values ('4', 'Apple');
insert into `tags` values ('4', 'Banana');
insert into `tags` values ('4', 'Kiwifruit');
insert into `tags` values ('4', 'Jazz');
insert into `tags` values ('5', 'Apple');
insert into `tags` values ('5', 'Jazz');
insert into `tags` values ('7', 'Apple');
insert into `tags` values ('7', 'Banana');
insert into `tags` values ('7', 'Cherry');
insert into `tags` values ('7', 'Durian');
insert into `tags` values ('7', 'Fig');
insert into `tags` values ('7', 'Grape');
insert into `tags` values ('7', 'Haw');
insert into `tags` values ('7', 'Juicy Peach');
insert into `tags` values ('7', 'Kiwifruit');
insert into `tags` values ('7', 'Jazz');
insert into `tags` values ('8', 'Jazz');
insert into `tags` values ('9', 'Jazz');

drop table if exists `sample`;
create table sample (
	`sid` int not null,
    `pid` int not null,
    `posttime` timestamp,
    `url_md5` varchar(32) not null,
    `title` varchar(64) not null,
    `summary` varchar(140) null,
    primary key (sid),
    constraint `sample_ibfk_1` foreign key (`pid`) references `project` (`pid`)
);

insert into `sample` values ('1', '1', '2017-04-04 12:04:23', 'aad58c739888c366dc879883f383a1a7', 'Hello World Proj1', 'Hi!');
insert into `sample` values ('2', '1', '2017-04-04 12:04:24', '1b374d74d60c82099a4e0501d09a0f56', 'Hello World again Proj1', 'Hi! again');
insert into `sample` values ('3', '7', '2017-04-05 12:04:23', '838e0e72279f984f5182a721cb04bd04', 'Hello World proj7', 'Hi!');

/*
drop table if exists `projgroup`;
create table projgroup (
	`pid` int not null,
    `membernumber` int not null default 1,
    `leader` varchar(36) not null,
    `crew` varchar(36) not null,
    primary key (pid, crew),
    constraint `projgroup_ibfk_1` foreign key (`leader`) references `user` (`username`),
    constraint `projgroup_ibfk_2` foreign key (`crew`) references `user` (`username`)
);

insert into `projgroup` values ('1', '3', 'H', 'A');
insert into `projgroup` values ('1', '3', 'H', 'B');
insert into `projgroup` values ('1', '3', 'H', 'H');
insert into `projgroup` values ('2', '1', 'A', 'A');
insert into `projgroup` values ('3', '2', 'A', 'A');
insert into `projgroup` values ('3', '2', 'A', 'B');
insert into `projgroup` values ('4', '1', 'B', 'B');
insert into `projgroup` values ('5', '1', 'C', 'C');
insert into `projgroup` values ('6', '1', 'H', 'H');
insert into `projgroup` values ('7', '2', 'H', 'H');
insert into `projgroup` values ('7', '2', 'H', 'G');
*/

