drop trigger auto_before_in;
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