# ids-api-server
API Server per il progetto relativo all'esame di Ingegneria del Software

# Installazione
eseguire composer install dopo essersi posizionati nella directory del progetto
modificare i parametri per la connessione al db nel file .env
eseguire 
```
bin/console doctrine:database:create
bin/console doctrine:migrations:migrate
```
e confermare
