-- usuario
INSERT INTO dojo.usuario (id, tx_nome,tx_email)
	 VALUES (1, 'Noble Rosario', 'eu@utmolestiein.org'),
	        (2, 'Mark Randolph','Donec@diam.co.uk'),
	        (3, 'Marsden Booker','vehicula.risus.Nulla@estac.edu'),
	        (4, 'Ethan Navarro','hymenaeos@massa.com'),
	        (5, 'Steven Rowland','orci@commodoipsum.edu'),
	        (6, 'Quentin Prince','Nunc.quis.arcu@vehicularisusNulla.edu'),
	        (7, 'Vance Shelton','In.at@egestasurna.net'),
	        (8, 'Orlando Palmer','Cras.sed@Aliquamtinciduntnunc.com'),
	        (9, 'Mannix Harrington','eget@aliquamarcu.net'),
	        (10, 'Russell Cardenas','nunc.id.enim@NullaaliquetProin.ca');

-- endereco
INSERT INTO dojo.endereco (id,id_dono,tx_endereco)
     VALUES (1,1,'São Paulo'),
     		(2,2,'Santa Catarina'),
     		(3,3,'Bahia'),
     		(4,4,'Ceará'),
     		(5,5,'Bahia'),
     		(6,6,'Minas Gerais'),
     		(7,7,'Rio de Janeiro'),
     		(8,8,'São Paulo'),
     		(9,9,'São Paulo'),
     		(10,10,'São Paulo');

-- infracao
INSERT INTO dojo.infracao (id,tx_infracao,vl_infracao,dt_infracao,id_infrator)
     VALUES (1,'Dapibus Gravida Aliquam LLP',829.93,'2019-04-30 01:07:10.530538+00', 1),
            (2,'Ipsum Suspendisse Non LLP',467.77,'2019-04-30 01:07:10.530538+00',2),
            (3,'Arcu Iaculis Enim Corporation',305.84,'2019-04-30 01:07:10.530538+00',3),
            (4,'Neque Nullam Consulting',53.38,'2019-04-30 01:07:10.530538+00',4),
            (5,'Sed Inc.',251.43,'2019-04-30 01:07:10.530538+00',5),
            (6,'Erat Etiam Vestibulum PC',789.96,'2019-04-30 01:07:10.530538+00',6),
            (7,'Cursus Diam Foundation',122.99,'2019-04-30 01:07:10.530538+00',7),
            (8,'Elit Inc.',764.95,'2019-04-30 01:07:10.530538+00',8),
            (9,'Nunc Ac Mattis PC',22.54,'2019-04-30 01:07:10.530538+00',9),
            (10,'Non Egestas Ltd',872.64,'2019-04-30 01:07:10.530538+00',10);

-- notificacao
INSERT INTO dojo.notificacao(id, id_endereco, id_infracao, dt_notificacao, is_notificou)
   VALUES (1, 1, 1, now(), false),
   		  (2, 1, 1, now(), false),
   		  (3, 1, 1, now(), true);
