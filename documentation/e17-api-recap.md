# Api

## Sérialisation

pour renvoyer du json, on utilise la méthode `$this->json()` dans le controller.

Cependant pour transformer les entités en json, il nous faut installer le composant de Sérialisation

```bash
composer require symfony/serializer
```

Pour le problème de référence circulaire, on utilise les groupes de sérialisation.
C'est à dire que l'on va associer certaines propriétés à un groupe.
Et lors de la sérialisation on va préciser quels groupes de propriété sérialiser

```php
// ici on ne va sérialiser que les propriétés qui font parti du group1
// on peut également mettre ce meme groupe sur les entités associées
return $this->json([
    'movies' => $allMovies,
], 200, [], ["groups" => "group1"]);
```
