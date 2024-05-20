# Installation de Symfony

Crée un nouveau projet Symfony nommé "oflix" en utilisant Composer:

```bash

composercreate-projectsymfony/skeletonoflix^6

```

Déplace tous les fichiers et répertoires à l'intérieur du répertoire "oflix" vers le répertoire actuel:

```bash

mvoflix/*oflix/.*.

```

Supprime le répertoire "oflix" vide:

```bash

rmdiroflix

```







Installer la gestion d'Apache (htaccess entre autre)

Pour visualiser les routes existantes (éventuellement avec son controlleur)

```bash

bin/console debug:route --show-controllers

```

Installation du moteur de template TWIG, ceci nous ajoute un répertoir `templates` dans lequel on va retrouver tous les templates

```bash

composer require twig

```

Installation de la gestion des asset

```bash

composerrequire symfony/asset

```

Installation de la profile bar

```bash
```bash
composer require debug-bundle
```

Installation du bundle maker

```bash
composer require --dev symfony/maker-bundle
```


composer require symfony/profiler-pack

```

```
