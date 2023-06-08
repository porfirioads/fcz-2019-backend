# Backend de la aplicación del Festival Cultural de Zacatecas 2019

Este proyecto contiene un panel web de administración, así como una API que 
ofrece el contenido a desplegar en la aplicación móvil del Festival Cultural.

## Instrucciones de instalación

```bash
# Clonar proyecto:
git clone git@gitlab.com:porfirioads/fcz_2019_backend.git

# Ejecutar scripts de la base de datos:
database/create.sql

# Instalar dependencias:
cd fcz_2019_backend
composer install

# Crear archivo .env y agregar configuraciones necesarias:
cp .env.example .env
```

## Git branching strategy

```bash
# Crear rama develop a partir de la master
git checkout -b develop

# Cada feature se implementará en una rama desprendida de develop
git checkout -b Feature1
git checkout -b Feature2
git checkout -b FeatureN

# Hacer todos los commits auxiliares en las ramas de features
git commit -m "commit auxiliar 1"
git commit -m "commit auxiliar 2"

# Rebasar la rama develop para combinar los commits auxiliares en uno solo
git rebase -i develop
git checkout develop
git merge FeatureN

# Una vez que la rama develop pasa todas las pruebas, mezclarla con la master
git checkout master
git merge develop
```
