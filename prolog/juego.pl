% ===== PERSONAJES =====
personaje('Elara', 5, 100).
personaje('Kael', 3, 80).
personaje('Rin', 7, 120).
personaje('Daniel', 8, 200).
personaje('Sofia', 6, 150).
personaje('Nico', 3, 90).


% ===== MISIONES =====
mision(m1, 'Bosque de Sombras', 2, 50).
mision(m2, 'Cueva del Dragon', 5, 120).
mision(m3, 'Torre Arcana', 7, 200).
mision(m4, 'Pantano Maldito', 3, 80).
mision(m5, 'Ruinas del Imperio', 6, 160).
mision(m6, 'Cripta Eterna', 9, 300).


% ===== ARMAS =====
arma(espada, 160).
arma(escudo, 50).
arma(pocion, 40).
arma(arco, 15).
arma(flechas, 90).
arma(varita, 80).
arma(amuleto, 2).
arma(grimorio, 0).


% ===== INVENTARIO =====
inventario('Elara',  [espada, escudo, pocion]).
inventario('Kael',   [arco, flechas]).
inventario('Rin',    [varita, grimorio, pocion, amuleto]).
inventario('Daniel', [espada, pocion, varita, escudo, flechas, arco]).
inventario('Sofia',  [varita, pocion]).
inventario('Nico',   [espada]).


% ===== REQUISITOS POR MISION =====
requiere(m2, escudo).
requiere(m2, pocion).
requiere(m3, grimorio).
requiere(m3, pocion).


% ===== ENEMIGOS =====
enemigo('Zombie', 20).
enemigo('Slenderman', 70).
enemigo('Ogro', 150).


% ===== MISION - ENEMIGO ASOCIADO =====
% Enemigos asignados de menor a mayor segun la dificultad de la mision:
% Zombie (debil) -> misiones faciles | Ogro (fuerte) -> misiones dificiles
mision_enemigo(m1, 'Zombie').      % dificultad 2
mision_enemigo(m4, 'Zombie').      % dificultad 3
mision_enemigo(m2, 'Slenderman').  % dificultad 5
mision_enemigo(m5, 'Slenderman').  % dificultad 6
mision_enemigo(m3, 'Ogro').        % dificultad 7
mision_enemigo(m6, 'Ogro').        % dificultad 9


% ===== CONJUGACION VERBAL =====
tiempo(presente).
tiempo(pasado).
tiempo(futuro).
persona(primera).
persona(segunda).
persona(tercera).
numero(singular).
numero(plural).

ser(presente, tercera, singular, "es").
ser(pasado,   tercera, singular, "fue").
ser(futuro,   tercera, singular, "será").
ser(presente, primera, singular, "soy").
ser(presente, primera, plural,   "somos").
ser(presente, tercera, plural,   "son").


% ===== REGLAS =====

% --- puede_aceptar/2 ---
% Un personaje puede aceptar una mision si su nivel es >= a la dificultad
puede_aceptar(Personaje, ID_Mision) :-
    personaje(Personaje, Nivel, _),
    mision(ID_Mision, _, Dificultad, _),
    Nivel >= Dificultad.


% --- xp_acumulada/2 ---
% Calculo recursivo: XP(N) = XP(N-1) + (30*N)
xp_acumulada(0, 0).
xp_acumulada(N, Total) :-
    N > 0,
    N1 is N - 1,
    xp_acumulada(N1, Prev),
    Total is Prev + (30 * N).


% --- tiene_requerido/2 ---
% Verifica si un personaje tiene un objeto en su inventario
tiene_requerido(Personaje, Objeto) :-
    inventario(Personaje, Lista),
    member(Objeto, Lista).


% --- mismo_nivel/2 ---
% Detecta dos personajes distintos con el mismo nivel
mismo_nivel(P1, P2) :-
    personaje(P1, N, _),
    personaje(P2, N, _),
    P1 \== P2.


% --- es_balanceado/1 ---
% Verifica si un personaje tiene exactamente 100 puntos de vida
es_balanceado(Personaje) :-
    personaje(Personaje, _, Vida),
    Vida =:= 100.


% --- fusionar_equipos/3 ---
% Combina los inventarios de dos personajes en una sola lista
fusionar_equipos(P1, P2, EquipoFusionado) :-
    inventario(P1, L1),
    inventario(P2, L2),
    append(L1, L2, EquipoFusionado).


% --- conjugar_accion/5 ---
% Conjuga el verbo "ser"; para cualquier otro verbo devuelve el infinitivo
conjugar_accion(Verbo, Tiempo, Persona, Numero, Conjugacion) :-
    tiempo(Tiempo), persona(Persona), numero(Numero),
    ( Verbo = "ser" ->
        ser(Tiempo, Persona, Numero, R),
        Conjugacion = R
    ; Conjugacion = Verbo ).


% --- todos_pueden_aceptar/2 ---
% Caso base: lista vacia, todos aceptaron
todos_pueden_aceptar([], _).
% Caso recursivo: verifica cabeza y continua con el resto
todos_pueden_aceptar([Personaje | Resto], MisionID) :-
    puede_aceptar(Personaje, MisionID),
    todos_pueden_aceptar(Resto, MisionID).


