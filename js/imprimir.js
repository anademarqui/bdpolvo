/**
 * Função para imprimir uma seção específica da página, mantendo toda a estilização.
 * @param {string} idElemento - O ID do elemento HTML que deve ser impresso.
 */
function imprimirSecao(idElemento) {
    
    // 1. Captura o conteúdo HTML da área que queremos imprimir
    const conteudoParaImprimir = document.getElementById(idElemento).innerHTML;

    // 2. Abre uma nova janela (popup) para a impressão
    const janelaImpressao = window.open('', '', 'height=800,width=1024');

    // 3. Escreve a estrutura HTML básica na nova janela
    janelaImpressao.document.write('<html><head><title>Imprimir</title>');

    // 4. Pega TODOS os links CSS e tags <style> da página ATUAL (O pulo do gato!)
    const estilos = document.querySelectorAll('head link[rel="stylesheet"], head style');

    // 5. Adiciona cada tag de estilo na <head> da nova janela
    estilos.forEach(estilo => {
        janelaImpressao.document.write(estilo.outerHTML);
    });

    // 6. Adiciona estilos extras, específicos para a impressão
    janelaImpressao.document.write(`
        <style>
            /* Esconde elementos que não devem aparecer na impressão (ex: o próprio botão) */
            .d-print-none {
                display: none !important;
            }
            
            /* Garante que os fundos coloridos (badges, cabeçalho da tabela) sejam impressos */
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Remove fundos da página e card para economizar tinta */
            body, .card {
                background-color: #fff !important;
                color: #000 !important;
                border: none !important;
                box-shadow: none !important;
            }

            /* Garante que o container ocupe a largura total */
            .container {
                width: 100% !important;
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }
        </style>
    `);

    // 7. Fecha a <head> e abre o <body>
    janelaImpressao.document.write('</head><body>');
    
    // 8. Insere o conteúdo que capturamos dentro do <body>
    janelaImpressao.document.write(conteudoParaImprimir);
    
    // 9. Fecha o <body> e <html>
    janelaImpressao.document.write('</body></html>');

    // 10. Fecha o documento para escrita
    janelaImpressao.document.close();
    janelaImpressao.focus(); // Foca na nova janela

    // 11. Espera um pequeno tempo para garantir que o CSS carregou e chama a impressão
    setTimeout(function () {
        janelaImpressao.print();
        janelaImpressao.close();
    }, 750); // 750ms é um tempo seguro para carregar os estilos
}