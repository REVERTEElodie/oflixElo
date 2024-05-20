# E19 - Tests

## Les différents types de tests

### Les tests Unitaires

Qui permettent de tester le code d'une classe

### Les tests d'intégration

Qui permettent de tester le fonctionnement de plusieurs classes entre elles

### Les tests fonctionnels

Qui permettent de tester une fonctionnalité complète ( un Use Case par exemple )

## Installation dans Symfony

On suit la doc

<https://symfony.com/doc/current/testing.html>

```bash
# installation du composant de test
composer require --dev symfony/test-pack
# pour exécuter les tests
bin/phpunit
```

### Tests Unitaires

```bash
# création d'un test
bin/console make:test
# on créé un test unitaire
```

Dans un test unitaire on aura toujours 3 étapes.

- instancier le service qui contient la méthode à tester
- exécuter la méthode à tester
- vérifier à l'aide d'un assert que la valeur est bien celle attendue ( liste des asserts disponible [sur la doc de PHPUnit](https://docs.phpunit.de/en/9.6/assertions.html) )

#### DataProvider

On peut simplifier l'écriture de nos tests en [utilisant un dataProvider](https://docs.phpunit.de/en/9.6/writing-tests-for-phpunit.html#data-providers)

### Test d'intégrations

On ne verra pas les tests d'intégrations ajd, car il y a plus fun avec ...

### Tests fonctionnels

On va utiliser un navigateur pour accéder à notre application.
Ainsi on pourra tester :

- les acl
- que les messages sont corrects
- des fonctionnalités complexes ( type mise en favori )
- ...

#### Mise en place

On commence par créer une BDD de test.

On définit les accès à cette BDD dans .env.test.local

```yaml
# dans .env.test.local
# attention à vérifier que l'utilisateur a bien accès à la BDD
# car le suffixe _test est ajouté au nom de la BDD
# ici cela fonctionne car on utilise explorateur qui est super admin
# mais avec un user oflix_fajitas par exemple , on aurait eu un problème de droit
DATABASE_URL="mysql://explorateur:Ereul9Aeng@127.0.0.1:3306/oflix_fajitas?serverVersion=10.3.38-MariaDB&charset=utf8mb4"
```

On crée la BDD en ajoutant `--env=test` aux commandes habituelles ou en passant en environnement de test `APP_ENV=test` dans le fichier `.env`

```bash
# création de la BDD
bin/console doctrine:database:create --env=test
# création des tables
bin/console doctrine:migrations:migrate --env=test
# création des données
bin/console doctrine:fixtures:load --env=test

# création du test
bin/console make:test
```

Dans un test fonctionnel, on va souvent avoir les étapes suivantes

- démarrage d'un navigateur
- connexion d'un utilisateur ( optionnel )
- accès à une page
- interaction avec la page ( optionnel )
  - on peut remplir un formulaire et le soumettre par exemple
- test de la réponse avec des [asserts spécifiques pour ce type de test](https://symfony.com/doc/current/testing.html#testing-the-response-assertions)
