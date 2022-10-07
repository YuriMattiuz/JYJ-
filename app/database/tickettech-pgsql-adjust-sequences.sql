SELECT setval('filmes_id_seq', coalesce(max(id),0) + 1, false) FROM filmes;
SELECT setval('funcionarios_id_seq', coalesce(max(id),0) + 1, false) FROM funcionarios;
SELECT setval('poltronas_id_seq', coalesce(max(id),0) + 1, false) FROM poltronas;
SELECT setval('salas_id_seq', coalesce(max(id),0) + 1, false) FROM salas;
SELECT setval('usuarios_id_seq', coalesce(max(id),0) + 1, false) FROM usuarios;
SELECT setval('vendas_id_seq', coalesce(max(id),0) + 1, false) FROM vendas;