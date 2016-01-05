--
-- CARGO DATABASE CREATION SCRIPT FOR POSTGRESQL
--

CREATE TYPE c_level_enum AS ENUM ('Standard','Premium');

CREATE TABLE customer (
  c_id serial,
  c_name varchar(45) DEFAULT '',
  c_last_login timestamp NULL DEFAULT NULL,
  c_company varchar(45) DEFAULT '',
  c_city varchar(45) DEFAULT '',
  c_level c_level_enum NOT NULL DEFAULT 'Standard',
  c_error varchar(5) DEFAULT NULL,
  c_123 varchar(45) DEFAULT NULL,
  PRIMARY KEY (c_id)
);

CREATE TABLE no_key (
   nk_name varchar(25) DEFAULT NULL
);
 
CREATE TABLE service (
   s_id varchar(10) NOT NULL,
   s_name varchar(45) DEFAULT NULL,
   PRIMARY KEY (s_id)
);
 
CREATE TABLE status_code (
   sc_id varchar(3) NOT NULL,
   sc_name varchar(45) DEFAULT NULL,
   PRIMARY KEY (sc_id)
);
 
CREATE TABLE package (
   p_id serial,
   p_ship_date date DEFAULT NULL,
   p_ship_time timestamp with time zone DEFAULT NULL,
   p_customer_id int DEFAULT NULL,
   p_tracking_number varchar(45) DEFAULT NULL,
   p_description text,
   p_service varchar(10) DEFAULT NULL,
   p_destination varchar(45) DEFAULT NULL,
   PRIMARY KEY (p_id),
   CONSTRAINT p_customer FOREIGN KEY (p_customer_id) REFERENCES customer (c_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
   CONSTRAINT p_service_code FOREIGN KEY (p_service) REFERENCES service (s_id) ON DELETE NO ACTION ON UPDATE NO ACTION
);
 
CREATE TABLE purchase (
   p_id serial,
   p_status_code_id varchar(3) DEFAULT NULL,
   p_quantity int DEFAULT '1',
   p_description varchar(45) DEFAULT NULL,
   PRIMARY KEY (p_id),
   CONSTRAINT p_status_code FOREIGN KEY (p_status_code_id) REFERENCES status_code (sc_id) ON DELETE NO ACTION ON UPDATE NO ACTION
);
 
INSERT INTO customer (c_id, c_name, c_last_login, c_company, c_city, c_level, c_error, c_123) VALUES (1,'UPDATE','2011-11-09 06:00:00','ACME 123','Chicago','Standard','','aaa'),(2,'Frank, Jimbo','2012-01-01 11:04:00','The Company','New York','Standard','',NULL),(3,'James, Erika','2012-01-03 11:04:00','Worker Bee','Los Angeles','Standard','',NULL),(4,'James, Grace','2012-01-01 11:04:00','The Company','New York','Premium','aaa',NULL);

INSERT INTO service (s_id, s_name) VALUES ('2-day','2-Day'),('book','Book Rate'),('ground','Ground'),('overnight','Overnight');

INSERT INTO status_code (sc_id, sc_name) VALUES ('C','Closed'),('O','Open');

INSERT INTO package (p_id, p_ship_date, p_ship_time, p_customer_id, p_tracking_number, p_description, p_service, p_destination) VALUES (1,'2012-07-06','2012-11-07 00:00:00',3,'CC4567890123','office supplies','overnight','Chicago'),(2,'2012-01-31','2013-12-31 18:00:00',2,'BB9874567890','materials','2-day','New York'),(3,'2012-01-10','2012-01-07 17:23:00',3,'CC4567890123','updated description','ground','Los Angeles'),(4,'2011-12-24','2012-12-04 18:00:00',3,'AA1234567890','software','overnight','Chicago'),(5,'2012-07-01','2012-11-05 01:49:00',3,'BB9874567890','more office supplies','ground','New York'),(6,'2012-04-29','2012-12-11 02:24:32',2,'CC4567890123','fragile cargo','overnight','Chicago'),(7,'2012-04-28','2012-12-11 02:24:32',3,'AA1234567890','software','2-day','New York'),(8,'2012-04-29','2012-11-02 16:40:00',4,'BB9874567890','office supplies','overnight','Los Angeles'),(9,'2012-06-01','2012-12-11 02:24:32',3,'AA1234567890','fragile cargo','ground','Chicago'),(10,'2012-12-31','2012-11-02 16:41:00',2,'CC4567890123','widgets','overnight','New York'),(11,'2012-05-01','2012-08-07 16:41:00',3,'BB9874567890','fragile cargo','2-day','Chicago'),(12,'2012-04-28','2012-12-11 02:24:32',4,'AA1234567890','office supplies','overnight','New York'),(13,'2012-05-29','2012-12-11 02:24:32',2,'BB9874567890','fragile cargo','2-day','Los Angeles'),(14,'2012-04-28','2012-12-11 02:24:32',2,'AA1234567890','office supplies','overnight','Chicago'),(15,'2012-08-01','2012-12-11 02:24:32',3,'BB9874567890','office supplies','ground','Chicago'),(16,'2012-05-01','2012-12-11 02:24:32',3,'CC4567890123','office supplies','overnight','Chicago'),(17,'2012-05-01','2012-12-11 02:24:32',4,'AA1234567890','office supplies','overnight','Chicago'),(18,'2012-05-01','2012-12-11 02:24:32',1,'BB9874567890','office supplies','overnight','Chicago'),(19,'2012-05-01','2012-12-11 02:24:32',2,'AA1234567890','office supplies','overnight','Chicago'),(20,'2012-05-01','2012-12-11 02:24:32',3,'BB9874567890','office supplies','overnight','Chicago'),(21,'2012-06-01','2012-12-11 02:24:32',4,'AA1234567890','office supplies','overnight','Chicago'),(22,'2012-05-01','2012-12-11 02:24:32',1,'BB9874567890','office supplies','overnight','Chicago'),(23,'2012-05-01','2012-12-11 02:24:32',2,'AA1234567890','office supplies','overnight','Chicago'),(24,'2012-05-01','2012-12-11 02:24:32',3,'CC4567890123','office supplies','overnight','Chicago'),(25,'2012-06-01','2012-12-11 02:24:32',4,'AA1234567890','UPDATED','overnight','Chicago'),(26,'2012-05-01','2012-12-11 02:24:32',1,'CC4567890123','office supplies','overnight','Chicago'),(27,'2012-05-01','2012-12-11 02:24:32',2,'AA1234567890','office supplies','overnight','Chicago'),(28,'2012-05-01','2012-12-11 02:24:32',1,'AA1234567890','office supplies','overnight','Chicago'),(29,'2012-05-01','2012-12-11 02:24:32',3,'AA1234567890','office supplies','overnight','Chicago'),(30,'2012-05-01','2012-12-11 02:24:32',4,'AA1234567890','office supplies','overnight','Chicago'),(31,'2012-05-01','2012-12-11 02:24:32',1,'AA1234567890','office supplies','overnight','Chicago'),(32,'2012-06-01','2012-12-11 02:24:32',2,'AA1234567890','office supplies','overnight','Chicago'),(33,'2012-05-01','2012-12-11 02:24:32',3,'AA1234567890','office supplies','overnight','Chicago'),(34,'2012-05-01','2012-12-11 02:24:32',4,'AA1234567890','office supplies','overnight','Chicago'),(35,'2012-05-01','2012-12-11 02:24:32',1,'AA1234567890','office supplies','overnight','Chicago'),(36,'2012-05-01','2012-12-11 02:24:32',2,'AA1234567890','office supplies','overnight','Chicago'),(37,'2012-05-01','2012-12-11 02:24:32',3,'AA1234567890','office supplies','overnight','Chicago'),(38,'2012-05-01','2012-12-11 02:24:32',4,'AA1234567890','office supplies','overnight','Chicago'),(39,'2012-05-01','2012-12-11 02:24:32',1,'AA1234567890','office supplies','overnight','Chicago'),(40,'2012-05-01','2012-12-11 02:24:32',2,'AA1234567890','office supplies','overnight','Chicago'),(41,'2012-05-01','2012-12-11 02:24:32',3,'AA1234567890','office supplies','overnight','Chicago'),(42,'2012-06-01','2012-12-11 02:24:32',3,'AA1234567890','office supplies','overnight','Chicago'),(44,'2012-05-02','2012-11-03 17:23:00',2,'AA1234567890','office supplies','overnight','Chicago'),(45,'2012-05-01','2012-12-11 02:24:32',3,'AA1234567890','office supplies','overnight','Chicago');

INSERT INTO purchase (p_id, p_status_code_id, p_quantity, p_description) VALUES (1,'O',1,'Purchase Order A'),(2,'O',1,'Purchase Order B');






