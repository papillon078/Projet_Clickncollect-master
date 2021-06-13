#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: ll7882_roles
#------------------------------------------------------------

CREATE TABLE ll7882_roles(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (10) NOT NULL
	,CONSTRAINT ll7882_roles_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ll7882_categories
#------------------------------------------------------------

CREATE TABLE ll7882_categories(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT ll7882_categories_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ll7882_status
#------------------------------------------------------------

CREATE TABLE ll7882_status(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (10) NOT NULL
	,CONSTRAINT ll7882_status_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ll7882_packagings
#------------------------------------------------------------

CREATE TABLE ll7882_packagings(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT ll7882_packagings_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ll7882_taxes
#------------------------------------------------------------

CREATE TABLE ll7882_taxes(
        id   Int  Auto_increment  NOT NULL ,
        rate Float NOT NULL
	,CONSTRAINT ll7882_taxes_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ll7882_timeslot_allocations
#------------------------------------------------------------

CREATE TABLE ll7882_timeslot_allocations(
        id              Int  Auto_increment  NOT NULL ,
        slot_allocation Time NOT NULL
	,CONSTRAINT ll7882_timeslot_allocations_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ll7882_menus
#------------------------------------------------------------

CREATE TABLE ll7882_menus(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT ll7882_menus_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ll7882_items
#------------------------------------------------------------

CREATE TABLE ll7882_items(
        id                   Int  Auto_increment  NOT NULL ,
        name                 Varchar (50) NOT NULL ,
        picture_small        Text NOT NULL ,
        picture_large        Text NOT NULL ,
        description          Varchar (250) NOT NULL ,
        taxe_free_price      Float NOT NULL ,
        stock                Int ,
        weight               Float ,
        size                 Varchar (50) ,
        release_date         Date NOT NULL ,
        id_ll7882_categories Int NOT NULL ,
        id_ll7882_packagings Int NOT NULL ,
        id_ll7882_taxes      Int NOT NULL ,
        id_ll7882_menus      Int NOT NULL
	,CONSTRAINT ll7882_items_PK PRIMARY KEY (id)

	,CONSTRAINT ll7882_items_ll7882_categories_FK FOREIGN KEY (id_ll7882_categories) REFERENCES ll7882_categories(id)
	,CONSTRAINT ll7882_items_ll7882_packagings0_FK FOREIGN KEY (id_ll7882_packagings) REFERENCES ll7882_packagings(id)
	,CONSTRAINT ll7882_items_ll7882_taxes1_FK FOREIGN KEY (id_ll7882_taxes) REFERENCES ll7882_taxes(id)
	,CONSTRAINT ll7882_items_ll7882_menus2_FK FOREIGN KEY (id_ll7882_menus) REFERENCES ll7882_menus(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ll7882_civilities
#------------------------------------------------------------

CREATE TABLE ll7882_civilities(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (10) NOT NULL
	,CONSTRAINT ll7882_civilities_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ll7882_users
#------------------------------------------------------------

CREATE TABLE ll7882_users(
        id                   Int  Auto_increment  NOT NULL ,
        lastname             Varchar (50) NOT NULL ,
        firstname            Varchar (50) NOT NULL ,
        birth_date           Date NOT NULL ,
        email                Varchar (100) NOT NULL ,
        password             Varchar (255) NOT NULL ,
        phone_number         Varchar (10) NOT NULL ,
        adress_number        Int NOT NULL ,
        adress               Varchar (150) NOT NULL ,
        appartment_number    Int ,
        postal_code          Int NOT NULL ,
        city                 Varchar (60) NOT NULL ,
        loyalty_card         Int ,
        registration_date    Date NOT NULL ,
        client_number        Varchar (10) NOT NULL ,
        id_ll7882_roles      Int NOT NULL ,
        id_ll7882_civilities Int NOT NULL
	,CONSTRAINT ll7882_users_PK PRIMARY KEY (id)

	,CONSTRAINT ll7882_users_ll7882_roles_FK FOREIGN KEY (id_ll7882_roles) REFERENCES ll7882_roles(id)
	,CONSTRAINT ll7882_users_ll7882_civilities0_FK FOREIGN KEY (id_ll7882_civilities) REFERENCES ll7882_civilities(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ll7882_orders
#------------------------------------------------------------

CREATE TABLE ll7882_orders(
        id                             Int  Auto_increment  NOT NULL ,
        order_date                     Datetime NOT NULL ,
        delivery_date                  Datetime NOT NULL ,
        total_price                    Float NOT NULL ,
        id_ll7882_users                Int NOT NULL ,
        id_ll7882_status               Int NOT NULL ,
        id_ll7882_timeslot_allocations Int NOT NULL
	,CONSTRAINT ll7882_orders_PK PRIMARY KEY (id)

	,CONSTRAINT ll7882_orders_ll7882_users_FK FOREIGN KEY (id_ll7882_users) REFERENCES ll7882_users(id)
	,CONSTRAINT ll7882_orders_ll7882_status0_FK FOREIGN KEY (id_ll7882_status) REFERENCES ll7882_status(id)
	,CONSTRAINT ll7882_orders_ll7882_timeslot_allocations1_FK FOREIGN KEY (id_ll7882_timeslot_allocations) REFERENCES ll7882_timeslot_allocations(id)
	,CONSTRAINT ll7882_orders_ll7882_users_AK UNIQUE (id_ll7882_users)
	,CONSTRAINT ll7882_orders_ll7882_timeslot_allocations0_AK UNIQUE (id_ll7882_timeslot_allocations)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: command_line
#------------------------------------------------------------

CREATE TABLE command_line(
        id_ll7882_orders Int NOT NULL ,
        id_ll7882_items  Int NOT NULL ,
        quantity         Int NOT NULL ,
        total_HT         Float NOT NULL ,
        total_TTC        Float NOT NULL
	,CONSTRAINT command_line_PK PRIMARY KEY (id_ll7882_orders,id_ll7882_items)

	,CONSTRAINT command_line_ll7882_orders_FK FOREIGN KEY (id_ll7882_orders) REFERENCES ll7882_orders(id)
	,CONSTRAINT command_line_ll7882_items0_FK FOREIGN KEY (id_ll7882_items) REFERENCES ll7882_items(id)
)ENGINE=InnoDB;

