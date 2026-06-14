<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aventura Prolog</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323:wght@400&display=swap');

        :root {
            --bg:        #0a0a1a;
            --panel:     #17173a;
            --border:    #4d4d88;
            --accent:    #f5c542;
            --accent2:   #e05c5c;
            --accent3:   #5ce0a0;
            --text:      #e8e8ff;
            --muted:     #a2a2d6;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'VT323', monospace;
            font-size: 20px;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Fondo con estrellas */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                radial-gradient(1px 1px at 20% 30%, #fff 0%, transparent 100%),
                radial-gradient(1px 1px at 60% 70%, #fff 0%, transparent 100%),
                radial-gradient(1px 1px at 80% 20%, #fff 0%, transparent 100%),
                radial-gradient(1px 1px at 40% 80%, #fff 0%, transparent 100%),
                radial-gradient(1px 1px at 10% 60%, #fff 0%, transparent 100%),
                radial-gradient(1px 1px at 90% 50%, #fff 0%, transparent 100%),
                radial-gradient(1px 1px at 50% 10%, #fff 0%, transparent 100%),
                radial-gradient(1px 1px at 70% 90%, #fff 0%, transparent 100%);
            opacity: 0.4;
            pointer-events: none;
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Header */
        .titulo {
            font-family: 'Press Start 2P', monospace;
            font-size: 22px;
            color: var(--accent);
            text-align: center;
            margin-bottom: 8px;
            text-shadow: 4px 4px 0 #7a5500, 0 0 30px rgba(245,197,66,0.4);
            animation: parpadeo 3s infinite;
        }

        .subtitulo {
            text-align: center;
            color: var(--muted);
            font-size: 18px;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        .separador {
            text-align: center;
            color: var(--border);
            font-size: 16px;
            margin-bottom: 40px;
            letter-spacing: 4px;
        }

        .instruccion {
            font-family: 'Press Start 2P', monospace;
            font-size: 9px;
            text-align: center;
            color: var(--accent3);
            margin-bottom: 40px;
            animation: parpadeo 1.5s infinite;
        }

        /* Grid de personajes */
        .personajes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }

        .personaje-card {
            background: var(--panel);
            border: 2px solid var(--border);
            padding: 24px 20px;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
            position: relative;
            transition: border-color 0.15s, transform 0.15s;
            image-rendering: pixelated;
        }

        .personaje-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(245,197,66,0.03) 0%, transparent 60%);
            pointer-events: none;
        }

        .personaje-card:hover {
            border-color: var(--accent);
            transform: translateY(-4px);
        }

        .personaje-card:hover .sprite {
            animation: saltar 0.4s steps(2) infinite;
        }

        /* Sprite pixel art generado con CSS */
        .sprite {
            width: 48px;
            height: 48px;
            margin: 0 auto 16px;
            display: block;
            image-rendering: pixelated;
        }

        .sprite-elara   { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%235ce0a0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%235ce0a0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%235ce0a0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%235ce0a0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%235ce0a0'/%3E%3C/svg%3E") no-repeat center/cover; }

        .sprite-kael    { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%23e05c5c'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%23e05c5c'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%23e05c5c'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%23e05c5c'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%23e05c5c'/%3E%3C/svg%3E") no-repeat center/cover; }

        .sprite-rin     { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%239b5ce0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%239b5ce0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%239b5ce0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%239b5ce0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%239b5ce0'/%3E%3C/svg%3E") no-repeat center/cover; }

        .sprite-daniel  { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%235c9be0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%235c9be0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%235c9be0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%235c9be0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%235c9be0'/%3E%3C/svg%3E") no-repeat center/cover; }

        .sprite-sofia   { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%23e05ca0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%23e05ca0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%23e05ca0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%23e05ca0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%23e05ca0'/%3E%3C/svg%3E") no-repeat center/cover; }

        .sprite-nico    { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%23e0a05c'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%23e0a05c'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%23e0a05c'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%23e0a05c'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%23e0a05c'/%3E%3C/svg%3E") no-repeat center/cover; }

        .nombre-personaje {
            font-family: 'Press Start 2P', monospace;
            font-size: 10px;
            color: var(--accent);
            text-align: center;
            margin-bottom: 14px;
        }

        .stats {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .stat-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 16px;
        }

        .stat-label { color: var(--muted); }
        .stat-valor { color: var(--text); }

        .stat-bar {
            height: 6px;
            background: var(--border);
            margin-top: 4px;
            position: relative;
        }

        .stat-fill {
            height: 100%;
            background: var(--accent3);
            transition: width 0.3s;
        }

        .stat-fill.vida { background: var(--accent2); }

        .btn-seleccionar {
            display: block;
            width: 100%;
            margin-top: 16px;
            padding: 10px;
            background: transparent;
            border: 2px solid var(--accent);
            color: var(--accent);
            font-family: 'Press Start 2P', monospace;
            font-size: 8px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
        }

        .btn-seleccionar:hover {
            background: var(--accent);
            color: var(--bg);
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 60px;
            color: var(--muted);
            font-size: 14px;
            letter-spacing: 2px;
        }

        @keyframes parpadeo {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        @keyframes saltar {
            0%   { transform: translateY(0); }
            50%  { transform: translateY(-6px); }
            100% { transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">

        <h1 class="titulo">AVENTURA PROLOG</h1>
        <p class="subtitulo">Motor de decisiones inteligente</p>
        <p class="separador">════════════════════════════</p>
        <p class="instruccion">▶ ELIGE TU PERSONAJE PARA COMENZAR ◀</p>

        <div class="personajes-grid">
            @foreach($personajes as $p)
            <div class="personaje-card">
                <div class="sprite sprite-{{ strtolower($p['nombre']) }}"></div>
                <p class="nombre-personaje">{{ $p['nombre'] }}</p>

                <div class="stats">
                    <div class="stat-row">
                        <span class="stat-label">NIV</span>
                        <span class="stat-valor">{{ $p['nivel'] }}</span>
                    </div>
                    <div class="stat-bar">
                        <div class="stat-fill" style="width: {{ ($p['nivel'] / 10) * 100 }}%"></div>
                    </div>

                    <div class="stat-row">
                        <span class="stat-label">HP</span>
                        <span class="stat-valor">{{ $p['vida'] }}</span>
                    </div>
                    <div class="stat-bar">
                        <div class="stat-fill vida" style="width: {{ ($p['vida'] / 200) * 100 }}%"></div>
                    </div>
                </div>

                <a href="/equipo/{{ $p['nombre'] }}" class="btn-seleccionar">
                    ▶ SELECCIONAR
                </a>
            </div>
            @endforeach
        </div>

        <p class="footer">POWERED BY PROLOG · LENGUAJES DE PROGRAMACIÓN</p>
    </div>
</body>
</html>