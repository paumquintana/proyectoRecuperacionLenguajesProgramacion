#!/usr/bin/env bash
#
# setup-git.sh — Inicializa el repositorio con un historial de commits atómicos
# siguiendo la convención de la guía de portafolio (feat / docs / chore).
#
# Ejecutar UNA sola vez, desde la raíz del proyecto, en tu Terminal de Mac:
#   bash setup-git.sh
#
set -e

# 1. Limpia cualquier repositorio parcial previo (creado en un intento anterior)
rm -rf .git

# 2. Inicializa y configura el repositorio
git init
git branch -M main
git config user.name  "paumquintana"
git config user.email "paula.martilloq@gmail.com"   # <-- usa el correo de TU cuenta de GitHub
git remote add origin https://github.com/paumquintana/proyectoRecuperacionLenguajesProgramacion.git

# 3. Commit base: estructura de Laravel (todo menos el código del juego y la documentación)
git add -A
git reset -q -- prolog app/Services app/Http/Controllers/JuegoController.php \
                resources/views/juego routes/web.php docs README.md capturas
git commit -m "chore: inicializa estructura base de Laravel 9"

# 4. Rama de feature con el motor del juego (commits atómicos por componente)
git checkout -b feature/motor-prolog

git add prolog
git commit -m "feat: agrega base de conocimiento Prolog con personajes, misiones y reglas"

git add app/Services
git commit -m "feat: integra SWI-Prolog con Laravel mediante PrologService"

git add app/Http/Controllers/JuegoController.php routes/web.php
git commit -m "feat: implementa JuegoController y rutas del flujo de juego"

git add resources/views/juego
git commit -m "feat: agrega vistas Blade del juego (seleccion, equipo, ficha, armas, resultado)"

# 5. Integra la rama a main con merge --no-ff (deja constancia de la integracion, tipo PR)
git checkout main
git merge --no-ff feature/motor-prolog \
  -m "Merge: integra motor de decisiones Prolog y vistas del juego"

# 6. Commit de documentacion (README + capturas)
git add README.md docs capturas
git commit -m "docs: agrega README de portafolio y capturas en docs/screenshots"

# 7. Sube todo a GitHub (te pedira autenticacion la primera vez)
git push -u origin main

echo ""
echo "=== Listo ==="
echo "Commits totales en main:"
git rev-list --count main
