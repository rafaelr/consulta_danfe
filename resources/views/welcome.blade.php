<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta DANFE Online Grátis e Rápida | Raztec</title>
  
    <meta name="description" content="Gerar DANFE online grátis a partir do XML ou da chave de acesso da NF-e. Visualize, baixe e imprima sua nota fiscal eletrônica em PDF de forma rápida e segura.">
    
    <meta name="keywords" content="gerar DANFE online, consulta DANFE, gerar DANFE pelo XML, DANFE PDF, gerar NF-e, nota fiscal eletrônica, chave de acesso NF-e, imprimir DANFE, baixar DANFE PDF, gerar CC-e online, validar NF-e">
    
    <meta name="robots" content="index, follow">
    <meta name="author" content="Raztec Tecnologia">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Gerar DANFE Online - Consulta NF-e pelo XML ou Chave de Acesso">
    <meta property="og:description" content="Gere, visualize e baixe seu DANFE online a partir do XML ou chave de acesso. Rápido, grátis e seguro.">
    <meta property="og:url" content="https://danfe.raztec.com.br">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://danfe.raztec.com.br/imagem-preview.jpg">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Gerar DANFE Online - Consulta NF-e pelo XML ou Chave de Acesso">
    <meta name="twitter:description" content="Gere, visualize e baixe seu DANFE online a partir do XML ou chave de acesso. Rápido, grátis e seguro.">
    <meta name="twitter:image" content="https://danfe.raztec.com.br/imagem-preview.jpg">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "su1krtxn9z");
