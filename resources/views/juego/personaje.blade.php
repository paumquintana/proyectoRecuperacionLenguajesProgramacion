<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $nombre }} · Aventura Prolog</title>
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
            max-width: 900px;
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

        /* ── HERO CARD ── */
        .hero-card {
            background: var(--panel);
            border: 2px solid var(--border);
            padding: 28px;
            margin-bottom: 32px;
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 24px;
            align-items: start;
        }

        /* Sprite */
        .sprite {
            width: 96px; height: 96px;
            flex-shrink: 0;
            image-rendering: pixelated;
        }
        .sprite-elara  { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%235ce0a0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%235ce0a0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%235ce0a0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%235ce0a0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%235ce0a0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-kael   { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%23e05c5c'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%23e05c5c'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%23e05c5c'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%23e05c5c'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%23e05c5c'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-rin    { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%239b5ce0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%239b5ce0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%239b5ce0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%239b5ce0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%239b5ce0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-daniel { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%235c9be0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%235c9be0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%235c9be0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%235c9be0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%235c9be0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-sofia  { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%23e05ca0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%23e05ca0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%23e05ca0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%23e05ca0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%23e05ca0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-nico   { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%23e0a05c'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%23e0a05c'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%23e0a05c'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%23e0a05c'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%23e0a05c'/%3E%3C/svg%3E") no-repeat center/cover; }

        .hero-right { display: flex; flex-direction: column; gap: 18px; }

        .hero-nombre {
            font-family: 'Press Start 2P', monospace;
            font-size: 15px;
            color: var(--accent);
            text-shadow: 2px 2px 0 #7a5500;
        }

        /* Stats con iconos pixel */
        .stats-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .stat-block {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }

        .stat-icon-box {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px; height: 28px;
            border: 2px solid var(--border);
            background: var(--bg);
        }

        /* Iconos SVG inline para stats */
        .icon-lv  { background: var(--bg) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='1' y='2' width='6' height='1' fill='%23f5c542'/%3E%3Crect x='0' y='3' width='8' height='1' fill='%23f5c542'/%3E%3Crect x='1' y='5' width='6' height='1' fill='%23f5c542'/%3E%3Crect x='3' y='6' width='2' height='2' fill='%23f5c542'/%3E%3C/svg%3E") no-repeat center/18px; border-color: var(--accent); }
        .icon-hp  { background: var(--bg) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='1' y='1' width='2' height='2' fill='%23e05c5c'/%3E%3Crect x='5' y='1' width='2' height='2' fill='%23e05c5c'/%3E%3Crect x='0' y='2' width='8' height='2' fill='%23e05c5c'/%3E%3Crect x='1' y='4' width='6' height='2' fill='%23e05c5c'/%3E%3Crect x='2' y='6' width='4' height='1' fill='%23e05c5c'/%3E%3Crect x='3' y='7' width='2' height='1' fill='%23e05c5c'/%3E%3C/svg%3E") no-repeat center/18px; border-color: var(--accent2); }
        .icon-dmg { background: var(--bg) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='6' y='0' width='2' height='2' fill='%235ce0a0'/%3E%3Crect x='5' y='1' width='2' height='2' fill='%235ce0a0'/%3E%3Crect x='4' y='2' width='2' height='2' fill='%235ce0a0'/%3E%3Crect x='2' y='4' width='3' height='1' fill='%235ce0a0'/%3E%3Crect x='1' y='5' width='3' height='1' fill='%235ce0a0'/%3E%3Crect x='0' y='6' width='3' height='2' fill='%235ce0a0'/%3E%3C/svg%3E") no-repeat center/18px; border-color: var(--accent3); }
        .icon-bag { background: var(--bg) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='1' fill='%239090bb'/%3E%3Crect x='2' y='1' width='4' height='1' fill='%239090bb'/%3E%3Crect x='1' y='2' width='6' height='5' fill='%239090bb'/%3E%3Crect x='2' y='2' width='4' height='1' fill='%230a0a1a'/%3E%3C/svg%3E") no-repeat center/18px; border-color: var(--muted); }

        .stat-value {
            font-size: 30px;
            line-height: 1;
            font-family: 'VT323', monospace;
        }
        .stat-value.lv  { color: var(--accent); }
        .stat-value.hp  { color: var(--accent2); }
        .stat-value.dmg { color: var(--accent3); }
        .stat-value.bag { color: var(--text); }

        .stat-label-text {
            font-family: 'Press Start 2P', monospace;
            font-size: 6px;
            color: var(--muted);
            letter-spacing: 1px;
            margin-top: 2px;
        }

        /* Separador interno */
        .hero-divider {
            height: 1px;
            background: var(--border);
        }

        /* Armas dentro del hero card */
        .hero-armas-label {
            font-family: 'VT323', monospace;
            font-size: 18px;
            color: var(--muted);
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .armas-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .arma-chip {
            display: flex;
            align-items: center;
            gap: 6px;
            background: var(--bg);
            border: 1px solid var(--border);
            padding: 5px 10px;
            font-size: 16px;
        }

        .arma-chip .chip-icono { font-size: 16px; line-height: 1; }
        .arma-chip .chip-nombre { color: var(--text); text-transform: capitalize; }
        .arma-chip .chip-dano { color: var(--accent3); font-size: 14px; }

        /* ── MISIONES ── */
        .seccion-titulo {
            font-family: 'VT323', monospace;
            font-size: 22px;
            color: var(--text);
            margin-bottom: 16px;
            letter-spacing: 3px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .seccion-titulo::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .misiones-grid {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 40px;
        }

        .mision-card {
            background: var(--panel);
            border: 2px solid var(--border);
            padding: 18px 22px;
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 16px;
            transition: border-color 0.12s;
        }

        .mision-card.disponible:hover { border-color: var(--accent); }

        .mision-card.bloqueada {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Zona de acciones: columnas de ancho fijo para que alineen entre tarjetas */
        .mision-actions {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .mision-status {
            width: 120px;
            display: flex;
            justify-content: flex-end;
        }
        .mision-go {
            width: 64px;
            display: flex;
            justify-content: flex-end;
        }

        .mision-info {}

        .mision-nombre {
            font-family: 'Press Start 2P', monospace;
            font-size: 9px;
            color: var(--text);
            margin-bottom: 10px;
        }

        .mision-meta {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        /* Tag de dato */
        .tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 17px;
        }

        .tag .tag-label {
            font-family: 'Press Start 2P', monospace;
            font-size: 7px;
            color: var(--muted);
            background: var(--bg);
            padding: 3px 5px;
            border: 1px solid var(--border);
        }

        .tag .tag-val { color: var(--text); font-size: 19px; }
        .tag .tag-val.gold  { color: var(--accent); }
        .tag .tag-val.enemy { color: var(--accent2); }

        /* Badge peligro */
        .peligro-badge {
            font-family: 'VT323', monospace;
            font-size: 16px;
            letter-spacing: 1px;
            padding: 4px 10px;
            border: 1px solid;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .peligro-alto { color: var(--accent2); border-color: var(--accent2); background: rgba(224,92,92,.08); }
        .peligro-bajo { color: var(--accent3); border-color: var(--accent3); background: rgba(92,224,160,.08); }

        /* Badge bloqueada */
        .lock-badge {
            font-family: 'VT323', monospace;
            font-size: 16px;
            letter-spacing: 1px;
            padding: 4px 10px;
            border: 1px solid var(--border);
            color: var(--muted);
            white-space: nowrap;
            flex-shrink: 0;
        }

        /* Botón */
        .btn-ir {
            font-family: 'Press Start 2P', monospace;
            font-size: 7px;
            padding: 9px 13px;
            background: transparent;
            border: 2px solid var(--accent);
            color: var(--accent);
            text-decoration: none;
            flex-shrink: 0;
            transition: background .12s, color .12s;
            white-space: nowrap;
        }
        .btn-ir:hover { background: var(--accent); color: var(--bg); }

        .footer {
            text-align: center;
            margin-top: 60px;
            color: var(--muted);
            font-size: 14px;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
<div class="container">

    <a href="/" class="nav-back">◀ SELECCIÓN</a>

    {{-- Banner de equipo cuando hay aliados --}}
    @if(!empty($aliados))
    <div style="background:rgba(92,224,160,.07);border:2px solid var(--accent3);border-left:4px solid var(--accent3);padding:14px 20px;margin-bottom:24px;display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
        <span style="font-family:'Press Start 2P',monospace;font-size:7px;color:var(--accent3);background:rgba(92,224,160,.15);border:1px solid var(--accent3);padding:4px 8px;white-space:nowrap;">EQUIPO</span>
        <div style="display:flex;align-items:center;gap:10px;font-size:20px;">
            <div class="sprite sprite-{{ strtolower($nombre) }}" style="width:32px;height:32px;display:inline-block;"></div>
            <span style="color:var(--text);">{{ $nombre }}</span>
            @foreach($aliados as $aliado)
            <span style="color:var(--muted);font-family:'Press Start 2P',monospace;font-size:8px;">+</span>
            <div class="sprite sprite-{{ strtolower($aliado) }}" style="width:32px;height:32px;display:inline-block;"></div>
            <span style="color:var(--accent3);">{{ $aliado }}</span>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Ficha del personaje --}}
    <div class="hero-card">
        <div class="sprite sprite-{{ strtolower($nombre) }}"></div>

        <div class="hero-right">
            <p class="hero-nombre">{{ strtoupper($nombre) }}</p>

            {{-- Stats con iconos pixel + etiquetas --}}
            <div class="stats-row">
                <div class="stat-block">
                    <div class="stat-icon-box icon-lv"></div>
                    <span class="stat-value lv">{{ $nivel }}</span>
                    <span class="stat-label-text">NIVEL</span>
                </div>
                <div class="stat-block">
                    <div class="stat-icon-box icon-hp"></div>
                    <span class="stat-value hp">{{ $vida }}</span>
                    <span class="stat-label-text">VIDA</span>
                </div>
                <div class="stat-block">
                    <div class="stat-icon-box icon-dmg"></div>
                    <span class="stat-value dmg">{{ $danoTotal }}</span>
                    <span class="stat-label-text">DAÑO</span>
                </div>
                <div class="stat-block">
                    <div class="stat-icon-box icon-bag"></div>
                    <span class="stat-value bag">{{ count($inventario) }}</span>
                    <span class="stat-label-text">OBJETOS</span>
                </div>
            </div>

            <div class="hero-divider"></div>

            {{-- Inventario dentro del mismo card --}}
            <div>
                <p class="hero-armas-label">INVENTARIO - Lo que puedes elegir a llevar en cada misión</p>
                <div class="armas-chips">
                    @foreach($inventario as $arma)
                    <div class="arma-chip">
                        <span class="chip-icono">@switch($arma['nombre'])
                            @case('espada') ⚔ @break
                            @case('escudo') 🛡 @break
                            @case('pocion') 🧪 @break
                            @case('arco') 🏹 @break
                            @case('flechas') 🪃 @break
                            @case('varita') 🪄 @break
                            @case('grimorio') 📖 @break
                            @case('amuleto') 💎 @break
                            @default 🗡
                        @endswitch</span>
                        <span class="chip-nombre">{{ $arma['nombre'] }}</span>
                        @if($arma['dano'] > 0)
                        <span class="chip-dano">+{{ $arma['dano'] }}</span>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Todas las misiones --}}
    <p class="seccion-titulo">MISIONES</p>

    <div class="misiones-grid">
        @foreach($misiones as $m)
        <div class="mision-card {{ $m['disponible'] ? 'disponible' : 'bloqueada' }}">
            <div class="mision-info">
                <p class="mision-nombre">{{ strtoupper($m['misionNombre']) }}</p>
                <div class="mision-meta">
                    <span class="tag">
                        <span class="tag-label">NIV</span>
                        <span class="tag-val">{{ $m['dificultad'] }}</span>
                    </span>
                    <span class="tag">
                        <span class="tag-label">XP</span>
                        <span class="tag-val gold">{{ $m['xp'] }}</span>
                    </span>
                    <span class="tag">
                        <span class="tag-label">VS</span>
                        <span class="tag-val enemy">{{ $m['enemigo'] }}</span>
                    </span>
                </div>
            </div>

            <div class="mision-actions">
                @if($m['disponible'])
                    <span class="mision-status">
                        <span class="peligro-badge {{ $m['peligro'] === 'alto' ? 'peligro-alto' : 'peligro-bajo' }}">
                            {{ $m['peligro'] === 'alto' ? '⚠ RIESGO' : '✓ OK' }}
                        </span>
                    </span>
                    <span class="mision-go">
                        <a href="/armas/{{ $nombre }}/{{ $m['id'] }}{{ !empty($aliados) ? '?aliados='.implode(',', $aliados) : '' }}" class="btn-ir">▶ IR</a>
                    </span>
                @else
                    <span class="mision-status">
                        <span class="lock-badge">🔒 NIV {{ $m['dificultad'] }}+</span>
                    </span>
                    <span class="mision-go"></span>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <p class="footer">POWERED BY PROLOG · LENGUAJES DE PROGRAMACIÓN</p>
</div>
</body>
</html>
