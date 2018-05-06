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

# API Routes
I path per le operazioni standard sono visibili dall'url http://159.89.102.18/api
La lista completa è la seguente:
------------------------------------------- -------- -------- ------ ---------------------------------------------------- 
  Name                                        Method   Scheme   Host   Path                                                
 ------------------------------------------- -------- -------- ------ ---------------------------------------------------- 
  retrieve_map_image                          GET      ANY      ANY    /api/image/map/{id}                                 
  write_map_image                             POST     ANY      ANY    /api/image/map/{id}                                 
  delete_beacons_by_map                       DELETE   ANY      ANY    /api/mappas/{id}/beacons                            
  update_map_image                            PUT      ANY      ANY    /api/image/map/{id}                                 
  delete_dati_mappa                           DELETE   ANY      ANY    /api/custom/mappas/{id}                             
  api_entrypoint                              ANY      ANY      ANY    /api/{index}.{_format}                              
  api_doc                                     ANY      ANY      ANY    /api/docs.{_format}                                 
  api_jsonld_context                          ANY      ANY      ANY    /api/contexts/{shortName}.{_format}                 
  api_beacons_get_collection                  GET      ANY      ANY    /api/beacons.{_format}                              
  api_beacons_post_collection                 POST     ANY      ANY    /api/beacons.{_format}                              
  api_beacons_get_item                        GET      ANY      ANY    /api/beacons/{id}.{_format}                         
  api_beacons_delete_item                     DELETE   ANY      ANY    /api/beacons/{id}.{_format}                         
  api_beacons_put_item                        PUT      ANY      ANY    /api/beacons/{id}.{_format}                         
  api_beacons_mappa_get_subresource           GET      ANY      ANY    /api/beacons/{id}/mappa.{_format}                   
  api_beacons_mappa_beacons_get_subresource   GET      ANY      ANY    /api/beacons/{id}/mappa/beacons.{_format}           
  api_mappas_get_collection                   GET      ANY      ANY    /api/mappas.{_format}                               
  api_mappas_post_collection                  POST     ANY      ANY    /api/mappas.{_format}                               
  api_mappas_get_item                         GET      ANY      ANY    /api/mappas/{id}.{_format}                          
  api_mappas_delete_item                      DELETE   ANY      ANY    /api/mappas/{id}.{_format}                          
  api_mappas_put_item                         PUT      ANY      ANY    /api/mappas/{id}.{_format}                          
  api_mappas_beacons_get_subresource          GET      ANY      ANY    /api/mappas/{id}/beacons.{_format}                  
  api_mappas_beacons_mappa_get_subresource    GET      ANY      ANY    /api/mappas/{id}/beacons/{beacons}/mappa.{_format}  
  _twig_error_test                            ANY      ANY      ANY    /_error/{code}.{_format}                            
 ------------------------------------------- -------- -------- ------ ---------------------------------------------------- 

