USE sistema_menus;

SELECT 
    c.idcarta,
    c.nombreplato,
    c.precio,
    c.foto,
    cat.idcategoria,
    cat.categoria
FROM cartas AS c
INNER JOIN locales AS l ON c.idlocales = l.idlocales
INNER JOIN negocios AS n ON l.idnegocio = n.idnegocio
INNER JOIN categorias AS cat ON n.idcategoria = cat.idcategoria
WHERE cat.categoria = 'Vitinicolas';
