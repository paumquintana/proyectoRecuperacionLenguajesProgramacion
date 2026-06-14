<?php

namespace App\Http\Controllers;

use App\Services\PrologService;

class JuegoController extends Controller
{
    protected PrologService $prolog;

    public function __construct()
    {
        $this->prolog = new PrologService();
    }

    /** "Kael,Sofia" → ['Kael','Sofia'] */
    private function parseAliados(string $raw): array
    {
        if ($raw === '') return [];
        return array_values(array_filter(array_map('trim', explode(',', $raw))));
    }

    /** ['Elara','Kael'] → "['Elara','Kael']" */
    private function prologLista(array $nombres): string
    {
        if (empty($nombres)) return '[]';
        return "['" . implode("','", $nombres) . "']";
    }

    public function index()
    {
        $lineas = $this->prolog->consultar(
            "forall(personaje(N,L,V), format('~w,~w,~w~n',[N,L,V]))"
        );

        $personajes = [];
        foreach ($lineas as $linea) {
            if (trim($linea) === '') continue;
            $partes = explode(',', $linea);
            if (count($partes) < 3) continue;
            [$nombre, $nivel, $vida] = $partes;
            $personajes[] = compact('nombre', 'nivel', 'vida');
        }

        return view('juego.index', compact('personajes'));
    }

    public function seleccionarEquipo(string $personaje)
    {
        $lineas = $this->prolog->consultar(
            "forall(personaje(N,L,V), (inventario(N,Armas), sumar_armas(Armas,D), format('~w,~w,~w,~w~n',[N,L,V,D])))"
        );

        $todos = [];
        foreach ($lineas as $linea) {
            if (trim($linea) === '') continue;
            $p = explode(',', trim($linea));
            if (count($p) < 4) continue;
            [$nombre, $nivel, $vida, $dano] = $p;
            if ($nombre === $personaje) continue;
            $todos[] = compact('nombre', 'nivel', 'vida', 'dano');
        }

        usort($todos, fn($a, $b) => (int)$b['dano'] - (int)$a['dano']);

        $statsLineas = $this->prolog->consultar(
            "personaje('{$personaje}', N, V), inventario('{$personaje}', Armas), sumar_armas(Armas, D), format('~w,~w,~w~n',[N,V,D])"
        );
        $statsP = ['nivel' => 0, 'vida' => 0, 'dano' => 0];
        if (!empty($statsLineas[0])) {
            $sp = explode(',', trim($statsLineas[0]));
            if (count($sp) >= 3) {
                $statsP = ['nivel' => $sp[0], 'vida' => $sp[1], 'dano' => $sp[2]];
            }
        }

        return view('juego.equipo', compact('personaje', 'todos', 'statsP'));
    }

