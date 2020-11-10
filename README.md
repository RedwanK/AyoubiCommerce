# AyoubiCommerce

### Installation

```sh
$ git clone git@github.com:RedwanK/AyoubiCommerce.git
$ cd AyoubiCommerce/config
$ touch env.php
```

Variables du fichier ```AyoubiCommerce/config/env``` :

| Nom | Example |
| ------ | ------ |
| BD_HOST | localhost |
| BD_DBNAME | webapp |
| BD_USER | root |
| BD_PWD | admadm |

Example de fichier :

```
<?php
const BD_HOST = 'localhost';
const BD_DBNAME = 'webapp';
const BD_USER = 'root';
const BD_PWD = 'admadm';
```

* Enfin, importer le fichier ```AyoubiCommerce/db/ayoubi.sql``` dans votre base de données.
* Des comptes par défaut sont accessibles dans le fichier ```AyoubiCommerce/db/passwords```.