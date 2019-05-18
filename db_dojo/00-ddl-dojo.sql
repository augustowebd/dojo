-- CREATE DATABASE dojo;

-- CREATE SCHEMA dojo;

CREATE SEQUENCE dojo.endereco_id_endereco_seq;
CREATE SEQUENCE dojo.infracao_id_infracao_seq;
CREATE SEQUENCE dojo.notificacao_id_notificacao_seq;
CREATE SEQUENCE dojo.usuario_id_usuario_seq;

CREATE TABLE dojo.usuario
(
    id bigint NOT NULL DEFAULT nextval('dojo.usuario_id_usuario_seq'::regclass),
    tx_nome character varying(100) COLLATE pg_catalog."default" NOT NULL,
    tx_email character varying(255) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT pk_usuario PRIMARY KEY (id)
);

CREATE TABLE dojo.endereco
(
    id bigint NOT NULL DEFAULT nextval('dojo.endereco_id_endereco_seq'::regclass),
    id_dono bigint NOT NULL,
    tx_endereco character varying(255) NOT NULL,
    CONSTRAINT pk_endereco PRIMARY KEY (id),
    CONSTRAINT fk_endereco_dono FOREIGN KEY (id_dono)
        REFERENCES dojo.usuario (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

CREATE TABLE dojo.infracao
(
    id bigint NOT NULL DEFAULT nextval('dojo.infracao_id_infracao_seq'::regclass),
    tx_infracao character varying(255) NOT NULL,
    vl_infracao money,
    dt_infracao timestamp without time zone,
    id_infrator bigint NOT NULL,
    CONSTRAINT infracao_pkey PRIMARY KEY (id),
    CONSTRAINT fk_infracao_infrator FOREIGN KEY (id_infrator)
        REFERENCES dojo.usuario (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

CREATE TABLE dojo.notificacao
(
    id bigint NOT NULL DEFAULT nextval('dojo.notificacao_id_notificacao_seq'::regclass),
    id_endereco bigint NOT NULL,
    id_infracao bigint NOT NULL,
    dt_notificacao timestamp without time zone NOT NULL,
    is_notificou boolean,
    CONSTRAINT notificacao_pkey PRIMARY KEY (id)
);
