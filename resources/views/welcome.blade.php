<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta DANFE</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #e0eafc, #cfdef3);
        }
        .glass-form {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        html {
  height:100%;
}

body {
  margin:0;
}

.bg {
  animation:slide 3s ease-in-out infinite alternate;
  background-image: linear-gradient(-60deg, #6c3 50%, #09f 50%);
  bottom:0;
  left:-50%;
  opacity:.5;
  position:fixed;
  right:-50%;
  top:0;
  z-index:-1;
}

.bg2 {
  animation-direction:alternate-reverse;
  animation-duration:4s;
}

.bg3 {
  animation-duration:5s;
}

.content {
  background-color:rgba(255,255,255,.8);
  border-radius:.25em;
  box-shadow:0 0 .25em rgba(0,0,0,.25);
  box-sizing:border-box;
  left:50%;
  padding:10vmin;
  position:fixed;
  text-align:center;
  top:50%;
  transform:translate(-50%, -50%);
}

h1 {
  font-family:monospace;
}

@keyframes slide {
  0% {
    transform:translateX(-25%);
  }
  100% {
    transform:translateX(25%);
  }
}
    </style>
</head>
<body>
    <div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
    <div class="container d-flex justify-content-center align-items-center h-100">
        <div class="col-md-6">
            <div class="text-center mb-4">
         
                <h1 style="font-family: 'Roboto', sans-serif; font-size: 2.5rem; color: #fff;">
                    Consulta <span style="background: #fff; color: #007bff; font-weight: bold; text-transform: uppercase; padding: 0.2rem 0.5rem; border-radius: 5px;">DANFE</span>
                </h1>
                <p class="text-muted">Powered by <strong><a href="https://raztec.com.br" target="_blank" class="text-decoration-none text-white">Raztec</a></strong></p>
            </div>
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
            <form action="" method="POST" class="glass-form">
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
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();
            const chaveAcesso = document.getElementById('chaveAcesso').value;
            const tipoArquivo = document.getElementById('tipoArquivo').value;

            if (chaveAcesso.trim() === '') {
                alert('Por favor, insira a chave de acesso.');
                return;
            }

            const form = event.target;
            let actionUrlPdf = "{{ route('nfe.download.pdf', 'value') }}";
            let actionUrlXml = "{{ route('nfe.download.xml', 'value') }}";
            let actionUrlJson = "{{ route('nfe.download.default', 'value') }}";

            let actionUrl = tipoArquivo === 'pdf' ? actionUrlPdf : (tipoArquivo === 'xml' ? actionUrlXml : actionUrlJson);
            actionUrl = actionUrl.replace('value', chaveAcesso);
            form.action = actionUrl;
            form.submit();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>