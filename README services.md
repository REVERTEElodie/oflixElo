# Exercice Utilisation de Services sur O'flix

## Service Slugger intégré à Symfony

> ⁉️ On souhaite remplacer l'usage de l'id dans les routes du front par le slug du film.

> ℹ️ Slug (publication web) est un court texte utilisable dans une URL et facilement compréhensible à la fois par les utilisateurs et les moteurs de recherche pour décrire et identifier une ressource. ([Wikipedia](https://fr.wikipedia.org/wiki/Slug))

Un _Slugger_ permettra de transformer le titre de `Movie` en _"slug"_, par ex. _"Hello World"_ en _"hello-world"_ et pouvoir l'utiliser comme identifiant dans l'URL (SEO friendly !) => `/movie/le-fabuleux-destin-d-amelie-poulain` au lieu de `/movie/354` 🧙

![](./movie_slug.png)

Pour ce faire nous allons utiliser un service, accessible via le type `SluggerInterface` et fourni par le composant _String_ de Symfony, voir https://symfony.com/doc/current/components/string.html#slugger. (Ne pas utuliser la classe `AsciiSlugger` donc 😉).

:bulb: Utilisez la commande `php bin/console debug:autowiring` pour lister les services injectables en _autowiring_ (en _câblage automatique_ c'est à dire injectable par _type hinting/déclaration de type_).

:bulb: Astuce. Utilisez la commande `php bin/console debug:autowiring Slugger` pour filtrer les résultats de recherche.

### Objectifs

1. Modifier l'entité Movie pour pouvoir y stocker le slug (nouvelle propriété + migration à créer).
2. Utiliser le service `SluggerInterface` **dans les Fixtures** sur la génération des films (le slug est créé à partir du titre). Exécuter les Fixtures pour mettre à jour vos données.
3. Utiliser le slug dans la route `movie_show` en remplaçant `{id}` par `{slug}` **uniquement sur le front**.

## Bonus service à nous, configurable

> Notre service pourrait s'utiliser comme ceci `$mySlugger->slugify('Hello World);` et cette méthode fera usage du Slugger de Symfony.

- Comme dans l'exemple du cours (FavoritesManager), créer un service custom genre `MySlugger` qui utilise le service `SluggerInterface` de Symfony
  - Exemple d'utilisation ici : https://symfony.com/doc/current/components/string.html#slugger à partir de _In a Symfony application..._
- Si pas déjà fait, utiliser la méthode `->lower()` du Slugger pour passer le slug en minuscule.
  - `$slug = $this->slugger->slug('...')->lower();`
- Utiliser la configuration de `services.yaml` pour configurer un paramètre `$toLower` qui viendrait gérer ce comportement (on souhaite activer ou non le passage en minuscule)
  - Idéalement, déplacer cette configuration jusqu'au `.env`

### Admin Movie Slugger

- Utiliser le service pour stocker le slug dans l'entité `Movie` **à l'ajout ou à l'édition d'un film**.

---

Bon courage :muscle: !