README
======

- [Project setup](#project-setup)
  - [Requirements](#requirements)
  - [Optional](#optional)
  - [Quick start](#quick-start)
- [Development tools](#development-tools)
  - [Testing](#testing)
  - [Documentation](#documentation)

Project setup
-------------

### Requirements

- PHP >= 5.3.3
- JSON doit être activé
- ctype doit être activé
- le paramètre date.timezone doit être configuré dans votre PHP.ini
- pour utiliser Doctrine, PDO doit être installé. Le driver PDO doit être installé pour le serveur de bases de données que vous voulez utiliser.

### Optional
- le PHP-XML module doit être installé
- Au moins la version 2.6.21 de libxml
- PHP tokenizer doit être activé
- les fonctions mbstring functions doivent être activées
- iconv doit être activé
- POSIX doit être activé (seulement sur les systèmes *nix)
- Intl doit être installé avec ICU 4+
- APC 3.0.17+ (ou un autre cache d'opcode cache needs doit être installé)
- paramètres de PHP.ini recommandés
  - short_open_tag = Off
  - magic_quotes_gpc = Off
  - register_globals = Off
  - session.auto_start = Off

### Quick start
- décompresser l'archive à la racine du serveur web
- vérifier les exigences :
  - [localhost/Pablo/web/config.php][1]
- accéder à l'application en mode dev :
  - [http://localhost/Pablo/web/app_dev.php][2]
- accéder à l'application en mode prod :
  - supprimer le contenu du répertoire Pablo/app/cache
  - [http://localhost/Pablo/web/app.php][3]

Development tools
-----------------

### Testing

Pour pouvoir lancer les suites de tests, [phpunit][4] doit être installé sur votre système.

Lancer toute la suite de test

```sh
$ phpunit -c app
```
Lancer les tests dans un seul répertoire
```sh
$ phpunit -c app src/Pablo/UserBundle
```

Documentation
-------------

Pour la documention de développement : http://localhost/Pablo/doc

Pour générer la documentation, [phpdocumentor][5] doit être installé sur votre système.

[1]: http://localhost/Pablo/web/config.php
[2]: http://localhost/Pablo/web/app_dev.php
[3]: http://localhost/Pablo/web/app.php
[4]: http://www.phpunit.de/manual/current/en/index.html
[5]: http://www.phpdoc.org/docs/latest/for-users/installation.html