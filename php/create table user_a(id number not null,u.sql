create table user_a(id number not null,username varchar2(50) not null,pass varchar2(50) not null)
CREATE SEQUENCE user_a_seq
    INCREMENT BY 1
    START WITH 1
CREATE OR REPLACE TRIGGER user_a_inc
  BEFORE INSERT ON user_a
  FOR EACH ROW
BEGIN
  SELECT user_a_seq.nextval
  INTO :new.id
  FROM dual;
END;
INSERT INTO USER_A(
   
    USERNAME,
    PASS
  )
VALUES
  (
    'chakour','mim92214'
  );
