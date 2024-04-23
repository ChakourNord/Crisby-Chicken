CREATE PROCEDURE insert_inautot (aid IN number,tid IN number) AS
   BEGIN

      insert into TERMIN_AUTO (Aid,tid) values (aid,tid);

   END;

 drop VIEW auto_ter
   create view auto_ter AS
   select * from TERMIN_AUTO left join auto on TERMIN_AUTO.AID=AUTO.ID join termin d on TERMIN_AUTO.TID=d.ID;