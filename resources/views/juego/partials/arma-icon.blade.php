{{--
    Icono pixel art SVG de arma.
    Variables: $arma (string, nombre del arma)
    El tamaño se controla desde el elemento padre via width/height CSS.
--}}
@switch($arma ?? '')

    @case('espada')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8" style="display:block;width:100%;height:100%;image-rendering:pixelated">
        <rect x="3" y="0" width="2" height="4" fill="#f5c542"/>
        <rect x="1" y="4" width="6" height="1" fill="#c8c8e8"/>
        <rect x="3" y="5" width="2" height="2" fill="#c8a020"/>
        <rect x="2" y="7" width="4" height="1" fill="#c8a020"/>
    </svg>
    @break

    @case('escudo')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8" style="display:block;width:100%;height:100%;image-rendering:pixelated">
        <rect x="1" y="0" width="6" height="1" fill="#5c9be0"/>
        <rect x="0" y="1" width="8" height="4" fill="#5c9be0"/>
        <rect x="1" y="5" width="6" height="1" fill="#5c9be0"/>
        <rect x="2" y="6" width="4" height="1" fill="#5c9be0"/>
        <rect x="3" y="7" width="2" height="1" fill="#5c9be0"/>
        <rect x="3" y="1" width="2" height="3" fill="#e8e8ff"/>
    </svg>
    @break

    @case('pocion')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8" style="display:block;width:100%;height:100%;image-rendering:pixelated">
        <rect x="3" y="0" width="2" height="1" fill="#888888"/>
        <rect x="2" y="1" width="4" height="1" fill="#888888"/>
        <rect x="1" y="2" width="6" height="5" fill="#e05c5c"/>
        <rect x="2" y="7" width="4" height="1" fill="#e05c5c"/>
        <rect x="2" y="3" width="2" height="2" fill="#ff9090"/>
    </svg>
    @break

    @case('arco')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8" style="display:block;width:100%;height:100%;image-rendering:pixelated">
        <rect x="0" y="0" width="1" height="8" fill="#5ce0a0"/>
        <rect x="1" y="0" width="1" height="2" fill="#5ce0a0"/>
        <rect x="1" y="6" width="1" height="2" fill="#5ce0a0"/>
        <rect x="2" y="2" width="1" height="1" fill="#5ce0a0"/>
        <rect x="2" y="5" width="1" height="1" fill="#5ce0a0"/>
        <rect x="3" y="3" width="1" height="2" fill="#5ce0a0"/>
        <rect x="1" y="3" width="7" height="1" fill="#c8c8c8"/>
    </svg>
    @break

    @case('flechas')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8" style="display:block;width:100%;height:100%;image-rendering:pixelated">
        <rect x="0" y="3" width="6" height="2" fill="#c8a060"/>
        <rect x="5" y="1" width="1" height="6" fill="#f5c542"/>
        <rect x="6" y="2" width="1" height="4" fill="#f5c542"/>
        <rect x="7" y="3" width="1" height="2" fill="#f5c542"/>
        <rect x="0" y="2" width="2" height="1" fill="#5ce0a0"/>
        <rect x="0" y="5" width="2" height="1" fill="#5ce0a0"/>
    </svg>
    @break

    @case('varita')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8" style="display:block;width:100%;height:100%;image-rendering:pixelated">
        <rect x="5" y="0" width="1" height="1" fill="#f5c542"/>
        <rect x="4" y="1" width="3" height="1" fill="#f5c542"/>
        <rect x="5" y="0" width="1" height="2" fill="#f5c542"/>
        <rect x="4" y="2" width="1" height="1" fill="#9b5ce0"/>
        <rect x="3" y="3" width="1" height="1" fill="#9b5ce0"/>
        <rect x="2" y="4" width="1" height="1" fill="#9b5ce0"/>
        <rect x="1" y="5" width="1" height="1" fill="#9b5ce0"/>
        <rect x="0" y="6" width="1" height="2" fill="#9b5ce0"/>
    </svg>
    @break

    @case('grimorio')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8" style="display:block;width:100%;height:100%;image-rendering:pixelated">
        <rect x="1" y="0" width="6" height="8" fill="#9b5ce0"/>
        <rect x="0" y="0" width="2" height="8" fill="#6a3ab0"/>
        <rect x="2" y="2" width="4" height="1" fill="#e8e8ff"/>
        <rect x="2" y="4" width="4" height="1" fill="#e8e8ff"/>
        <rect x="2" y="6" width="3" height="1" fill="#e8e8ff"/>
    </svg>
    @break

    @case('amuleto')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8" style="display:block;width:100%;height:100%;image-rendering:pixelated">
        <rect x="3" y="0" width="2" height="1" fill="#5ce0a0"/>
        <rect x="2" y="1" width="4" height="1" fill="#5ce0a0"/>
        <rect x="1" y="2" width="6" height="3" fill="#5ce0a0"/>
        <rect x="2" y="5" width="4" height="2" fill="#5ce0a0"/>
        <rect x="3" y="7" width="2" height="1" fill="#5ce0a0"/>
        <rect x="3" y="2" width="2" height="2" fill="#90f0c0"/>
    </svg>
    @break

    @default
    {{-- Arma genérica: espada simple --}}
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8" style="display:block;width:100%;height:100%;image-rendering:pixelated">
        <rect x="3" y="0" width="2" height="5" fill="#e8e8ff"/>
        <rect x="1" y="5" width="6" height="1" fill="#888888"/>
        <rect x="3" y="6" width="2" height="2" fill="#888888"/>
    </svg>

@endswitch
