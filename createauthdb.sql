create database sglocal;
use sglocal;

create table tbluser (   userid int NOT NULL AUTO_INCREMENT,
			 username varchar(20),
			 password varchar(40), 
                   firstname varchar(40),
			 lastname varchar(40),
			 email varchar(40),
			 phone int(10),
			 block int(10),
			 street varchar(70),
			 floor int(10),
			 unit int(10),
			 postal varchar(10),
			 birthday int(10),
			 birthmonth int(10),
			 birthyear int(10),
			 cardname varchar(40),
			 cardnumber varchar(40),
			 PRIMARY KEY (userid)
                     );
create table tblrestaurant ( restaurantid int NOT NULL AUTO_INCREMENT,
			     restaurantname varchar(50),
		             PRIMARY KEY (restaurantid)
		     );
create table tblfood ( foodid int NOT NULL AUTO_INCREMENT,
		       foodname varchar(50),
		       foodnameid int,
		       price float(9,2),
		       restaurantid int,
		       PRIMARY KEY (foodid),
		       CONSTRAINT FK_RestaurantFood FOREIGN KEY (restaurantid)
		       REFERENCES tblrestaurant(restaurantid)
		     );
create table tblchart ( chartid int NOT NULL AUTO_INCREMENT,
		       foodid int,
		       foodnameid int,
		       restaurantid int,
		       totalquantity int,
		       userid int,

		       PRIMARY KEY (chartid),

		       CONSTRAINT FK_Restaurantchart FOREIGN KEY (restaurantid)
		       REFERENCES tblrestaurant(restaurantid),

		       CONSTRAINT FK_Foodchart FOREIGN KEY (foodid)
		       REFERENCES tblfood(foodid),
	
		       CONSTRAINT FK_Userchart FOREIGN KEY (userid)
		       REFERENCES tbluser(userid)
		     );

create table tblorder ( orderid int NOT NULL AUTO_INCREMENT,
		       fooddid int,
		       fooddnameid int,
		       restauranttid int,
		       totalquanttity int,
		       useridd int,
		       date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

		       PRIMARY KEY (orderid),

		       CONSTRAINT FK_Restaurantorder FOREIGN KEY (restauranttid)
		       REFERENCES tblrestaurant(restaurantid),

		       CONSTRAINT FK_Foodorder FOREIGN KEY (fooddid)
		       REFERENCES tblfood(foodid),
	
		       CONSTRAINT FK_Userorder FOREIGN KEY (useridd)
		       REFERENCES tbluser(userid)
		     );

insert into tblrestaurant (restaurantname) values 
	("Qi Ji"),
	("Uncle Penyet"),
	("Aaqil Muslim Food"),
	("Fish & Chicks"),
	("Amigo's"),
	("Pastamania"),
	("Momiji Cafe"),
	("Ah Chiang's Porridge"),
	("Malaxiangguo"),
	("Korean Charcoal BBQ"),
	("Ma Mum"),
	("The Bread Gang"),
	("HONG LE KOREAN"),
	("Danny Oppa's Korean"),
	("Hang Cusine"),
	("Bonchon Wisma Atria"),
	("Juk Story"),
	("Nipong Naepong");

