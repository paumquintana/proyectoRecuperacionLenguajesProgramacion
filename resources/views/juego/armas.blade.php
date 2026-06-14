<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipar · Aventura Prolog</title>
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
            max-width: 820px;
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

        /* Sprites mini */
        .sprite-elara  { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%235ce0a0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%235ce0a0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%235ce0a0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%235ce0a0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%235ce0a0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-kael   { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%23e05c5c'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%23e05c5c'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%23e05c5c'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%23e05c5c'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%23e05c5c'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-rin    { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%239b5ce0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%239b5ce0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%239b5ce0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%239b5ce0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%239b5ce0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-daniel { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%235c9be0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%235c9be0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%235c9be0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%235c9be0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%235c9be0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-sofia  { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%23e05ca0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%23e05ca0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%23e05ca0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%23e05ca0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%23e05ca0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-nico   { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%23e0a05c'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%23e0a05c'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%23e0a05c'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%23e0a05c'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%23e0a05c'/%3E%3C/svg%3E") no-repeat center/cover; }

        /* Header de misión */
        .mision-header {
            background: var(--panel);
            border: 2px solid var(--border);
            border-left: 4px solid var(--accent);
            padding: 20px 24px;
            margin-bottom: 32px;
        }

        .mision-tag {
            font-family: 'VT323', monospace;
            font-size: 18px;
            color: var(--muted);
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .mision-nombre-header {
            font-family: 'Press Start 2P', monospace;
            font-size: 13px;
            color: var(--accent);
            margin-bottom: 14px;
            text-shadow: 2px 2px 0 #7a5500;
        }

        .mision-chips {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .chip {
            font-size: 17px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .chip .chip-l {
            font-family: 'Press Start 2P', monospace;
            font-size: 6px;
            color: var(--muted);
            background: var(--bg);
            padding: 2px 5px;
            border: 1px solid var(--border);
        }

        .chip .chip-v { color: var(--text); }
        .chip .chip-v.gold   { color: var(--accent); }
        .chip .chip-v.danger { color: var(--accent2); }

        /* Misterio del enemigo */
        .enemy-mystery {
            margin-top: 12px;
            padding: 10px 14px;
            background: rgba(224, 92, 92, 0.07);
            border: 1px solid rgba(224, 92, 92, 0.25);
            font-size: 16px;
            color: var(--accent2);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .enemy-mystery .mystery-icon {
            font-family: 'Press Start 2P', monospace;
            font-size: 7px;
            background: var(--accent2);
            color: var(--bg);
            padding: 3px 5px;
        }

        /* Instrucción */
        .instruccion {
            font-family: 'VT323', monospace;
            font-size: 22px;
            color: var(--accent3);
            text-align: center;
            margin-bottom: 24px;
            letter-spacing: 3px;
            animation: parpadeo 2s infinite;
        }

        /* ── GRID DE ARMAS ── */
        .armas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 14px;
            margin-bottom: 32px;
        }

        .arma-card {
            background: var(--panel);
            border: 2px solid var(--border);
            padding: 20px 16px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            position: relative;
            transition: border-color .12s, transform .12s;
            user-select: none;
        }

        .arma-card:hover {
            border-color: var(--muted);
            transform: translateY(-2px);
        }

        .arma-card.seleccionada {
            border-color: var(--accent3);
            background: rgba(92, 224, 160, 0.06);
        }

        .arma-card.seleccionada:hover {
            transform: translateY(-2px);
        }

        /* Checkbox oculto */
        .arma-card input[type="checkbox"] { display: none; }

        /* Marca de selección */
        .check-mark {
            position: absolute;
            top: 8px; right: 8px;
            width: 18px; height: 18px;
            border: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            transition: background .12s, border-color .12s;
        }

        .arma-card.seleccionada .check-mark {
            background: var(--accent3);
            border-color: var(--accent3);
            color: var(--bg);
        }

        .arma-card.seleccionada .check-mark::after {
            content: '✓';
            font-family: monospace;
            font-weight: bold;
        }

        /* Icono grande del arma (SVG pixel art 48x48) */
        .arma-icono-grande {
            filter: drop-shadow(0 0 8px rgba(92,224,160,0));
            transition: filter .12s;
        }

        .arma-card.seleccionada .arma-icono-grande {
            filter: drop-shadow(0 0 8px rgba(92,224,160,0.4));
        }

        .arma-nombre-card {
            font-family: 'Press Start 2P', monospace;
            font-size: 7px;
            color: var(--text);
            text-transform: capitalize;
            text-align: center;
        }

        /* Barra de poder (visual, no revela el número exacto al enemigo) */
        .arma-poder-wrap {
            width: 100%;
        }

        .poder-label {
            font-family: 'VT323', monospace;
            font-size: 15px;
            color: var(--muted);
            margin-bottom: 4px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .poder-barra {
            height: 6px;
            background: var(--border);
            width: 100%;
        }

        .poder-fill {
            height: 100%;
            background: var(--accent3);
            transition: width .2s;
        }

        .poder-numero {
            font-size: 18px;
            color: var(--accent3);
            text-align: right;
            margin-top: 2px;
        }

        /* Counter de seleccionadas */
        .counter-bar {
            background: var(--panel);
            border: 1px solid var(--border);
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .counter-texto {
            font-size: 20px;
            color: var(--text);
        }

        .counter-texto strong {
            color: var(--accent);
            font-family: 'Press Start 2P', monospace;
            font-size: 14px;
        }

        .counter-aviso {
            font-family: 'Press Start 2P', monospace;
            font-size: 7px;
            color: var(--accent2);
            display: none;
        }

        /* ── ALIADO ── */
        .aliado-section {
            background: var(--panel);
            border: 2px solid var(--border);
            border-left: 4px solid var(--accent3);
            padding: 20px 24px;
            margin-bottom: 20px;
        }

        .aliado-header {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 16px;
        }

        .aliado-badge {
            font-family: 'VT323', monospace;
            font-size: 16px;
            letter-spacing: 1px;
            color: var(--accent3);
            background: rgba(92,224,160,.1);
            border: 1px solid var(--accent3);
            padding: 4px 10px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .aliado-explicacion {
            font-size: 17px;
            color: var(--muted);
            line-height: 1.4;
        }

        .aliado-explicacion strong { color: var(--text); }

        .aliado-card-inner {
            display: flex;
            align-items: center;
            gap: 16px;
            background: var(--bg);
            border: 1px solid var(--border);
            padding: 14px 18px;
        }

        .aliado-sprite {
            width: 48px; height: 48px;
            image-rendering: pixelated;
            flex-shrink: 0;
        }

        .aliado-datos { flex: 1; }

        .aliado-nombre {
            font-family: 'Press Start 2P', monospace;
            font-size: 9px;
            color: var(--accent);
            margin-bottom: 8px;
        }

        .aliado-stats {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            font-size: 17px;
        }

        .aliado-stat .as-label {
            font-family: 'VT323', monospace;
            font-size: 16px;
            letter-spacing: 1px;
            color: var(--muted);
        }

        .aliado-stat .as-val { color: var(--text); }
        .aliado-stat .as-val.dmg { color: var(--accent3); }

        .aliado-toggle {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .toggle-box {
            width: 22px; height: 22px;
            border: 2px solid var(--border);
            position: relative;
            flex-shrink: 0;
        }

        .toggle-box.activo {
            border-color: var(--accent3);
            background: var(--accent3);
        }

        .toggle-box.activo::after {
            content: '✓';
            position: absolute; inset: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; color: var(--bg); font-family: monospace; font-weight: bold;
        }

        .toggle-label {
            font-family: 'VT323', monospace;
            font-size: 18px;
            letter-spacing: 2px;
            color: var(--text);
        }

        /* Botón */
        .btn-mision {
            display: block;
            width: 100%;
            padding: 16px;
            background: transparent;
            border: 3px solid var(--accent);
            color: var(--accent);
            font-family: 'Press Start 2P', monospace;
            font-size: 11px;
            cursor: pointer;
            text-align: center;
            letter-spacing: 3px;
            transition: background .15s, color .15s;
        }

        .btn-mision:hover:not(:disabled) {
            background: var(--accent);
            color: var(--bg);
        }

        .btn-mision:disabled {
            opacity: 0.35;
            cursor: not-allowed;
            border-color: var(--border);
            color: var(--muted);
        }

        .footer {
            text-align: center;
            margin-top: 60px;
            color: var(--muted);
            font-size: 14px;
            letter-spacing: 2px;
        }

        @keyframes parpadeo {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }
    </style>
</head>
<body>
<div class="container">

    @php $aliadosParam = !empty($aliados) ? '?aliados='.implode(',', $aliados) : ''; @endphp
    <a href="/personaje/{{ $personaje }}{{ $aliadosParam }}" class="nav-back">◀ VOLVER</a>

    {{-- Info de la misión --}}
    <div class="mision-header">
        <p class="mision-tag">PREPARACIÓN DE MISIÓN</p>
        <p class="mision-nombre-header">{{ strtoupper($misionNombre) }}</p>
        <div class="mision-chips">
            <span class="chip">
                <span class="chip-l">PJ</span>
                <span class="chip-v">{{ $personaje }}</span>
            </span>
            <span class="chip">
                <span class="chip-l">DIF</span>
                <span class="chip-v">{{ $dificultad }}</span>
            </span>
            <span class="chip">
                <span class="chip-l">XP</span>
                <span class="chip-v gold">{{ $xp }}</span>
            </span>
            <span class="chip">
                <span class="chip-l">ENEMIGO</span>
                <span class="chip-v danger">{{ $enemigo }}</span>
            </span>
        </div>
        <div class="enemy-mystery">
            <span class="mystery-icon">!</span>
            Desconoces la fuerza del enemigo. Elige bien tu equipo.
        </div>
    </div>

    <p class="instruccion">▶ ELIGE TU EQUIPO PARA ESTA MISIÓN ◀</p>

    <form id="form-armas" action="/mision/{{ $personaje }}/{{ $misionId }}" method="GET">
        {{-- Grid de armas --}}
        <div class="armas-grid">
            @php
                $maxDano = collect($inventario)->max('dano') ?: 1;
            @endphp
            @foreach($inventario as $arma)
            <label class="arma-card seleccionada" data-dano="{{ $arma['dano'] }}">
                <input type="checkbox" name="armas[]" value="{{ $arma['nombre'] }}" checked>
                <div class="check-mark"></div>

                <span class="arma-icono-grande" style="width:48px;height:48px;display:flex;align-items:center;justify-content:center">
                    @include('juego.partials.arma-icon', ['arma' => $arma['nombre']])
                </span>

                <p class="arma-nombre-card">{{ $arma['nombre'] }}</p>

                <div class="arma-poder-wrap">
                    <p class="poder-label">PODER</p>
                    <div class="poder-barra">
                        <div class="poder-fill" style="width: {{ $maxDano > 0 ? round(($arma['dano'] / $maxDano) * 100) : 0 }}%"></div>
                    </div>
                    <p class="poder-numero">{{ $arma['dano'] }}</p>
                </div>
            </label>
            @endforeach
        </div>

        {{-- Contador --}}
        <div class="counter-bar">
            <span class="counter-texto">
                <strong id="count-sel">{{ count($inventario) }}</strong> armas seleccionadas
            </span>
            <span class="counter-aviso" id="aviso-cero">¡Selecciona al menos 1 arma!</span>
        </div>

        {{-- Equipo ya formado (viene del flujo de equipo) --}}
        @if(!empty($aliados))
        <div style="background:rgba(92,224,160,.07);border:2px solid var(--accent3);border-left:4px solid var(--accent3);padding:14px 20px;margin-bottom:20px;">
            <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:12px;">
                <span style="font-family:'Press Start 2P',monospace;font-size:7px;color:var(--accent3);background:rgba(92,224,160,.15);border:1px solid var(--accent3);padding:4px 8px;white-space:nowrap;">EQUIPO</span>
                <div style="display:flex;align-items:center;gap:10px;font-size:20px;flex-wrap:wrap;">
                    <div class="sprite-{{ strtolower($personaje) }}" style="width:32px;height:32px;display:inline-block;image-rendering:pixelated;background-size:cover;"></div>
                    <span style="color:var(--text);">{{ $personaje }}</span>
                    @foreach($aliados as $ali)
                    <span style="color:var(--muted);font-family:'Press Start 2P',monospace;font-size:8px;">+</span>
                    <div class="sprite-{{ strtolower($ali) }}" style="width:32px;height:32px;display:inline-block;image-rendering:pixelated;background-size:cover;"></div>
                    <span style="color:var(--accent3);">{{ $ali }}</span>
                    @endforeach
                </div>
            </div>
            {{-- Inventario de cada aliado (read-only) --}}
            @foreach($aliados as $ali)
            <div style="margin-top:10px;padding-top:10px;border-top:1px solid rgba(92,224,160,.2);">
                <p style="font-family:'Press Start 2P',monospace;font-size:6px;color:var(--accent3);letter-spacing:1px;margin-bottom:8px;">
                    {{ strtoupper($ali) }} · INVENTARIO COMPLETO
                </p>
                <div style="display:flex;flex-wrap:wrap;gap:6px;">
                    @foreach($aliadosInventarios[$ali] ?? [] as $arma)
                    <div style="display:flex;align-items:center;gap:6px;background:var(--bg);border:1px solid rgba(92,224,160,.3);padding:4px 10px;font-size:16px;">
                        <span style="width:16px;height:16px;display:inline-flex;align-items:center;flex-shrink:0">
                            @include('juego.partials.arma-icon', ['arma' => $arma['nombre']])
                        </span>
                        <span style="color:var(--accent3)">{{ $arma['nombre'] }}</span>
                        @if($arma['dano'] > 0)
                        <span style="color:var(--muted);font-size:14px">+{{ $arma['dano'] }}</span>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        <input type="hidden" name="aliados" value="{{ implode(',', $aliados) }}">
        @endif

        <button type="submit" class="btn-mision" id="btn-ir">
            ⚔ INICIAR MISIÓN
        </button>
    </form>

    <p class="footer">POWERED BY PROLOG · LENGUAJES DE PROGRAMACIÓN</p>
</div>

<script>
    const cards = document.querySelectorAll('.arma-card');
    const countEl = document.getElementById('count-sel');
    const avisoEl = document.getElementById('aviso-cero');
    const btnEl   = document.getElementById('btn-ir');

    cards.forEach(card => {
        card.addEventListener('click', () => {
            const cb = card.querySelector('input[type=checkbox]');
            // Toggle (el click nativo ya invirtió el checkbox)
            setTimeout(() => {
                card.classList.toggle('seleccionada', cb.checked);
                actualizar();
            }, 0);
        });
    });

    function actualizar() {
        const sel = document.querySelectorAll('.arma-card.seleccionada').length;
        countEl.textContent = sel;
        const vacia = sel === 0;
        avisoEl.style.display = vacia ? 'inline' : 'none';
        btnEl.disabled = vacia;
    }

    actualizar();
</script>
</body>
</html>
