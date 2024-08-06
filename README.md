# TravelApp

## Introduzione
TravelApp è una web app per la pianificazione e gestione del tuo viaggio. Permette di suddividere il viaggio in giornate, con ogni giornata che riporta le tappe da visitare. Ogni tappa può includere dettagli come titolo, descrizione, data, immagini, cibo, curiosità o altre informazioni. Le tappe del viaggio sono visualizzate su mappa tramite un servizio a scelta. L'app implementa funzionalità per tenere traccia della progressione delle tappe del viaggio anche quando la pagina viene chiusa.

## Tipi di Utenti
- **Utente Interessato (UI)**: un utente non registrato che visita il sito.
- **Utente Registrato (UR)**: un utente che ha effettuato la registrazione.

## Lista delle pagine

### Homepage
- Presenta la WebApp.
- Consente di fare Signup o Login.
- Dopo il login, i bottoni sono sostituiti da una sezione diversa.

### Pagina “I tuoi viaggi”
- Elenco di viaggi inseriti.
- Descrizione per ogni viaggio.
- Periodo (date).
- Bottone per aggiungere/creare un viaggio.

### Pagina singolo viaggio
- Elenco di tappe diviso in giornate.
- Bottone per aggiungere giornata.

### Pagina creazione singolo viaggio
- Form per inserire:
  - Titolo
  - Descrizione
  - Foto (1) usata come copertina
- Una volta creato, bottone per creare giornata.

### Pagina singola giornata
- Informazioni: titolo, descrizione, data…
- Divisa in sezioni “tappa” (stile menù a tendina), ordinate per ora (dalla prima all’ultima), con mappa della località in cui si svolge.
- Possibilità di editare titolo, descrizione e data.
- Possibilità di caricare una o più foto (da mostrare in slider). Possibilità di editare foto.
- Possibilità di dare voto a tappa.
- Possibilità di aggiungere note/commenti a tappa.

### Pagina creazione singola giornata
- Form per inserire:
  - Titolo di default (giornata 1, giornata 2…)
  - Titolo
  - Data
  - Descrizione
  - Foto (facoltativa)
- Se la giornata è creata, sezione per aggiungere tappe. Form “aggiungi tappa”:
  - Titolo
  - Categoria (attrazione storica all’aperto, museo, visita guidata, mare, escursione, trasferimento)
  - Descrizione

## Requisiti Tecnici
- **(RT1) Client-side Validation**: Tutti gli input inseriti dall’utente sono controllati client-side (oltre che server-side) per un controllo di veridicità.
- **(RT2) Il sito è responsive**: Il sito è correttamente visibile da desktop e da smartphone.
- **(RT3) Posizione tappa su mappa**: Le tappe del viaggio sono visualizzate su mappa tramite un servizio a scelta.

## Requisiti Funzionali
La piattaforma soddisfa i seguenti requisiti funzionali (RF):

- **(RF1) Permettere ai viaggiatori di registrarsi alla piattaforma**
  - **Visibilità**: UI
  - **Descrizione**: L’applicazione permette ai viaggiatori di registrarsi alla piattaforma e creare un profilo. Le informazioni che l’utente può inserire sono:
    - Nome*
    - Email*
    - Password *
  - I form devono rispettare RT1.
  - **Risultato**: Un nuovo utente viene creato nel sistema.
  - **Eccezioni**: Esiste già nel sistema un utente con l’email inserita.

- **(RF2) Permettere ai viaggiatori di aggiungere un viaggio**
  - **Visibilità**: UR
  - **Descrizione**: Un viaggiatore ha la possibilità di inserire un viaggio all’interno del sistema. 
    - Per inserire un nuovo viaggio vanno inserite le seguenti informazioni:
      - Titolo
      - Descrizione
      - Foto copertina
    - Dopo la creazione del viaggio, è possibile creare una giornata con queste informazioni:
      - Titolo
      - Data
      - Descrizione
      - Foto (facoltativa)
      - Dove si pernotta la sera di questa giornata (coordinate → mappa)**
      - Distanza da tappa precedente
      - Distanza da tappa successiva
    - Dopo la creazione della giornata, è possibile creare una tappa con queste informazioni:
      - Titolo
      - Categoria (attrazione storica all’aperto, museo, visita guidata, mare, escursione, trasferimento)
      - Luogo (coordinate → mappa)**
      - Descrizione
    - È possibile modificare le informazioni inserite.
    - I form devono rispettare RT1.
    - **Risultato**: Un viaggio è inserito nel sistema e le sue informazioni sono aggiornate.
    - **Eccezioni**: /

- **(RF3) Permettere ai viaggiatori di aggiungere note**
  - **Visibilità**: UR 
  - **Descrizione**: Un utente è in grado di aggiungere note per singola tappa e singola giornata.
  - **Risultato**: Viene aggiunta una nota alla tappa/giornata.
  - **Eccezioni**: /

- **(RF4) Permettere ai viaggiatori di votare tappe**
  - **Visibilità**: UR 
  - **Descrizione**: Un utente è in grado di aggiungere un voto ad ogni tappa. Automaticamente la giornata avrà come voto la media dei voti delle tappe.
  - **Risultato**: Viene aggiunto un voto alla tappa e quindi calcolato il voto della giornata.
  - **Eccezioni**: /