    public function personaje(string $nombre)
    {
        // Stats del jugador
        $lineas = $this->prolog->consultar(
            "personaje('{$nombre}', N, V), format('~w,~w~n',[N,V])"
        );
        $nivel = 0; $vida = 0;
        if (!empty($lineas[0])) {
            [$nivel, $vida] = explode(',', trim($lineas[0]));
        }

        // Inventario con daño
        $lineas = $this->prolog->consultar(
            "inventario('{$nombre}', L), forall(member(A,L), (arma(A,D) -> format('~w,~w~n',[A,D]) ; format('~w,0~n',[A])))"
        );
        $inventario = [];
        $danoTotal  = 0;
        foreach ($lineas as $linea) {
            if (trim($linea) === '') continue;
            $partes = explode(',', trim($linea));
            if (count($partes) < 2) continue;
            [$armaName, $armaDano] = $partes;
            $inventario[] = ['nombre' => $armaName, 'dano' => (int)$armaDano];
            $danoTotal   += (int)$armaDano;
        }

        // Aliados (comma-separated, e.g. "Kael,Sofia")
        $aliados = $this->parseAliados(request()->input('aliados', ''));
        $equipo  = array_merge([$nombre], $aliados);

        // Misiones disponibles
        if (!empty($aliados)) {
            $listaProlog = $this->prologLista($equipo);
            $checkQuery  = "todos_pueden_aceptar({$listaProlog},ID)";
        } else {
            $checkQuery = "puede_aceptar('{$nombre}',ID)";
        }

        // Todas las misiones con enemigo
        $lineas = $this->prolog->consultar(
            "forall(mision(ID,Nom,Dif,XP), (mision_enemigo(ID,Enemigo), format('~w,~w,~w,~w,~w~n',[ID,Nom,Dif,XP,Enemigo])))"
        );
        $todasMisiones = [];
        foreach ($lineas as $linea) {
            if (trim($linea) === '') continue;
            $partes = explode(',', trim($linea));
            if (count($partes) < 5) continue;
            [$id, $misionNombre, $dificultad, $xp, $enemigo] = $partes;
            $todasMisiones[$id] = compact('id', 'misionNombre', 'dificultad', 'xp', 'enemigo');
        }

        $lineas = $this->prolog->consultar(
            "forall((mision(ID,_,_,_), {$checkQuery}, nivel_peligro('{$nombre}',ID,P)), format('~w,~w~n',[ID,P]))"
        );
        $disponibles = [];
        foreach ($lineas as $linea) {
            if (trim($linea) === '') continue;
            $partes = explode(',', trim($linea));
            if (count($partes) < 2) continue;
            $disponibles[$partes[0]] = $partes[1];
        }

        $misiones = [];
        foreach ($todasMisiones as $id => $m) {
            $m['disponible'] = isset($disponibles[$id]);
            $m['peligro']    = $disponibles[$id] ?? null;
            $misiones[]      = $m;
        }

        // Stats de cada aliado
        $aliadosStats = [];
        $danoEquipo   = $danoTotal;

        if (!empty($aliados)) {
            foreach ($aliados as $ali) {
                $aLineas = $this->prolog->consultar(
                    "personaje('{$ali}', AN, AV), format('~w,~w~n',[AN,AV])"
                );
                $aliNivel = 0; $aliVida = 0;
                if (!empty($aLineas[0])) {
                    $sp = explode(',', trim($aLineas[0]));
                    if (count($sp) >= 2) [$aliNivel, $aliVida] = $sp;
                }
                $dLineas = $this->prolog->consultar(
                    "inventario('{$ali}', L), sumar_armas(L, D), format('~w~n',[D])"
                );
                $aliDano = (int)($dLineas[0] ?? 0);
                $aliadosStats[$ali] = [
                    'nombre' => $ali,
                    'nivel'  => (int)$aliNivel,
                    'vida'   => (int)$aliVida,
                    'dano'   => $aliDano,
                ];
            }

            // Daño grupal total via Prolog (danogrupal/2)
            $listaProlog = $this->prologLista($equipo);
            $eLineas = $this->prolog->consultar(
                "danogrupal({$listaProlog}, D), format('~w~n',[D])"
            );
            $danoEquipo = (int)($eLineas[0] ?? $danoTotal);
        }

        return view('juego.personaje', compact(
            'nombre', 'nivel', 'vida', 'inventario', 'danoTotal', 'misiones',
            'aliados', 'aliadosStats', 'danoEquipo'
        ));
    }

    public function seleccionarArmas(string $personaje, string $mision)
    {
        // Datos de la misión
        $lineas = $this->prolog->consultar(
            "mision({$mision}, Nom, Dif, XP), mision_enemigo({$mision}, Enemigo), vida_objetivo({$mision}, VidaE), format('~w,~w,~w,~w,~w~n',[Nom,Dif,XP,Enemigo,VidaE])"
        );
        $misionNombre = 'Misión'; $dificultad = 0; $xp = 0; $enemigo = '?'; $vidaEnemigo = 0;
        if (!empty($lineas[0]) && trim($lineas[0]) !== '') {
            $p = explode(',', trim($lineas[0]));
            if (count($p) >= 5) {
                [$misionNombre, $dificultad, $xp, $enemigo, $vidaEnemigo] = $p;
            }
        }

        // Inventario del jugador
        $lineas = $this->prolog->consultar(
            "inventario('{$personaje}', L), forall(member(A,L), (arma(A,D) -> format('~w,~w~n',[A,D]) ; format('~w,0~n',[A])))"
        );
        $inventario = [];
        foreach ($lineas as $linea) {
            if (trim($linea) === '') continue;
            $partes = explode(',', trim($linea));
            if (count($partes) < 2) continue;
            $inventario[] = ['nombre' => $partes[0], 'dano' => (int)$partes[1]];
        }

        // Aliados
        $aliados = $this->parseAliados(request()->input('aliados', ''));

        // Inventario de cada aliado (para mostrar en la vista)
        $aliadosInventarios = [];
        foreach ($aliados as $ali) {
            $aLineas = $this->prolog->consultar(
                "inventario('{$ali}', L), forall(member(A,L), (arma(A,D) -> format('~w,~w~n',[A,D]) ; format('~w,0~n',[A])))"
            );
            $inv = [];
            foreach ($aLineas as $linea) {
                if (trim($linea) === '') continue;
                $partes = explode(',', trim($linea));
                if (count($partes) < 2) continue;
                $inv[] = ['nombre' => $partes[0], 'dano' => (int)$partes[1]];
            }
            $aliadosInventarios[$ali] = $inv;
        }

        $misionId = $mision;
        return view('juego.armas', compact(
            'personaje', 'misionId', 'misionNombre', 'dificultad', 'xp',
            'enemigo', 'vidaEnemigo', 'inventario', 'aliados', 'aliadosInventarios'
        ));
    }

