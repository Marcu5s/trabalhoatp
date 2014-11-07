create table cantidatos(

   cand_id int  not null auto_increment primary key,
   cand_data_geracao date,
   cand_hora_geracao time,
   cand_ano_eleicao int(4),
   cand_num_turno int,
   cand_descricao_eleicao varchar(255),
   cand_sigla_uf varchar(2),
   cand_sigla_ue varchar(4),
   cand_descricao_ue varchar(255),
   cand_codigo_cargo int,
   cand_descricao_cargo varchar(255),
   cand_nome_canditato varchar(255),
   cand_sequencial_candidato int, 
   cand_numero_candidato int,
   cand_nome_urna_candidato varchar(255),
   cand_cod_situacao_candidatura varchar(50),
   cand_desc_situacao_candidatura varchar(255),
   cand_numero_partido int,
   cand_sigla_partido varchar(10),
   cand_nome_pardido varchar(255),
   cand_codigo_lengenda int,
   cand_sigla_lengenda varchar(7),
   cand_composicao_legenda varchar(255),
   cand_nome_legenda varchar(255),
   cand_codigo_ocupacao int,
   cand_descricao_ocupacao varchar(255),
   cand_data_nascimento date,
   cand_num_titulo_eleitoral_candidato varchar(40),
   cand_idade_data_eleicao date,
   cand_codigo_sexo int,
   cand_descricao_sexo varchar(30),
   cand_grau_instrucao int,
   cand_descricao_grau_instrucao varchar(255),
   cand_codigo_estado_civil int,
   cand_descricao_estado_civil varchar(255),
   cand_cor_raca int,
   cand_descricao_cor_raca varchar(50),
   cand_codigo_nacionalidade int, 
   cand_descricao_nacionalidade varchar(255),
   cand_uf_nascimento varchar(3),
   cand_municipio_nascimento int,
   cand_nome_municipio_nascimento varchar(255),
   cand_despesa_max_campanha float,
   cand_sit_tot_turno int,
   cand_desc_sit_tot_turno varchar(255)
   
   )
   
   
   
   
   
   
)

