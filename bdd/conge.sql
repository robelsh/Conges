/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  24/05/2013 08:13:09                      */
/*==============================================================*/


drop table if exists ANNEE;

drop table if exists CONGES;

drop table if exists EMPLOYE;

drop table if exists JOUR_FERIE;

/*==============================================================*/
/* Table : ANNEE                                                */
/*==============================================================*/
create table ANNEE
(
   ANNEE                int not null,
   primary key (ANNEE)
);

/*==============================================================*/
/* Table : CONGES                                               */
/*==============================================================*/
create table CONGES
(
   IDENTIFIANT          varchar(20) not null,
   ID_CONGE             int not null,
   ANNEE                int not null,
   DATE                 date,
   MATIN                bool,
   APRES                bool,
   primary key (IDENTIFIANT, ID_CONGE)
);

/*==============================================================*/
/* Table : EMPLOYE                                              */
/*==============================================================*/
create table EMPLOYE
(
   IDENTIFIANT          varchar(20) not null,
   NOM                  varchar(20),
   PRENOM               varchar(20),
   SOLDE                int,
   MOTDEPASSE           varchar(20),
   primary key (IDENTIFIANT)
);

/*==============================================================*/
/* Table : JOUR_FERIE                                           */
/*==============================================================*/
create table JOUR_FERIE
(
   ANNEE                int not null,
   ID_JOURFERIE         varchar(20) not null,
   DATE_FERIE           date,
   primary key (ANNEE, ID_JOURFERIE)
);

alter table CONGES add constraint FK_CONTIENT foreign key (IDENTIFIANT)
      references EMPLOYE (IDENTIFIANT) on delete restrict on update restrict;

alter table CONGES add constraint FK_POSSEDE foreign key (ANNEE)
      references ANNEE (ANNEE) on delete restrict on update restrict;

alter table JOUR_FERIE add constraint FK_A foreign key (ANNEE)
      references ANNEE (ANNEE) on delete restrict on update restrict;

