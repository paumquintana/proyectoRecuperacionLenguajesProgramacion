<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formar Equipo · Aventura Prolog</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323:wght@400&display=swap');

        :root {
            --bg:      #0a0a1a;
            --panel:   #17173a;
            --border:  #4d4d88;
            --accent:  #f5c542;
            --accent2: #e05c5c;
            --accent3: #5ce0a0;
            --text:    #e8e8ff;
            --muted:   #a2a2d6;
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

        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                radial-gradient(1px 1px at 15% 25%, #fff 0%, transparent 100%),
                radial-gradient(1px 1px at 55% 65%, #fff 0%, transparent 100%),
                radial-gradient(1px 1px at 80% 15%, #fff 0%, transparent 100%),
                radial-gradient(1px 1px at 35% 80%, #fff 0%, transparent 100%),
                radial-gradient(1px 1px at 10% 55%, #fff 0%, transparent 100%),
                radial-gradient(1px 1px at 90% 45%, #fff 0%, transparent 100%),
                radial-gradient(1px 1px at 50% 10%, #fff 0%, transparent 100%),
                radial-gradient(1px 1px at 70% 85%, #fff 0%, transparent 100%);
            opacity: 0.35;
            pointer-events: none;
            z-index: 0;
        }

        .container {
            position: relative; z-index: 1;
            max-width: 960px;
            margin: 0 auto;
            padding: 36px 20px;
        }

        .nav-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: 'Press Start 2P', monospace;
            font-size: 7px;
            color: var(--muted);
            text-decoration: none;
            margin-bottom: 28px;
            letter-spacing: 1px;
            padding: 8px 12px;
            border: 1px solid var(--border);
        }
        .nav-back:hover { color: var(--accent); border-color: var(--accent); }

        /* Header: tu personaje + pregunta */
        .header-section {
            margin-bottom: 32px;
        }

        .titulo-principal {
            font-family: 'Press Start 2P', monospace;
            font-size: 12px;
            color: var(--accent);
            text-shadow: 2px 2px 0 #7a5500;
            margin-bottom: 12px;
        }

        .subtitulo {
            font-size: 22px;
            color: var(--muted);
            margin-bottom: 20px;
        }

        /* Personaje elegido (mini banner) */
        .tu-personaje-bar {
            background: var(--panel);
            border: 2px solid var(--border);
            border-left: 4px solid var(--accent);
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 32px;
        }

        .mini-sprite {
            width: 48px; height: 48px;
            image-rendering: pixelated;
            flex-shrink: 0;
        }

        .sprite-elara  { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%235ce0a0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%235ce0a0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%235ce0a0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%235ce0a0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%235ce0a0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-kael   { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%23e05c5c'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%23e05c5c'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%23e05c5c'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%23e05c5c'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%23e05c5c'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-rin    { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%239b5ce0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%239b5ce0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%239b5ce0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%239b5ce0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%239b5ce0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-daniel { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%235c9be0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%235c9be0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%235c9be0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%235c9be0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%235c9be0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-sofia  { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%23e05ca0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%23e05ca0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%23e05ca0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%23e05ca0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%23e05ca0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-nico   { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%23e0a05c'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%23e0a05c'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%23e0a05c'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%23e0a05c'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%23e0a05c'/%3E%3C/svg%3E") no-repeat center/cover; }

        .tu-personaje-info {}

        .tu-personaje-tag {
            font-size: 16px;
            color: var(--muted);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .tu-personaje-nombre {
            font-family: 'Press Start 2P', monospace;
            font-size: 11px;
            color: var(--accent);
        }

        /* Sección título */
        .seccion-titulo {
            font-family: 'VT323', monospace;
            font-size: 22px;
            color: var(--text);
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .seccion-titulo::after { content: ''; flex: 1; height: 1px; background: var(--border); }

        /* Opción: jugar solo */
        .btn-solo {
            display: flex;
            align-items: center;
            gap: 16px;
            background: var(--panel);
            border: 2px solid var(--border);
            padding: 18px 22px;
            text-decoration: none;
            color: inherit;
            margin-bottom: 24px;
            transition: border-color .12s;
        }
        .btn-solo:hover { border-color: var(--muted); }

        .solo-icono {
            font-size: 36px;
            line-height: 1;
            opacity: 0.5;
        }

        .solo-texto {}
        .solo-nombre {
            font-family: 'Press Start 2P', monospace;
            font-size: 9px;
            color: var(--muted);
            margin-bottom: 6px;
        }
        .solo-desc { font-size: 18px; color: var(--muted); }

        /* Grid de personajes */
        .personajes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .personaje-card {
            background: var(--panel);
            border: 2px solid var(--border);
            padding: 22px 18px;
            color: inherit;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            position: relative;
            cursor: pointer;
            transition: border-color .12s, transform .12s;
            user-select: none;
        }

        .personaje-card:hover {
            border-color: var(--muted);
            transform: translateY(-3px);
        }

        .personaje-card.seleccionado {
            border-color: var(--accent3);
            background: rgba(92,224,160,.05);
        }

        .personaje-card.seleccionado:hover {
            border-color: var(--accent3);
        }

        .check-mark {
            position: absolute;
            top: 8px; right: 8px;
            width: 18px; height: 18px;
            border: 2px solid var(--border);
            display: flex; align-items: center; justify-content: center;
        }

        .personaje-card.seleccionado .check-mark {
            background: var(--accent3);
            border-color: var(--accent3);
            color: var(--bg);
            font-weight: bold;
            font-size: 12px;
            font-family: monospace;
        }

        .personaje-card.seleccionado .check-mark::after { content: '✓'; }

        /* Badge de más poderoso */
        .badge-poderoso {
            position: absolute;
            top: -1px; left: -1px; right: -1px;
            background: var(--accent3);
            font-family: 'Press Start 2P', monospace;
            font-size: 6px;
            color: var(--bg);
            text-align: center;
            padding: 4px;
            letter-spacing: 1px;
        }

        .personaje-card.poderoso {
            border-color: var(--accent3);
        }

        /* Barra de confirmación */
        .confirmar-bar {
            background: var(--panel);
            border: 2px solid var(--border);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }

        .confirmar-texto {
            font-size: 20px;
            color: var(--muted);
        }

        .confirmar-texto strong {
            font-family: 'Press Start 2P', monospace;
            font-size: 12px;
            color: var(--accent3);
        }

        .btn-formar {
            font-family: 'Press Start 2P', monospace;
            font-size: 8px;
            padding: 12px 18px;
            background: transparent;
            border: 2px solid var(--accent3);
            color: var(--accent3);
            cursor: pointer;
            letter-spacing: 1px;
            transition: background .12s, color .12s;
            white-space: nowrap;
        }

        .btn-formar:not(:disabled):hover {
            background: var(--accent3);
            color: var(--bg);
        }

        .btn-formar:disabled {
            opacity: 0.35;
            cursor: not-allowed;
            border-color: var(--border);
            color: var(--muted);
        }

        /* Sprite grande */
        .card-sprite {
            width: 72px; height: 72px;
            image-rendering: pixelated;
            margin-top: 12px; /* espacio para el badge */
        }

        .card-nombre {
            font-family: 'Press Start 2P', monospace;
            font-size: 9px;
            color: var(--accent);
            text-align: center;
        }

        /* Stats del personaje */
        .card-stats {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card-stat {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
        }

        .cs-label {
            font-size: 14px;
            color: var(--muted);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .cs-val { font-size: 24px; }
        .cs-val.niv { color: var(--accent); }
        .cs-val.hp  { color: var(--accent2); }
        .cs-val.dmg { color: var(--accent3); }

        /* Prolog nota */
        .prolog-nota {
            background: rgba(0,0,0,.25);
            border: 1px solid var(--border);
            border-left: 3px solid var(--accent3);
            padding: 14px 18px;
            margin-bottom: 32px;
            font-size: 18px;
            color: var(--muted);
            line-height: 1.6;
        }

        .prolog-nota .pl-key {
            font-family: 'VT323', monospace;
            font-size: 17px;
            color: var(--accent3);
            letter-spacing: 1px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: var(--muted);
            font-size: 14px;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
<div class="container">

    <a href="/" class="nav-back">◀ CAMBIAR PERSONAJE</a>

    {{-- Personaje elegido --}}
    <div class="tu-personaje-bar">
        <div class="mini-sprite sprite-{{ strtolower($personaje) }}"></div>
        <div class="tu-personaje-info">
            <p class="tu-personaje-tag">Jugando como</p>
            <p class="tu-personaje-nombre">{{ strtoupper($personaje) }}</p>
        </div>
        <div style="margin-left:auto; font-size:18px; color:var(--muted)">
            NIV <span style="color:var(--accent)">{{ $statsP['nivel'] }}</span>
            &nbsp;·&nbsp;
            HP <span style="color:var(--accent2)">{{ $statsP['vida'] }}</span>
            &nbsp;·&nbsp;
            DMG <span style="color:var(--accent3)">{{ $statsP['dano'] }}</span>
        </div>
    </div>

    {{-- Prolog info
    <div class="prolog-nota">
        Si juegas en equipo, Prolog usará
        <span class="pl-key">todos_pueden_aceptar([P1, P2], MisionID)</span>
        para filtrar solo las misiones que <em>ambos</em> puedan aceptar por nivel.
        Si hay aliado, el daño grupal se calcula con
        <span class="pl-key">danogrupal/2</span>.
    </div> --}}

    {{-- Opción solo --}}
    <p class="seccion-titulo">⚔ ¿Deseas jugar solo?</p>

    <a href="/personaje/{{ $personaje }}" class="btn-solo">
        <span class="solo-icono">🗡</span>
        <div class="solo-texto">
            <p class="solo-nombre">JUGAR SOLO</p>
            <p class="solo-desc">Sin aliado</p>
        </div>
    </a>

    {{-- Grid de posibles aliados --}}
    <p class="seccion-titulo">⚔ ¿O en equipo?</p>
    <p style="font-size:17px;color:var(--muted);margin-bottom:16px;letter-spacing:1px;">
        Selecciona uno o varios aliados y pulsa <span style="color:var(--accent3)">FORMAR EQUIPO</span>.
     </p>

    <div class="personajes-grid" id="grid-aliados">
        @foreach($todos as $i => $p)
        <div class="personaje-card {{ $i === 0 ? 'poderoso' : '' }}"
             data-nombre="{{ $p['nombre'] }}"
             onclick="toggleAliado(this)">

            @if($i === 0)
            <div class="badge-poderoso">★ MÁS PODEROSO</div>
            @endif

            <div class="check-mark"></div>

            <div class="card-sprite sprite-{{ strtolower($p['nombre']) }}" style="margin-top:{{ $i === 0 ? '14px' : '0' }}"></div>
            <p class="card-nombre">{{ strtoupper($p['nombre']) }}</p>

            <div class="card-stats">
                <div class="card-stat">
                    <span class="cs-label">NIVEL</span>
                    <span class="cs-val niv">{{ $p['nivel'] }}</span>
                </div>
                <div class="card-stat">
                    <span class="cs-label">HP</span>
                    <span class="cs-val hp">{{ $p['vida'] }}</span>
                </div>
                <div class="card-stat">
                    <span class="cs-label">DAÑO</span>
                    <span class="cs-val dmg">{{ $p['dano'] }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Barra de confirmación --}}
    <div class="confirmar-bar">
        <span class="confirmar-texto">
            <strong id="count-sel">0</strong> aliados seleccionados
        </span>
        <button id="btn-formar" class="btn-formar" disabled onclick="formarEquipo()">
            ▶ FORMAR EQUIPO
        </button>
    </div>

    <p class="footer">POWERED BY PROLOG · LENGUAJES DE PROGRAMACIÓN</p>

<script>
    const seleccionados = new Set();
    const btnFormar = document.getElementById('btn-formar');
    const countSel  = document.getElementById('count-sel');

    function toggleAliado(card) {
        const nombre = card.dataset.nombre;
        if (seleccionados.has(nombre)) {
            seleccionados.delete(nombre);
            card.classList.remove('seleccionado');
        } else {
            seleccionados.add(nombre);
            card.classList.add('seleccionado');
        }
        countSel.textContent = seleccionados.size;
        btnFormar.disabled = seleccionados.size === 0;
    }

    function formarEquipo() {
        if (seleccionados.size === 0) return;
        const aliados = Array.from(seleccionados).join(',');
        window.location.href = '/personaje/{{ $personaje }}?aliados=' + encodeURIComponent(aliados);
    }
</script>
</div>
</body>
</html>