</script>
  <style>
    body {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #e0eafc, #cfdef3);
    }
    .glass-form{
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      padding: 2rem;
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.3);
      margin: 15rem 0rem 2rem 0rem;
    }
    .content-section{
      background: #fff;
      border-radius: 10px;
      padding: 1.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    .content-section img {
      max-width: 100%;
      border-radius: 10px;
    }
    .faq h3 {
      margin-top: 1.5rem;
    }
    .bg {
      animation: slide 3s ease-in-out infinite alternate;
      background-image: linear-gradient(-60deg, #6c3 50%, #09f 50%);
      bottom: 0;
      left: -50%;
      opacity: .5;
      position: fixed;
      right: -50%;
      top: 0;
      z-index: -1;
    }
    .bg2 {
      animation-direction: alternate-reverse;
      animation-duration: 4s;
    }
    .bg3 {
      animation-duration: 5s;
    }
    @keyframes slide {
      0% {
        transform: translateX(-25%);
      }
      100% {
        transform: translateX(25%);
      }
    }
  </style>
</head>
<body>

  <div class="hero">
  <div class="bg"></div>
  <div class="bg bg2"></div>
  <div class="bg bg3"></div>

  <div class="container">
    <!-- Existing Form Section -->
    <div class="glass-form">
      <div class="text-center mb-4">
        <h1 style="font-family: 'Roboto', sans-serif; font-size: 2.5rem; color: #fff;">
          Consulta <span style="background: #fff; color: #007bff; font-weight: bold; text-transform: uppercase; padding: 0.2rem 0.5rem; border-radius: 5px;">DANFE</span>
        </h1>
        <p class="text-muted">Powered by <strong><a href="https://raztec.com.br" target="_blank" class="text-decoration-none text-white">Raztec</a></strong></p>
      </div>
      <form action="" method="POST">
        @csrf
        <div class="mb-3">
          <label for="chaveAcesso" class="form-label">Chave de Acesso</label>
          <input type="text" class="form-control" id="chaveAcesso" name="chaveAcesso" placeholder="Digite a chave de acesso" required>
        </div>
        <div class="mb-3">
          <label for="tipoArquivo" class="form-label">Tipo de Arquivo</label>
          <select class="form-select" id="tipoArquivo" name="tipoArquivo" required>
            <option value="pdf">PDF</option>
            <option value="xml">XML</option>
            <option value="json">JSON</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Consultar</button>
      </form>
    </div>

    <!-- Section: O que é DANFE e Como Consultar sua DANFE -->
    <div class="row">
      <div class="col-md-6">
      <div class="content-section">
        <h2>O que é DANFE?</h2>
        <p>O Documento Auxiliar da Nota Fiscal Eletrônica (DANFE) é uma representação simplificada da Nota Fiscal Eletrônica (NF-e). Ele contém informações essenciais da NF-e, como a chave de acesso de 44 dígitos, que permite consultar a nota fiscal completa no ambiente da SEFAZ.</p>
      </div>
      </div>
      <div class="col-md-6">
      <div class="content-section">
        <h2>Como Consultar sua DANFE aqui?</h2>
        <ol>
        <li>Tenha em mãos a chave de acesso de 44 dígitos presente na sua DANFE.</li>
        <li>Digite a chave no campo acima.</li>
        <li>Clique em "Consultar" para visualizar sua NF-e completa.</li>
        </ol>
      </div>
      </div>
    </div>

    <!-- Section: FAQ -->
    <div class="content-section faq">
      <h2>Perguntas Frequentes</h2>
      <h3>Qual a diferença entre DANFE e NF-e?</h3>
      <p>A NF-e é o documento fiscal eletrônico armazenado digitalmente, enquanto o DANFE é apenas uma representação física ou visual da NF-e, usado para acompanhar mercadorias e facilitar consultas.</p>

      <h3>É seguro consultar minha DANFE neste site?</h3>
      <p>Sim, a consulta é feita diretamente no ambiente da SEFAZ, garantindo a segurança e veracidade dos dados. Nenhuma informação é armazenada.</p>

      <h3>O que fazer se a chave de acesso for inválida?</h3>
      <p>Verifique se a chave de acesso foi digitada corretamente. Caso o problema persista, entre em contato com o emissor da nota fiscal.</p>

      <h3>Posso consultar DANFE sem certificado digital?</h3>
      <p>Sim, nossa ferramenta permite a consulta sem a necessidade de certificado digital.</p>

      <h3>A consulta de DANFE neste site é gratuita?</h3>
      <p>Sim, a consulta é 100% gratuita.</p>
    </div>
  <script>
  document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();
    const chaveAcessoEl = document.getElementById('chaveAcesso');
    let chaveAcesso = chaveAcessoEl.value || '';

    // Detecta e remove todos os espaços em branco (inclui espaços no meio, tabs, quebras de linha)
    if (/\s/.test(chaveAcesso)) {
      chaveAcesso = chaveAcesso.replace(/\s+/g, '');
      chaveAcessoEl.value = chaveAcesso; // atualiza o campo com a versão sem espaços
    }

    if (chaveAcesso === '') {
      alert('Por favor, insira a chave de acesso.');
      chaveAcessoEl.focus();
      return;
    }

    // Regex: apenas números
    if (!/^\d+$/.test(chaveAcesso)) {
      alert('A chave de acesso deve conter apenas números (0-9).');
      chaveAcessoEl.focus();
      return;
    }

    if (chaveAcesso.length !== 44) {
      alert('A chave de acesso deve conter 44 dígitos.');
      chaveAcessoEl.focus();
      return;
    }

    const form = event.target;
    let actionUrlPdf = "{{ route('nfe.download.pdf', 'value') }}";
    let actionUrlXml = "{{ route('nfe.download.xml', 'value') }}";
    let actionUrlJson = "{{ route('nfe.download.default', 'value') }}";

    let tipoArquivo = document.getElementById('tipoArquivo').value;
    let actionUrl = tipoArquivo === 'pdf' ? actionUrlPdf : (tipoArquivo === 'xml' ? actionUrlXml : actionUrlJson);
    actionUrl = actionUrl.replace('value', chaveAcesso);

    form.action = actionUrl;
    form.target = '_blank';
    form.submit();
  });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>