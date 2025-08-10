<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta DANFE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Consulta DANFE</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="text-center">
            <h1 class="mb-4">Bem-vindo ao Consulta DANFE</h1>
            <p class="lead">Insira a chave de acesso para consultar o DANFE de sua nota fiscal.</p>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <form action="" method="POST" class="bg-light p-4 rounded shadow">
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
    </div>

    <footer class="bg-light text-center py-3 mt-5">
        <p class="mb-0">© {{ date('Y') }} Consulta DANFE. Todos os direitos reservados.</p>
    </footer>

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