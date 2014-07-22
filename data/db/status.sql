BEGIN TRANSACTION;
CREATE TABLE status (id INTEGER PRIMARY KEY, user TEXT, message TEXT, created_at TEXT, updated_at TEXT);
INSERT INTO status VALUES(1,'jguittard','My name is Julien','2014-04-02 11:30:22','2014-04-21 01:28:28');
INSERT INTO status VALUES(2,'johndoe','I am unknown','2014-04-15 16:12:44',NULL);
COMMIT;
