alter table designation add officer_name varchar(100);
alter table designation  add officer_mobile varchar(12);
alter table complaints add prevreferencetype tinyint(4) null;
alter table complaints add prevreferenceno varchar(300) null;
insert into prevreference (name_hi,name_en) values('मुख्यमंत्री सन्दर्भ','CM Reference');

