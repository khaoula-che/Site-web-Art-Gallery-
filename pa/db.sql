create table ADRESSE(
	id_adresse INTEGER PRIMARY KEY,
	ville varchar(100),
	cp char(5),
	rue varchar(100) ,
	n_appartement INTEGER
);
create table ARTISTE(
	nom varchar(100) ,
	prenom varchar(100) ,
	pseudo varchar(64) ,
	email varchar(255) ,
	pwd varchar(12) ,
	id INTEGER  primary key,
	token varchar(255)
);

create table ARTICLE(
	id_article INTEGER  primary key,
	nom varchar(100) ,
	description varchar(255),
	prix decimal(10,2),
	id_artiste INTEGER ,
	image varchar(255) ,
	type_oeuvre varchar(20) ,
	foreign key (id_artiste) references ARTISTE (id)
);
create table BLOG(
	id_blog integer  primary key,
	contenu CLOB,
	image varchar(255) ,
	id_artiste,
	titre varchar(100),
	foreign key (id_artiste) references ARTISTE (id)
);
create table EVENEMENT(
    id_evenement INTEGER primary key,
	date_evenement date,
	heure_debut timestamp ,
	heure_fin timestamp ,
	adresse varchar(100) ,
	id_artiste integer ,
	image varchar(255) ,
	titre varchar(50) ,
	date_creation DATE DEFAULT CURRENT_TIMESTAMP,
	description CLOB,
	foreign key (id_artiste) references ARTISTE (id)
);

create table NEWSLETTER (
	email varchar(120),
	id integer primary key
);
create table CLIENT (
	nom varchar(100),
	prenom varchar(100),
	pseudo varchar(64),
	email varchar(255),
	pwd varchar(12) ,
	adresse INTEGER,
	id integer  primary key,
	token varchar(255) ,
	foreign key (adresse) references ADRESSE (id_adresse)
);
create table COMMENTAIRE (
	id_commentaire INTEGER primary key,
	texte varchar(255) ,
	date_creation timestamp default current_timestamp,
	id_client INTEGER,
	id_article INTEGER,
    foreign key (id_client) references CLIENT (id) ON DELETE CASCADE,
	foreign key (id_article) references ARTICLE (id_article) ON DELETE CASCADE
);
create table FAVORIS (
	id INTEGER primary key,
	id_user INTEGER,
	id_article INTEGER,
	foreign key (id_user) references CLIENT (id) ON DELETE CASCADE,
	foreign key (id_article) references ARTICLE (id_article) ON DELETE CASCADE
);
create table IMAGE_PROFIL (
	id INTEGER  primary key,
	image varchar(255),
	id_client INTEGER,
	id_artiste INTEGER,
	foreign key (id_artiste) references ARTISTE (id),
	foreign key (id_client) references CLIENT (id) on delete cascade
);
create table INSCRIRE (
	id_evenement INTEGER,
	id_participant INTEGER,
	id_inscription INTEGER primary key,
	foreign key (id_evenement) references EVENEMENT (id_evenement),
	foreign key (id_participant) references CLIENT (id)
);
create table MESSAGE (
	id_message INTEGER primary key,
	date_creation timestamp default current_timestamp ,
	id_artiste INTEGER,
	id_client integer,
	foreign key (id_client) references CLIENT (id),
	foreign key (id_artiste) references ARTISTE (id)
);
create table PANIER (
	id_panier integer primary key,
	id_client integer,
	foreign key (id_client) references CLIENT (id)
);
create table PANIER_COMPORTE (
	id_panier integer not null,
	id_article integer not null,
	quantite integer,
	primary key (id_panier, id_article),
	foreign key (id_panier) references PANIER (id_panier),
	foreign key (id_article) references ARTICLE (id_article)
);
create table RESET_PASSWORD(
	id INTEGER  primary key,
	email varchar(255) ,
	token varchar(255) ,
	client INTEGER ,
	artiste INTEGER,
	foreign key (client) references CLIENT (id),
	foreign key (artiste) references ARTISTE (id)
);
