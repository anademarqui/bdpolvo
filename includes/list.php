<?php
require_once("includes/conexao.php");

// FILTROS 
$busca = $_GET['busca'] ?? '';
$filtro_status = $_GET['filtro_status'] ?? 'Todos';
$filtro_adimplencia = $_GET['filtro_adimplencia'] ?? 'Todos';
$filtro_aniversario = $_GET['filtro_aniversario'] ?? 'Todos';

$where_clauses = [];

// Busca por nome, cpf ou matrícula
if (!empty($busca)) {
    $busca_segura = $mysqli->real_escape_string($busca);
    $where_clauses[] = "(s.nome LIKE '%$busca_segura%' OR s.cpf LIKE '%$busca_segura%' OR s.matricula LIKE '%$busca_segura%')";
}

// Status (Ativo, Inativo, Suspenso)
if ($filtro_status !== 'Todos') {
    $status_seguro = $mysqli->real_escape_string($filtro_status);
    $where_clauses[] = "s.stat = '$status_seguro'";
}

// Aniversário
if ($filtro_aniversario === 'MesAtual') {
    $where_clauses[] = "MONTH(s.data_nascimento) = MONTH(CURDATE())";
} elseif ($filtro_aniversario === 'ProximoMes') {
    $where_clauses[] = "MONTH(s.data_nascimento) = MONTH(CURDATE() + INTERVAL 1 MONTH)";
}

// Se o filtro for "Inadimplente", mostrar apenas sócios ativos
if ($filtro_adimplencia === 'Inadimplente') {
    $where_clauses[] = "s.stat = 'Ativo(a)'";
}


$sql = "
    SELECT 
        s.*, 
        e.cidade,
        p.vencimento
    FROM 
        socios s
    LEFT JOIN 
        endereco_socios e ON s.id = e.id_socio
    LEFT JOIN (
        SELECT id_socio, MAX(data_pg) as max_data_pg
        FROM pagamento
        GROUP BY id_socio
    ) AS ultimos_pagamentos ON s.id = ultimos_pagamentos.id_socio
    LEFT JOIN 
        pagamento p ON ultimos_pagamentos.id_socio = p.id_socio AND ultimos_pagamentos.max_data_pg = p.data_pg
";

if (!empty($where_clauses)) {
    $sql .= " WHERE " . implode(' AND ', $where_clauses);
}
$sql .= " ORDER BY s.matricula DESC";



// FILTRO DE ADIMPLÊNCIA
$resultados_brutos = $mysqli->query($sql);
$socios_filtrados = [];

if ($resultados_brutos) {
    while ($row = $resultados_brutos->fetch_assoc()) {
        $adimplencia_calculada = 'Inadimplente';

        if (!empty($row['vencimento'])) {
            $vencimento_correto = new DateTime($row['vencimento']);
            $hoje = new DateTime();
            
            if ($hoje->format('Y-m-d') <= $vencimento_correto->format('Y-m-d')) {
                $adimplencia_calculada = 'Adimplente';
            }
        }
        
        // Se o filtro de adimplência for "Todos", ou se o status calculado bate com o filtro
        if ($filtro_adimplencia === 'Todos' || $filtro_adimplencia === $adimplencia_calculada) {
            $row['adimplencia_calculada'] = $adimplencia_calculada;
            $socios_filtrados[] = $row;
        }
    }
}


// CARDS
$total = $mysqli->query("SELECT COUNT(*) as c FROM socios")->fetch_assoc()['c'];
$ativos = $mysqli->query("SELECT COUNT(*) as c FROM socios WHERE stat = 'Ativo(a)'")->fetch_assoc()['c'];

$contagem_adimplentes = 0;

$todos_socios_ativos = $mysqli->query("
    SELECT 
        s.id, 
        p.vencimento
    FROM socios s 
    LEFT JOIN (
        SELECT id_socio, MAX(data_pg) as max_data_pg 
        FROM pagamento 
        GROUP BY id_socio
    ) up ON s.id = up.id_socio 
    LEFT JOIN pagamento p ON up.id_socio = p.id_socio AND up.max_data_pg = p.data_pg -- MUDANÇA 7
    WHERE s.stat = 'Ativo(a)'
");

if ($todos_socios_ativos) {
    while($socio = $todos_socios_ativos->fetch_assoc()){
        if (!empty($socio['vencimento'])) {
            $vencimento_correto = new DateTime($socio['vencimento']);
            $hoje = new DateTime();
            
            if ($hoje->format('Y-m-d') <= $vencimento_correto->format('Y-m-d')) {
                $contagem_adimplentes++;
            }
        }
    }
}

$adimplentes = $contagem_adimplentes;
$inadimplentes = $ativos - $adimplentes;

?>