#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: roles
#------------------------------------------------------------

CREATE TABLE roles(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (10) NOT NULL
	,CONSTRAINT roles_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: users
#------------------------------------------------------------

CREATE TABLE users(
        id                Int  Auto_increment  NOT NULL ,
        lastname          Varchar (50) NOT NULL ,
        firstname         Varchar (50) NOT NULL ,
        birth_date        Date NOT NULL ,
        email             Varchar (100) NOT NULL ,
        password          Varchar (255) NOT NULL ,
        phone_number      Int NOT NULL ,
        adress_number     Int NOT NULL ,
        adress            Varchar (150) NOT NULL ,
        appartment_number Int NOT NULL ,
        postal_code       Int NOT NULL ,
        city              Varchar (60) NOT NULL ,
        loyalty_card      Int ,
        id_roles          Int NOT NULL
	,CONSTRAINT users_PK PRIMARY KEY (id)

	,CONSTRAINT users_roles_FK FOREIGN KEY (id_roles) REFERENCES roles(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: categories
#------------------------------------------------------------

CREATE TABLE categories(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT categories_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: status
#------------------------------------------------------------

CREATE TABLE status(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (10) NOT NULL
	,CONSTRAINT status_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: orders
#------------------------------------------------------------

CREATE TABLE orders(
        id            Int  Auto_increment  NOT NULL ,
        order_date    Datetime NOT NULL ,
        delivery_date Datetime NOT NULL ,
        total_price   Float NOT NULL ,
        id_users      Int NOT NULL ,
        id_status     Int NOT NULL
	,CONSTRAINT orders_PK PRIMARY KEY (id)

	,CONSTRAINT orders_users_FK FOREIGN KEY (id_users) REFERENCES users(id)
	,CONSTRAINT orders_status0_FK FOREIGN KEY (id_status) REFERENCES status(id)
	,CONSTRAINT orders_users_AK UNIQUE (id_users)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: packagings
#------------------------------------------------------------

CREATE TABLE packagings(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT packagings_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: taxes
#------------------------------------------------------------

CREATE TABLE taxes(
        id   Int  Auto_increment  NOT NULL ,
        rate Float NOT NULL
	,CONSTRAINT taxes_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: items
#------------------------------------------------------------

CREATE TABLE items(
        id              Int  Auto_increment  NOT NULL ,
        name            Varchar (50) NOT NULL ,
        picture         Text NOT NULL ,
        description     Varchar (250) NOT NULL ,
        taxe_free_price Float NOT NULL ,
        stock           Int NOT NULL ,
        weight          Float NOT NULL ,
        size            Varchar (50) NOT NULL ,
        id_categories   Int NOT NULL ,
        id_packagings   Int NOT NULL ,
        id_taxes        Int NOT NULL
	,CONSTRAINT items_PK PRIMARY KEY (id)

	,CONSTRAINT items_categories_FK FOREIGN KEY (id_categories) REFERENCES categories(id)
	,CONSTRAINT items_packagings0_FK FOREIGN KEY (id_packagings) REFERENCES packagings(id)
	,CONSTRAINT items_taxes1_FK FOREIGN KEY (id_taxes) REFERENCES taxes(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: timeslot_allocation
#------------------------------------------------------------

CREATE TABLE timeslot_allocation(
        id              Int  Auto_increment  NOT NULL ,
        slot_allocation Time NOT NULL ,
        id_orders       Int NOT NULL
	,CONSTRAINT timeslot_allocation_PK PRIMARY KEY (id)

	,CONSTRAINT timeslot_allocation_orders_FK FOREIGN KEY (id_orders) REFERENCES orders(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: command_line
#------------------------------------------------------------

CREATE TABLE command_line(
        id        Int NOT NULL ,
        id_items  Int NOT NULL ,
        quantity  Int NOT NULL ,
        total_HT  Float NOT NULL ,
        total_TTC Float NOT NULL
	,CONSTRAINT command_line_PK PRIMARY KEY (id,id_items)

	,CONSTRAINT command_line_orders_FK FOREIGN KEY (id) REFERENCES orders(id)
	,CONSTRAINT command_line_items0_FK FOREIGN KEY (id_items) REFERENCES items(id)
)ENGINE=InnoDB;

