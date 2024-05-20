# Classes spécifiques PhpUnit pour Symfony

PHPUnit fournit des classes pour différents types de tests dans le contexte de Symfony. Voici une explication simplifiée pour chacune de ces classes :

## TestCase (PHPUnit\Framework\TestCase)

- **Objectif** : Classe de base pour les tests unitaires. Elle fournit un environnement de test de base et des méthodes utiles pour écrire des tests unitaires.
- **Utilisation** : Héritez de cette classe pour écrire des tests unitaires simples.

## KernelTestCase (Symfony\Bundle\FrameworkBundle\Test\KernelTestCase)

- **Objectif** : Utilisé pour les tests d'intégration avec le noyau (kernel) de Symfony. Il démarre le noyau de l'application Symfony pour tester l'intégration entre les différents composants.
- **Utilisation** : Héritez de cette classe pour écrire des tests d'intégration qui nécessitent l'utilisation du noyau Symfony.

## WebTestCase (Symfony\Bundle\FrameworkBundle\Test\WebTestCase)

- **Objectif** : Étend KernelTestCase pour les tests d'intégration avec un client HTTP. Il permet de tester des contrôleurs, les routes et la navigation à travers l'application.
- **Utilisation** : Héritez de cette classe pour écrire des tests d'intégration qui nécessitent des requêtes HTTP.

## ApiTestCase (ApiTestCase\ApiTestCase)

- **Objectif** : Conçu pour les tests d'API. Il offre des fonctionnalités spécifiques pour tester des applications basées sur des API REST.
- **Utilisation** : Héritez de cette classe pour écrire des tests d'API qui interagissent avec votre application via des requêtes HTTP.

## PanthertestCase (Symfony\Component\Panther\PantherTestCase;)

- **Objectif** : Panthère est une bibliothèque qui étend PHPUnit pour le testing de l'API de Symfony.
- **Utilisation** : Utilisé pour écrire des tests spécifiques pour l'API Symfony en utilisant Panthère.
