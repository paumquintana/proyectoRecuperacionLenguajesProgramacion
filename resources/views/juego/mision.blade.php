<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado · Aventura Prolog</title>
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
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Sprites */
        .sprite { width: 64px; height: 64px; image-rendering: pixelated; flex-shrink: 0; }
        .sprite-elara  { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%235ce0a0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%235ce0a0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%235ce0a0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%235ce0a0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%235ce0a0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-kael   { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%23e05c5c'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%23e05c5c'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%23e05c5c'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%23e05c5c'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%23e05c5c'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-rin    { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%239b5ce0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%239b5ce0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%239b5ce0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%239b5ce0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%239b5ce0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-daniel { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%235c9be0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%235c9be0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%235c9be0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%235c9be0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%235c9be0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-sofia  { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%23e05ca0'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%23e05ca0'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%23e05ca0'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%23e05ca0'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%23e05ca0'/%3E%3C/svg%3E") no-repeat center/cover; }
        .sprite-nico   { background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Crect x='3' y='0' width='2' height='2' fill='%23f5c542'/%3E%3Crect x='2' y='2' width='4' height='3' fill='%23e0a05c'/%3E%3Crect x='2' y='5' width='1' height='3' fill='%23e0a05c'/%3E%3Crect x='5' y='5' width='1' height='3' fill='%23e0a05c'/%3E%3Crect x='1' y='2' width='1' height='2' fill='%23e0a05c'/%3E%3Crect x='6' y='2' width='1' height='2' fill='%23e0a05c'/%3E%3C/svg%3E") no-repeat center/cover; }

        /* ── BANNER ── */
        .banner {
            border: 3px solid;
            padding: 36px 20px;
            text-align: center;
            margin-bottom: 28px;
        }

        .banner.victoria { border-color: var(--accent3); background: rgba(92,224,160,.04); }
        .banner.derrota  { border-color: var(--accent2); background: rgba(224,92,92,.04); }

        /* Grupo de sprites en banner */
        .banner-heroes {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-bottom: 16px;
        }

        .banner-hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
        }

        .banner-hero-nombre {
            font-family: 'Press Start 2P', monospace;
            font-size: 7px;
            color: var(--accent);
        }

        .banner-vs {
            font-family: 'Press Start 2P', monospace;
            font-size: 10px;
            color: var(--muted);
            align-self: center;
        }

        .banner-titulo {
            font-family: 'Press Start 2P', monospace;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .victoria .banner-titulo { color: var(--accent3); text-shadow: 0 0 20px rgba(92,224,160,.5); }
        .derrota  .banner-titulo { color: var(--accent2); text-shadow: 0 0 20px rgba(224,92,92,.5); }

        .banner-sub {
            font-size: 21px;
            color: var(--text);
        }

        /* ── REPORTE ── */
        .reporte-box {
            background: var(--panel);
            border: 2px solid var(--border);
            border-left: 4px solid var(--accent);
            padding: 22px 26px;
            margin-bottom: 24px;
        }

        .caja-label {
            font-family: 'VT323', monospace;
            font-size: 18px;
            color: var(--muted);
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .reporte-texto {
            font-size: 22px;
            color: var(--text);
            line-height: 1.5;
        }

        /* ── ANÁLISIS COMBATE ── */
        .combate-section {
            background: var(--panel);
            border: 2px solid var(--border);
            padding: 22px 26px;
            margin-bottom: 24px;
        }

        .seccion-titulo {
            font-family: 'VT323', monospace;
            font-size: 22px;
            color: var(--text);
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .seccion-titulo::after { content: ''; flex: 1; height: 1px; background: var(--border); }

        /* Barras de combate */
        .combate-fila { display: flex; flex-direction: column; gap: 14px; }

        .combate-item-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 5px;
        }

        .ci-nombre {
            font-family: 'VT323', monospace;
            font-size: 18px;
            color: var(--muted);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .ci-valor { font-size: 26px; }
        .ci-valor.jugador { color: var(--accent3); }
        .ci-valor.aliado  { color: #5cb8e0; }
        .ci-valor.grupo   { color: var(--accent); }
        .ci-valor.enemigo { color: var(--accent2); }

        .barra-track { height: 12px; background: var(--border); }
        .barra-fill  { height: 100%; }
        .barra-fill.jugador { background: var(--accent3); }
        .barra-fill.aliado  { background: #5cb8e0; }
        .barra-fill.grupo   { background: var(--accent); }
        .barra-fill.enemigo { background: var(--accent2); }

        .vs-sep { display: flex; align-items: center; gap: 10px; margin: 4px 0; }
        .vs-linea { flex: 1; height: 1px; background: var(--border); }
        .vs-txt { font-family: 'Press Start 2P', monospace; font-size: 7px; color: var(--muted); }

        /* Veredicto */
        .veredicto {
            margin-top: 16px; padding: 10px 14px;
            border: 1px solid; font-size: 18px;
            display: flex; align-items: center; gap: 10px;
        }
        .veredicto.ok { border-color: var(--accent3); background: rgba(92,224,160,.06); color: var(--accent3); }
        .veredicto.ko { border-color: var(--accent2); background: rgba(224,92,92,.06); color: var(--accent2); }

        .veredicto-tag {
            font-family: 'Press Start 2P', monospace;
            font-size: 7px;
            padding: 3px 5px;
            background: currentColor;
        }
        .veredicto-tag span { color: var(--bg); }

        /* Contribuciones individuales (modo equipo) */
        .contribuciones {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 14px;
        }

        .contrib-card {
            background: var(--bg);
            border: 1px solid var(--border);
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .contrib-sprite { width: 40px; height: 40px; image-rendering: pixelated; flex-shrink: 0; }

        .contrib-info { flex: 1; }
        .contrib-nombre {
            font-family: 'VT323', monospace;
            font-size: 18px;
            letter-spacing: 2px;
            color: var(--text);
            margin-bottom: 4px;
        }
        .contrib-dano { font-size: 24px; color: var(--accent3); }

        /* Info cards */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 24px;
        }
        @media(max-width:480px){ .info-grid { grid-template-columns: 1fr; } }

        .info-card {
            background: var(--panel);
            border: 2px solid var(--border);
            padding: 18px 20px;
        }

        .info-card .caja-label { margin-bottom: 8px; }
        .info-card-valor { font-size: 26px; }
        .val-aliado { color: var(--accent); }
        .val-xp     { color: var(--accent); }

        /* Armas usadas */
        .armas-box {
            background: var(--panel);
            border: 2px solid var(--border);
            padding: 18px 22px;
            margin-bottom: 24px;
        }

        .armas-chips-row { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px; }

        .arm-chip {
            background: rgba(245,197,66,.07);
            border: 1px solid rgba(245,197,66,.3);
            padding: 5px 12px;
            font-size: 17px;
            color: var(--text);
            text-transform: capitalize;
        }

        /* Log Prolog */
        .prolog-log {
            background: rgba(0,0,0,.3);
            border: 1px solid var(--border);
            border-left: 3px solid var(--muted);
            padding: 14px 18px;
            margin-bottom: 28px;
            font-size: 16px;
            color: var(--muted);
            line-height: 2;
        }

        .prolog-log .pl-key { font-family: 'VT323', monospace; font-size: 18px; letter-spacing: 1px; color: var(--accent3); }
        .prolog-log .pl-val { color: var(--accent); font-size: 18px; }

        /* Botones */
        .acciones { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px; }
        @media(max-width:520px){ .acciones { grid-template-columns: 1fr; } }

        .btn {
            padding: 14px 10px;
            font-family: 'Press Start 2P', monospace;
            font-size: 7px;
            text-align: center;
            text-decoration: none;
            border: 2px solid;
            letter-spacing: 1px;
            transition: background .12s, color .12s;
        }

        .btn-rep  { border-color: var(--accent);  color: var(--accent); }
        .btn-rep:hover  { background: var(--accent);  color: var(--bg); }
        .btn-mis  { border-color: var(--muted);   color: var(--muted); }
        .btn-mis:hover  { border-color: var(--text); color: var(--text); }
        .btn-ini  { border-color: var(--accent3); color: var(--accent3); }
        .btn-ini:hover  { background: var(--accent3); color: var(--bg); }

        .footer { text-align: center; margin-top: 60px; color: var(--muted); font-size: 14px; letter-spacing: 2px; }

        @keyframes pulsar { 0%,100%{transform:scale(1)} 50%{transform:scale(1.06)} }
    </style>
</head>
<body>
<div class="container">

@php
    $victoria    = ($peligroNivel === 'bajo');
    $esGrupal    = !empty($aliados);
    $danoMostrar = $danoTotal > 0 ? $danoTotal : $danoJugador;
    $maxBarra    = max((int)$danoMostrar, (int)$vidaEnemigo, 1);
    $pctGrupo    = $danoMostrar !== null ? min(round(($danoMostrar / $maxBarra) * 100), 100) : 0;
    $pctEnemigo  = min(round(($vidaEnemigo / $maxBarra) * 100), 100);
    $pctJugador  = $danoJugador !== null ? min(round(($danoJugador / $maxBarra) * 100), 100) : 0;
    $pctAliado   = $danoAliado  !== null ? min(round(($danoAliado  / $maxBarra) * 100), 100) : 0;
    $aliadosStr  = $esGrupal ? implode(', ', $aliados) : '';
    $aliadosParam = $esGrupal ? '?aliados='.implode(',', $aliados) : '';
@endphp

    {{-- Banner --}}
    <div class="banner {{ $victoria ? 'victoria' : 'derrota' }}">
        {{-- Sprites de los héroes --}}
        <div class="banner-heroes">
            <div class="banner-hero">
                <div class="sprite sprite-{{ strtolower($personaje) }}"></div>
                <span class="banner-hero-nombre">{{ strtoupper($personaje) }}</span>
            </div>
            @foreach($aliados as $ali)
            <span class="banner-vs">+</span>
            <div class="banner-hero">
                <div class="sprite sprite-{{ strtolower($ali) }}"></div>
                <span class="banner-hero-nombre">{{ strtoupper($ali) }}</span>
            </div>
            @endforeach
        </div>

        <p class="banner-titulo">
            {{ $victoria
                ? ($esGrupal ? '¡VICTORIA EN EQUIPO!' : '¡MISIÓN COMPLETADA!')
                : ($esGrupal ? 'EL EQUIPO FUE DERROTADO' : 'MISIÓN FALLIDA') }}
        </p>
        <p class="banner-sub">
            {{ $victoria
                ? ($esGrupal ? $personaje . ' y ' . $aliadosStr . ' vencieron juntos' : $personaje . ' venció al enemigo')
                : ($esGrupal ? 'No fueron suficientes para derrotar al enemigo' : $personaje . ' no tenía el poder suficiente') }}
        </p>
    </div>

    {{-- Reporte narrativo de Prolog --}}
    <div class="reporte-box">
        <p class="caja-label">
            {{ $esGrupal ? 'generar_reporte(['.implode(',', array_merge([$personaje], $aliados)).'], ID, M)' : 'generar_reporte(Personaje, ID, M)' }}
            · ELEGIBILIDAD POR NIVEL
        </p>
        <p class="reporte-texto">{{ $mensaje }}</p>
        <p style="margin-top:12px; font-size:16px; color:var(--muted); font-family:'VT323',monospace; letter-spacing:1px;">
            [!] Verifica elegibilidad por nivel — el combate lo decide el poder de tus armas.
        </p>
    </div>

    {{-- Análisis de combate --}}
    @if($danoMostrar !== null)
    <div class="combate-section">
        <p class="seccion-titulo">ANÁLISIS DE COMBATE</p>

        {{-- Modo equipo: mostrar contribuciones individuales --}}
        @if($esGrupal && $danoJugador !== null)
        <div class="contribuciones" style="grid-template-columns: repeat(auto-fill, minmax(160px, 1fr))">
            <div class="contrib-card">
                <div class="contrib-sprite sprite-{{ strtolower($personaje) }}"></div>
                <div class="contrib-info">
                    <p class="contrib-nombre">{{ strtoupper($personaje) }}</p>
                    <p class="contrib-dano">{{ $danoJugador }} DMG</p>
                </div>
            </div>
            @foreach($aliados as $ali)
            <div class="contrib-card">
                <div class="contrib-sprite sprite-{{ strtolower($ali) }}"></div>
                <div class="contrib-info">
                    <p class="contrib-nombre">{{ strtoupper($ali) }}</p>
                    <p class="contrib-dano" style="color:#5cb8e0">{{ $aliadosDanos[$ali] ?? 0 }} DMG</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="combate-fila">
            {{-- Daño del atacante (grupal o individual) --}}
            <div>
                <div class="combate-item-header">
                    <span class="ci-nombre">{{ $esGrupal ? 'DAÑO GRUPAL TOTAL' : 'TU DAÑO TOTAL' }}</span>
                    <span class="ci-valor {{ $esGrupal ? 'grupo' : 'jugador' }}">{{ $danoMostrar }}</span>
                </div>
                <div class="barra-track">
                    <div class="barra-fill {{ $esGrupal ? 'grupo' : 'jugador' }}" style="width:{{ $pctGrupo }}%"></div>
                </div>
            </div>

            <div class="vs-sep">
                <div class="vs-linea"></div>
                <span class="vs-txt">VS</span>
                <div class="vs-linea"></div>
            </div>

            {{-- Vida del enemigo --}}
            <div>
                <div class="combate-item-header">
                    <span class="ci-nombre">VIDA DE {{ strtoupper($enemigo) }}</span>
                    <span class="ci-valor enemigo">{{ $vidaEnemigo }}</span>
                </div>
                <div class="barra-track">
                    <div class="barra-fill enemigo" style="width:{{ $pctEnemigo }}%"></div>
                </div>
            </div>
        </div>

        {{-- Veredicto --}}
        <div class="veredicto {{ $victoria ? 'ok' : 'ko' }}">
            <div class="veredicto-tag"><span>{{ $victoria ? 'OK' : 'KO' }}</span></div>
            {{ $victoria
                ? 'Daño (' . $danoMostrar . ') ≥ Vida enemigo (' . $vidaEnemigo . '). ¡Victoria!'
                : 'Daño (' . $danoMostrar . ') < Vida enemigo (' . $vidaEnemigo . '). Derrota.' }}
        </div>
    </div>
    @endif

    {{-- Info cards --}}
    <div class="info-grid" style="grid-template-columns:1fr">
        <div class="info-card">
            <p class="caja-label">XP OBTENIDA</p>
            <p class="info-card-valor val-xp">{{ $victoria ? $xp : 0 }}</p>
        </div>
    </div>

    {{-- Armas llevadas --}}
    @if(!empty($armasUsadas))
    <div class="armas-box">
        <p class="caja-label">EQUIPO DE {{ strtoupper($personaje) }}</p>
        <div class="armas-chips-row">
            @foreach($armasUsadas as $arma)
            <span class="arm-chip">{{ $arma }}</span>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Log de Prolog --}}
    <div class="prolog-log">
        @if($esGrupal)
        <span class="pl-key">todos_pueden_aceptar/2</span> → <span class="pl-val">[{{ implode(', ', array_merge([$personaje], $aliados)) }}]</span><br>
        <span class="pl-key">generar_reporte/3</span> → <span class="pl-val">narrativa grupal</span><br>
        <span class="pl-key">danogrupal/2</span> → <span class="pl-val">{{ $danoTotal }} DMG total</span>
        @else
        <span class="pl-key">generar_reporte/3</span> → <span class="pl-val">narrativa automática</span><br>
        <span class="pl-key">nivel_peligro/3</span> → <span class="pl-val">{{ $peligroNivel }}</span><br>
        <span class="pl-key">mejor_aliado/3</span> → <span class="pl-val">{{ $mejorAliado }}</span>
        @if($danoJugador !== null)
        <br><span class="pl-key">sumar_armas/2</span> → <span class="pl-val">{{ $danoJugador }} DMG</span>
        @endif
        @endif
    </div>

    {{-- Acciones --}}
    <div class="acciones">
        <a href="/armas/{{ $personaje }}/{{ $mision }}{{ $aliadosParam }}" class="btn btn-rep">↺ REPETIR</a>
        <a href="/personaje/{{ $personaje }}{{ $aliadosParam }}" class="btn btn-mis">◀ MISIONES</a>
        <a href="/" class="btn btn-ini">⌂ INICIO</a>
    </div>

    <p class="footer">POWERED BY PROLOG · LENGUAJES DE PROGRAMACIÓN</p>
</div>
</body>
</html>
