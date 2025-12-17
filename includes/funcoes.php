<?php

// --  FORMATAR TELEFONES
function formatarTelefone($numero) {
    // Remove tudo que não for número
    $numero = preg_replace('/\D/', '', $numero);

    // Verifica se tem DDD + número com 9 dígitos (celular)
    if (preg_match('/^(\d{2})(\d{5})(\d{4})$/', $numero, $matches)) {
        return "({$matches[1]}) {$matches[2]}-{$matches[3]}";
    }

    // Verifica se tem DDD + número com 8 dígitos (fixo)
    if (preg_match('/^(\d{2})(\d{4})(\d{4})$/', $numero, $matches)) {
        return "({$matches[1]}) {$matches[2]}-{$matches[3]}";
    }

    // Retorna como está se não combinar
    return $numero;
}

// -- FORMATAR DOCUMENTOS
function formatarCPF($cpf) {
    $cpf = preg_replace('/\D/', '', $cpf);
    return preg_match('/^\d{11}$/', $cpf)
        ? substr($cpf, 0, 3) . '.' .
          substr($cpf, 3, 3) . '.' .
          substr($cpf, 6, 3) . '-' .
          substr($cpf, 9, 2)
        : $cpf;
}

function formatarRG($rg) {
    $rg = preg_replace('/\D/', '', $rg);
    return preg_match('/^\d{9}$/', $rg)
        ? substr($rg, 0, 2) . '.' .
          substr($rg, 2, 3) . '.' .
          substr($rg, 5, 3) . '-' .
          substr($rg, 8, 1)
        : $rg;
}


// -- FORMATAR DATAS DO BANCO DE DADOS
function formatarData($data) {
    // Verifica se a data é nula, vazia ou a data "zerada" do MySQL
    if (empty($data) || $data === '0000-00-00') {
        // Se for inválida, retorna uma string vazia (não mostra nada na tela)
        return '';
    }

    // Se for uma data válida, formata e retorna no padrão dia/mês/ano
    return date('d/m/Y', strtotime($data));
}

?>

