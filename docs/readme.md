# Mise en place environnement
  Clonage du paquet et installation du Symfony Skeleton 4.*
  
### Installation de postgreSQL
  Dans l'optique de coller à la stack de travail, j'installe **postgreSQL** sur mon poste de développement .
```sh
sudo apt-get install postgresql
su - postgres
# Visiblement, le mot de passe de mon user `postgres` n'est pas reconnu, pas configuré.
sudo passwd postgres
# Maintenant c'est ok
su - postgres
psql

# Dans le prompt de postgresql :
CREATE ROLE userName WITH LOGIN SUPERUSER CREATEDB CREATEROLE PASSWORD 'superMotDePasse';

```

Je teste sous adminer si j'ai bien accès à ma DB, et bien non j'ai une erreur de Peer authentication, je me renseigne et cherche une solution.

Visiblement postgresql s'attends à ce que mon utilisateur systeme corresponde à l'utilisateur de postgresql, c'est pas mon but là, sur ma machine, je vois qu'il est possible de modifier la méthode de connexion de `peer` à `md5` ça me parait cohérent, ça se tente.

```sh
cd /etc/postgresql/14/main
sudo nano pg_hba_conf

# "local" is for Unix domain socket connections only
local   all             all                                     md5 #avant c'était peer :-)
```
Ok tout fonctionne je passe à la suite, la définition des entités, leur relations aussi subtile soit elle.


