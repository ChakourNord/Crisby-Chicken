drop table Auto;
drop table termin;
drop table termin_auto;
create table Auto(id int not null ,marke varchar2(40) not null,modell varchar2(40));
create table termin(
    id int not null,
    termin TIMESTAMP not null,
    beschreibung varchar2(255)
);
create table termin_auto (
    id int not null ,
    aid int not null,
    tid int,
    FOREIGN KEY (tid) REFERENCES termin(id),
    FOREIGN KEY (aid) REFERENCES auto(id)
)

ALTER TABLE auto
  ADD (
    CONSTRAINT auto_pk primary key (id)
  );
  ALTER TABLE termin
  ADD (
    CONSTRAINT termin_pk primary key (id)
  );
  ALTER TABLE termin_auto
  ADD (
    CONSTRAINT termin_a_pk primary key(id)
  );

  CREATE SEQUENCE auto_seq;
  CREATE SEQUENCE termin_seq;
  CREATE SEQUENCE termin_auto_seq;

  CREATE OR REPLACE TRIGGER auto_before_in
  BEFORE INSERT ON auto
  FOR EACH ROW
BEGIN
  SELECT auto_seq.nextval
  INTO :new.id
  FROM dual;
END;

  CREATE OR REPLACE TRIGGER termin_before_in
  BEFORE INSERT ON termin
  FOR EACH ROW
BEGIN
  SELECT termin_seq.nextval
  INTO :new.id
  FROM dual;
END;

  CREATE OR REPLACE TRIGGER termin_auto_before_in
  BEFORE INSERT ON termin_auto
  FOR EACH ROW
BEGIN
  SELECT termin_auto_seq.nextval
  INTO :new.id
  FROM dual;
END;
