SELECT DISTINCT
  vse.id_unidade_org_saida,
  vuo.orgao
FROM
  v_saida_estoque vse,
  v_unidade_org vuo
WHERE
    vse.id_unidade_org_saida = vuo.id_unidade_org
AND
    vse.id_unidade_org = '83'
AND
    TRUNC(DT_ENTREGA) BETWEEN TO_DATE('01/03/2014', 'DD/MM/YYYY') AND TO_DATE(
    '13/03/2014', 'DD/MM/YYYY')
ORDER BY
  vuo.orgao