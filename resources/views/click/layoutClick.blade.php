<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Progettazione Web')</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Font Awesome per icone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-xXz..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS personalizzato -->
    <style>
        body {
            background: #f8f9fa;
        }
        .card {
            border-radius: 12px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('click.index') }}">
                <i class="fa-solid fa-warehouse"></i> Progettazione Web
            </a>
        </div>
    </nav>

        <style>
        :root {
            --card: #ffffff;
            --line: #d9dee3;
            --text: #1f2933;
            --head: #eef2f6;
            --copy: #174ea6;
            --copy-ok: #1f7a39;
        }
        .pg-wrapper { width: 100%; max-width: none; margin: 24px 0; padding: 0; }
        .pg-card { background: var(--card); border: 1px solid var(--line); border-radius: 12px; box-shadow: 0 10px 30px rgba(15,23,42,.08); overflow: hidden; }
        .pg-card-header { padding: 16px 20px; border-bottom: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap; }
        .pg-card-header h1 { margin: 0; font-size: 20px; font-weight: 700; }
        .pg-hint { margin: 0; font-size: 13px; color: #52606d; }
        .pg-selects { display: flex; gap: 12px; flex-wrap: wrap; align-items: center; }
        .pg-selects select { padding: 7px 12px; border: 1px solid var(--line); border-radius: 8px; font-size: 14px; color: var(--text); background: #fff; min-width: 220px; }
        .pg-selects select:disabled { opacity: .5; cursor: not-allowed; }
        .pg-table-wrap { width: 100%; overflow-x: auto; overflow-y: visible; }
        .pg-table { width: 100%; border-collapse: collapse; min-width: 1180px; }
        .pg-table th, .pg-table td { border: 1px solid #1f2933; padding: 7px 8px; font-size: 12px; text-align: center; vertical-align: middle; }
        .pg-table th { background: var(--head); font-weight: 700; position: sticky; top: 0; z-index: 1; }
        .pg-copy-cell { white-space: nowrap; }
        .pg-cell-copied { background: #d8f3dc !important; }
        .pg-copy-btn { border: 0; background: transparent; color: var(--copy); margin-left: 6px; cursor: pointer; padding: 2px 4px; border-radius: 4px; }
        .pg-copy-btn:hover { background: rgba(23,78,166,.1); }
        .pg-copy-btn.copied { color: var(--copy-ok); }
    </style>

    <main class="container-fluid px-0">
        @yield('content')
    </main>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        async function pgCopy(btn, value) {
            const text = (value ?? '').toString();
            const td = btn.closest('td');
            try {
                await navigator.clipboard.writeText(text);
                td.classList.add('pg-cell-copied');
                btn.classList.add('copied');
                btn.querySelector('i').className = 'fa fa-check';
                setTimeout(() => {
                    td.classList.remove('pg-cell-copied');
                    btn.classList.remove('copied');
                    btn.querySelector('i').className = 'fa fa-copy';
                }, 1400);
            } catch {
                alert('Copia non riuscita. Verifica i permessi del browser.');
            }
        }
    </script>
</body>
</html>
