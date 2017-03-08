# MyPhpPicForm
Php app demo

#Introduzione
E' stata pensata per offrire una pagina web che consenta di caricare un XML secondo il formato descritto dalla consegna (vedi file https://github.com/johnatandante/MyPhpPicFor/blob/master/setup/EsercizioPHP.DOC) e consente di elaborarne il risultato per poi poterlo inviare al database MySQL per la memorizzazione dei dati richiesti. 

#Tecnologie utilizzate
L'applicazione utilizza le seguenti:
- Apache
- PHP
- MySQL
- Javascript JQuery

Per semplicità di instalazione si è scelto di creare un database generico "data_log", con i campi indicati nella consegna, tramite lo script https://github.com/johnatandante/MyPhpPicFor/blob/master/setup/init_db_data_log.sql; le impostazioni di default della connessione sono impostate via codice nella classe Php https://github.com/johnatandante/MyPhpPicFor/blob/master/services/DbService.php. Qualora si volesse cambiare questa configurazione occorre intervenire su questo file. 

Per la stesura del codice si è preferito utilizzare Visual Studio Code, mentre per il debugging delle pagine web e Javascript si è scelto l'utilizzo di Firefox, Chrome e Safari, con i loro strumenti di sviluppo.

Il sitema è stato installato, configurato e testato su ambienti Windows e Mac (OsX 10.X).

#Architettura
L'applicazione si stuttura in un sistema WebApp che consuma dei servizi api offerti dall'application server.
L'elaborazione dell'XML, difatti è offerta dalla API evaluate.php, mentre l'interazione con il database è offerta dalla API submitdata.php
Il controllo di validazione dei dati viene offerto via Javascript prima dell'invio dei dati stessi dalla WebApp, mentre il calcolo finale, che precede l'invio dei dati per la memorizzazione è offerto da una funzionalità Javascript.

#Modo d'uso
L'utente si collega alla WebApp installata, può impostare l'xml scheletro dell'applicazione e può valorizzare i campi parametro contrassegnati come necessari per il calcolo. Alla fine dell'inserimento può premere il pulsante "Evaluate" e, con un risultato valido, può premere il pulsante "Send" per concludere l'operazione; un alert notificherà l'utente dell'operazione avvenuta.

#Note conclusive
Non è stata implementata nessuno strumento di validazione del codice (ex Unit Test).
Non sono stati usati framework MVC: possono essere inclusi in uno sviluppo futuro, in quanto l'applicazione è configurata come WebApp che consuma servizi api forniti dall'application server Apache-PHP
Non sono stati inseriti stili CSS per la pagina web (es. Bootstrap): possono essere inclusi in uno sviluppo futuro senza troppo sforzo
Non ci sono configurazioni multi ambiente per il database: possono essere aggiunti senza troppe modifiche in uno sviluppo futuro
