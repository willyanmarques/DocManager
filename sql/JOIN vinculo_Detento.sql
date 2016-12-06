SELECT a.oab, a.nome as nome_advogado, d.prontuario, d.nome as nome_detento FROM advogado a 
JOIN advogado_detento AD ON AD.advogado_id = a.id
JOIN detento d ON d.id = AD.detento_id