    public function ejecutarMision(string $personaje, string $mision)
    {
        $armasSeleccionadas = request()->input('armas', []);
        $armasUsadas        = $armasSeleccionadas;
        $aliados            = $this->parseAliados(request()->input('aliados', ''));

        // Datos del enemigo
        $enemigoLineas = $this->prolog->consultar(
            "mision_enemigo({$mision}, Enemigo), vida_objetivo({$mision}, Vida), format('~w,~w~n',[Enemigo,Vida])"
        );
        $enemigo = '?'; $vidaEnemigo = 0;
        if (!empty($enemigoLineas[0])) {
            $p = explode(',', trim($enemigoLineas[0]));
            if (count($p) >= 2) { [$enemigo, $vidaEnemigo] = $p; }
        }

        // Daño del jugador con armas seleccionadas
        $danoJugador = null;
        if (!empty($armasSeleccionadas)) {
            $listaProlog = implode(',', $armasSeleccionadas);
            $dLineas = $this->prolog->consultar(
                "sumar_armas([{$listaProlog}], D), format('~w~n',[D])"
            );
            $danoJugador = (int)($dLineas[0] ?? 0);
        }

        // Daño de cada aliado (inventario completo en Prolog)
        $aliadosDanos = [];
        $danoAliados  = 0;
        foreach ($aliados as $ali) {
            $aLineas = $this->prolog->consultar(
                "inventario('{$ali}', L), sumar_armas(L, D), format('~w~n',[D])"
            );
            $d = (int)($aLineas[0] ?? 0);
            $aliadosDanos[$ali] = $d;
            $danoAliados += $d;
        }

        $danoTotal  = ($danoJugador ?? 0) + $danoAliados;
        $danoAliado = $danoAliados; // total de todos los aliados (compat con vista)

        if ($danoJugador !== null) {
            $peligroNivel = ($danoTotal >= (int)$vidaEnemigo) ? 'bajo' : 'alto';
        } else {
            $p = $this->prolog->consultar(
                "nivel_peligro('{$personaje}', {$mision}, P), format('~w~n',[P])"
            );
            $peligroNivel = $p[0] ?? 'desconocido';
        }

        // Reporte narrativo: grupal si hay aliados
        $equipo = array_merge([$personaje], $aliados);
        if (!empty($aliados)) {
            $listaProlog = $this->prologLista($equipo);
            $reporte = $this->prolog->consultar(
                "generar_reporte({$listaProlog}, {$mision}, M), format('~w~n',[M])"
            );
            $mensaje = $reporte[0] ?? implode(', ', $equipo) . ' intentaron la misión.';
        } else {
            $reporte = $this->prolog->consultar(
                "generar_reporte('{$personaje}', {$mision}, M), format('~w~n',[M])"
            );
            $mensaje = $reporte[0] ?? 'No puede completar esta misión.';
        }

        // Mejor aliado: solo en modo solo (no tiene sentido si ya hay equipo)
        $mejorAliado = 'Ninguno';
        if (empty($aliados)) {
            $aliadoSugerido = $this->prolog->consultar(
                "mejor_aliado('{$personaje}', {$mision}, A), format('~w~n',[A])"
            );
            $mejorAliado = trim($aliadoSugerido[0] ?? 'Ninguno');
        }

        // Info de la misión
        $infoLineas = $this->prolog->consultar(
            "mision({$mision}, Nom, Dif, XP), format('~w,~w,~w~n',[Nom,Dif,XP])"
        );
        $misionNombre = $mision; $dificultad = 0; $xp = 0;
        if (!empty($infoLineas[0])) {
            $p = explode(',', trim($infoLineas[0]));
            if (count($p) >= 3) { [$misionNombre, $dificultad, $xp] = $p; }
        }

        return view('juego.mision', compact(
            'personaje', 'mision', 'misionNombre', 'mensaje',
            'peligroNivel', 'mejorAliado', 'danoJugador', 'danoAliado',
            'aliadosDanos', 'danoTotal', 'armasUsadas',
            'aliados', 'dificultad', 'xp', 'enemigo', 'vidaEnemigo'
        ));
    }
}
