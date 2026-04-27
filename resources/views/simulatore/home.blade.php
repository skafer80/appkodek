<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open FSE - Accessi Rapidi</title>
    <style>
        :root {
            --page-bg: #f6f1e8;
            --panel: rgba(255, 252, 246, 0.78);
            --panel-border: rgba(86, 66, 44, 0.12);
            --text: #2f241b;
            --muted: #6c5a4a;
            --accent: #b85c38;
            --accent-dark: #8f4326;
            --accent-soft: #ead8c7;
            --shadow: 0 24px 60px rgba(73, 50, 29, 0.16);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(184, 92, 56, 0.16), transparent 30%),
                radial-gradient(circle at bottom right, rgba(86, 117, 95, 0.18), transparent 28%),
                linear-gradient(135deg, #efe4d3 0%, #f9f4ec 48%, #efe5d4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 18px;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            inset: auto;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            filter: blur(12px);
            z-index: 0;
            opacity: 0.55;
        }

        body::before {
            top: -90px;
            right: -70px;
            background: rgba(184, 92, 56, 0.16);
        }

        body::after {
            bottom: -90px;
            left: -70px;
            background: rgba(109, 135, 102, 0.18);
        }

        .shell {
            position: relative;
            z-index: 1;
            width: min(1100px, 100%);
            background: var(--panel);
            border: 1px solid var(--panel-border);
            border-radius: 28px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(14px);
            overflow: hidden;
        }

        .hero {
            padding: 44px 44px 28px;
            background:
                linear-gradient(135deg, rgba(184, 92, 56, 0.14), rgba(255, 255, 255, 0)),
                linear-gradient(180deg, rgba(255, 255, 255, 0.52), rgba(255, 255, 255, 0));
            border-bottom: 1px solid rgba(86, 66, 44, 0.08);
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.65);
            color: var(--accent-dark);
            font-size: 0.83rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .eyebrow::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 0 6px rgba(184, 92, 56, 0.14);
        }

        h1 {
            margin: 20px 0 14px;
            font-size: clamp(2.3rem, 4vw, 4.2rem);
            line-height: 0.94;
            letter-spacing: -0.04em;
            max-width: 8ch;
        }

        .hero p {
            margin: 0;
            max-width: 700px;
            font-size: 1.02rem;
            line-height: 1.75;
            color: var(--muted);
        }

        .content {
            padding: 30px 44px 44px;
        }

        .section-head {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px;
        }

        .section-head h2 {
            margin: 0;
            font-size: 1.2rem;
            letter-spacing: -0.02em;
        }

        .section-head span {
            color: var(--muted);
            font-size: 0.95rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 18px;
            min-height: 210px;
            padding: 24px;
            text-decoration: none;
            color: inherit;
            border-radius: 22px;
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.9), rgba(250, 245, 238, 0.9)),
                var(--accent-soft);
            border: 1px solid rgba(86, 66, 44, 0.08);
            box-shadow: 0 14px 30px rgba(73, 50, 29, 0.08);
            overflow: hidden;
            transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease;
        }

        .card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(184, 92, 56, 0.14), transparent 55%);
            opacity: 0;
            transition: opacity 180ms ease;
        }

        .card:hover,
        .card:focus-visible {
            transform: translateY(-6px);
            box-shadow: 0 22px 40px rgba(73, 50, 29, 0.14);
            border-color: rgba(184, 92, 56, 0.24);
        }

        .card:hover::before,
        .card:focus-visible::before {
            opacity: 1;
        }

        .card:focus-visible {
            outline: 3px solid rgba(184, 92, 56, 0.22);
            outline-offset: 4px;
        }

        .badge {
            position: relative;
            z-index: 1;
            width: fit-content;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.84);
            color: var(--accent-dark);
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .card-title {
            position: relative;
            z-index: 1;
            margin: 0;
            font-size: 1.55rem;
            letter-spacing: -0.03em;
        }

        .card-copy {
            position: relative;
            z-index: 1;
            margin: 0;
            color: var(--muted);
            line-height: 1.65;
            font-size: 0.95rem;
        }

        .card-action {
            position: relative;
            z-index: 1;
            margin-top: auto;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--accent-dark);
            font-weight: 700;
        }

        .card-action::after {
            content: "->";
            font-size: 1rem;
            transform: translateX(0);
            transition: transform 180ms ease;
        }

        .card:hover .card-action::after,
        .card:focus-visible .card-action::after {
            transform: translateX(4px);
        }

        .footer-note {
            margin-top: 26px;
            padding: 16px 18px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.55);
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.6;
        }

        @media (max-width: 720px) {

            .hero,
            .content {
                padding-left: 22px;
                padding-right: 22px;
            }

            .hero {
                padding-top: 28px;
            }

            .content {
                padding-bottom: 28px;
            }

            .section-head {
                align-items: start;
                flex-direction: column;
            }

            .card {
                min-height: 180px;
            }
        }
    </style>
</head>

<body>
    <main class="shell">
        <section class="hero">
            <span class="eyebrow">Simulatore</span>
            <h1>Allenamento Click v1.0</h1>
            <p>
                Una pagina unica per raggiungere velocemente i collegamenti operativi. I link qui sotto
                sono organizzati come scorciatoie visive, leggibili sia da desktop sia da mobile.
            </p>
        </section>

        <section class="content">
            <div class="section-head">
                <h2>Seleziona l'ente</h2>
                <span>8 collegamenti disponibili</span>
            </div>

            <div class="grid">
                <livewire:gestione-home />
            </div>

            <div class="footer-note">
                Tutti i collegamenti vengono aperti in una nuova scheda per non perdere questa pagina di raccolta.
            </div>
        </section>
    </main>
</body>

</html>