% --- generar_reporte/3 (singular) ---
% Genera un mensaje narrativo para un solo personaje
generar_reporte(Personaje, MisionID, Mensaje) :-
    personaje(Personaje, _, _),
    puede_aceptar(Personaje, MisionID),
    mision(MisionID, Nombre, Dificultad, XP_Base),
    xp_acumulada(Dificultad, XP_Total),
    conjugar_accion("ser", presente, tercera, singular, FormaVerbal),
    atomic_list_concat(
        [Personaje, FormaVerbal, "capaz de completar", Nombre,
         "por", XP_Base, "XP (", XP_Total, "XP acumulada)"],
        ' ', Mensaje).

% --- generar_reporte/3 (plural) ---
% Genera un mensaje narrativo para un grupo de personajes
generar_reporte([P1, P2 | Resto], MisionID, Mensaje) :-
    Lista = [P1, P2 | Resto],
    todos_pueden_aceptar(Lista, MisionID),
    mision(MisionID, Nombre, Dificultad, XP_Base),
    xp_acumulada(Dificultad, XP_Total),
    conjugar_accion("ser", presente, tercera, plural, FormaVerbal),
    atomic_list_concat(Lista, ' y ', NombresUnidos),
    atomic_list_concat(
        [NombresUnidos, FormaVerbal, "capaces de completar", Nombre,
         "por", XP_Base, "XP (", XP_Total, "XP acumulada)"],
        ' ', Mensaje).


% --- sumar_armas/2 ---
% Suma recursivamente el daño de todas las armas de una lista
sumar_armas([], 0).
sumar_armas([Arma | Resto], Total) :-
    arma(Arma, Dano),
    sumar_armas(Resto, SubTotal),
    Total is Dano + SubTotal.


% --- atacar/2 ---
% Calcula si un jugador puede derrotar a un enemigo con su inventario actual
atacar(Jugador, Enemigo) :-
    inventario(Jugador, ListaArmas),
    sumar_armas(ListaArmas, DanoTotal),
    enemigo(Enemigo, Vida),
    ( DanoTotal >= Vida ->
        Resultado = "¡El ataque es letal! El enemigo muere."
    ; Resultado = "El ataque no fue suficiente. El enemigo sobrevive."
    ),
    format('~w ataca a ~w con todo su arsenal (Daño Total: ~w). ~w~n',
        [Jugador, Enemigo, DanoTotal, Resultado]).


% --- danogrupal/2 ---
% Suma el daño total de una lista de jugadores
danogrupal([], 0).
danogrupal([Jugador | Resto], DanoTotal) :-
    inventario(Jugador, ListaArmas),
    sumar_armas(ListaArmas, DanoJugador),
    danogrupal(Resto, DanoResto),
    DanoTotal is DanoJugador + DanoResto.


% --- ataque_grupal/2 ---
% Evalua si un grupo de jugadores puede vencer a un enemigo
ataque_grupal(ListaJugadores, Enemigo) :-
    enemigo(Enemigo, Vida),
    danogrupal(ListaJugadores, DanoTotal),
    ( DanoTotal >= Vida ->
        Resultado = "¡Victoria! El grupo logró vencer al enemigo."
    ; Resultado = "No lograron vencer al enemigo."
    ),
    format('El grupo ataca a ~w (Vida: ~w) con un daño total de ~w. ~w~n',
        [Enemigo, Vida, DanoTotal, Resultado]).


% --- vida_objetivo/2 ---
% Vida efectiva del enemigo de una mision, escalada por la dificultad.
% Asi una misma criatura es mas dura en una mision mas dificil y el
% combate queda alineado con el nivel de la mision.
%   VidaEfectiva = VidaBase + (Dificultad * 20)
vida_objetivo(MisionID, VidaEfectiva) :-
    mision_enemigo(MisionID, Enemigo),
    enemigo(Enemigo, VidaBase),
    mision(MisionID, _, Dificultad, _),
    VidaEfectiva is VidaBase + (Dificultad * 20).


% --- puede_sobrevivir/2 ---
% Verifica si el daño del personaje supera la vida efectiva del enemigo
puede_sobrevivir(Personaje, MisionID) :-
    inventario(Personaje, Armas),
    sumar_armas(Armas, Dano),
    vida_objetivo(MisionID, VidaEnemigo),
    Dano >= VidaEnemigo.


% --- nivel_peligro/3 ---
% Clasifica el riesgo de una mision para un personaje (alto / bajo)
% comparando el daño del personaje contra la vida efectiva del enemigo
nivel_peligro(Personaje, MisionID, alto) :-
    inventario(Personaje, Armas),
    sumar_armas(Armas, Dano),
    vida_objetivo(MisionID, Vida),
    Dano < Vida.

nivel_peligro(Personaje, MisionID, bajo) :-
    inventario(Personaje, Armas),
    sumar_armas(Armas, Dano),
    vida_objetivo(MisionID, Vida),
    Dano >= Vida.


% --- mejor_aliado/3 ---
% Encuentra el aliado disponible para una mision que mayor daño puede infligir
mejor_aliado(Personaje, MisionID, Aliado) :-
    puede_aceptar(Aliado, MisionID),
    Aliado \== Personaje,
    inventario(Aliado, Armas),
    sumar_armas(Armas, Dano),
    \+ (
        puede_aceptar(Otro, MisionID),
        Otro \== Personaje,
        Otro \== Aliado,
        inventario(Otro, ArmasOtro),
        sumar_armas(ArmasOtro, DanoOtro),
        DanoOtro > Dano
    ).