insert into tblfood (foodname, foodnameid, price, restaurantid) values 
	("Nasi Lemak Set 2", 1, 6.80, 1),
	("Mee Siam", 2, 6.20, 1),
	("Laksa with Prawns", 3, 8.60, 1),
	("Nasi Lemak Set 5", 4, 4.50, 1),
	("Mee Soup", 1, 7.49, 2),
	("Mee Rebus", 2, 7.39, 2),
	("Mee Goreng", 3, 8.19, 2),
	("Nasi Penyet", 4, 11.29, 2),
	("Mee Goreng", 1, 6.00, 3),
	("Roti Prata Sunami", 2, 4.50, 3),
	("Mee Kuah Seafood", 3, 6.50, 3),
	("Nasi Goreng Black Pepper", 4, 6.50, 3),
	("Classic Salmon Slices", 1, 14.67, 4),
	("Lemon Salmon Slices", 2, 15.39, 4),
	("Fried Cod Fish", 3, 15.39, 4),
	("Grilled Cod FIsh", 4, 16.76, 4),
	("Chicken Chop", 1, 8.90, 5),
	("Curry Rice", 2, 6.90, 5),
	("Battered Fish", 3, 9.90, 5),
	("Pork Chop", 4, 8.90, 5),
	("Creamy Chicken", 1, 7.50, 6),
	("Tomato Pasta", 2, 10.50, 6),
	("Chicken Bacon Aglio", 3, 10.90, 6),
	("Cheesy Chicken Ham", 4, 10.50, 6),
	("Pork Katsu Sandwich", 1, 13.70, 7),
	("Chicken Katsu Sandwich", 2, 12.63, 7),
	("Crispy Chicken Sandwich", 3, 10.49, 7),
	("Avocado Egg Sandwich", 4, 11.56, 7),
	("Century Egg Porridge", 1, 4.50, 8),
	("Chicken Porridge", 2, 4.30, 8),
	("Fish Porridge", 3, 6.50, 8),
	("Pork Ball Porridge", 4, 4.30, 8),
	("Mala Grilled Fish", 1, 20.59, 9),
	("Mala Vege", 2, 10.79, 9),
	("Mala Meat Ball", 3, 15.68, 9),
	("Tomato Fried Egg", 4, 9.45, 9),
	("Sundubu Jjigae", 1, 16.90, 10),
	("Kimchi Jjigae", 2, 16.90, 10),
	("Samgyetang", 3, 19.90, 10),
	("Japchae", 4, 4.50, 10),
	("Beef Boat Noodle", 1, 8.80, 11),
	("Kaya Butter Toast", 2, 2.80, 11),
	("Chee Cheong Fun", 3, 2.80, 11),
	("Grilled Chicken Noodle", 4, 8.30, 11),
	("Roti John Nacho Chesse", 1, 8.50, 12),
	("Classic Cheese Burger", 2, 9.50, 12),
	("Roti John Cheeseburger", 3, 9.50, 12),
	("Beef Quesadilla", 4, 11.50, 12),
	("Hotplate Spicy Sotong Set", 1, 8.30, 13),
	("Hot Plate Saba Fish Rice", 2, 7.50, 13),
	("Hot Plate Chicken Rice", 3, 7.80, 13),
	("Hot Plate Beef Rice", 4, 8.80, 13),
	("BBQ Spicy Chicken Set", 1, 7.80, 14),
	("BBQ Spicy Pork Set", 2, 7.80, 14),
	("BBQ Beef Set", 3, 8.30, 14),
	("Kimchi Fried Rice", 4, 6.80, 14),
	("Fried Shrimp Dumpling", 1, 9.30, 15),
	("Steamed Shrimp Dumpling", 2, 9.30, 15),
	("XL Soy Sauce Chicken", 3, 9.30, 15),
	("Dolsol Bibimbap Beef", 4, 9.30, 15),
	("Boneless Chicken", 1, 15.30, 16),
	("Wings", 2, 11.70, 16),
	("Bonchon Kimchi Fried Rice", 3, 12.10, 16),
	("Traditional Tteokbokki", 4, 14.30, 16),
	("Unagi Juk", 1, 16.30, 17),
	("Collagen Juk", 2, 15.70, 17),
	("Dak Beoseot Juk", 3, 12.10, 17),
	("Sogogi-juk", 4, 14.30, 17),
	("Seafood Cha Ppong", 1, 25.00, 18),
	("Ni Pizza-Sweet Potato", 2, 25.00, 18),
	("Rose Tteokbokki", 3, 25.00, 18),
	("Vongole Ppong", 4, 25.00, 18);

grant select on sglocal.* 
             to 'webauth' 
             identified by 'webauth';
flush privileges;
