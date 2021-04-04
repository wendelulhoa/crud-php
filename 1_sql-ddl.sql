CREATE DATABASE projeto_faculdade CHARACTER SET utf8 COLLATE utf8_general_ci;
use projeto_faculdade;
create table pessoa(
	id int primary key not null auto_increment,
    nome varchar(40),
    endereco varchar(40)
);
create table telefone(
	id int primary key not null auto_increment,
    numero char(15),
    cod_pessoa int not null
);
create table estudante(
	id int primary key not null auto_increment,
    email varchar(50),
    cod_pessoa int not null,
    cod_republica int not null
);
create table republica(
	id int primary key not null auto_increment,
    nome varchar(40),
    endereco varchar(40) 
);

-- alter table estudante add CONSTRAINT cod_republica FOREIGN KEY (cod_republica) REFERENCES republica (id);
-- alter table estudante add CONSTRAINT cod_pessoa FOREIGN KEY (cod_pessoa) REFERENCES pessoa (id);
-- alter table telefone add CONSTRAINT cod_pessoa FOREIGN KEY (cod_pessoa) REFERENCES pessoa (id);

