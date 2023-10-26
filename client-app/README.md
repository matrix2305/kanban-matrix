# Frontend deo kanban app

## Instalacija (Install)
```bash
npm i --no-save
```

## Pokretanje (Run)
```bash
npm run start
```


### Opis zadatka
**Kratak opis:**

Data je frontend React aplikacija koja predstavlja Kanban prikaz, sa sledećim mogućnostima:

Zadaci (Tasks)

 - Moguće je dodati novi zadatak u njegovu listu
 - Završiti zadatak
 - Prebaciti task iz liste u listu ili u kolonu gde su završeni zadaci
 - Moguce je menjati pozicije zadataka u listi

Liste (TaskLists)

- Moguće je završiti celu listu
- Moguće je obrisati listu
- Moguće je dodati novu listu


U sklopu aplikacije dodat je data.json  - koji predstavlja neku backend strukturu response-a. Možete ga koristiti da popunite vašu bazu ako želite (seed).



Vaš zadatak kao kandidata bi bio da napišete PHP Backend REST api aplikaciju koja komunicira sa frontend aplikacijom i podržava sve njene mogućnosti ali i dodatne stvari koje su zadate u kriterijumima kako bi frontend normalno fukncionisao sa vašim backend api-jem. Možete prilagoditi trenutnu frontend aplikaciju vašem backendu-u, bitno je samo da izgleda slično i radi isto sa pravim podacima iz vaše baze.

Za frontend aplikaciju su korišćeni paketi koji se najčešće koriste za ovakav tip aplikacije, react-redux, @redux/toolkit , react-beautiful-dnd itd. Svakako možete dodati one koji će vam omogućiti da aplikacija radi sa vašim backendom.




Prilikom izdrade api-ja moguće je koristiti bilo koji PHP framework i pakete koji vam olakšavaju izradu. Idealno bi bilo koristiti neke od sledećih relacionih tipova baza:MySQL, MariaDB, SQLite za bazu. Takodje možete koristiti i ORM alate i slično.

Bonus stavke vam donose dodatne poene koje će uticati na izbor da li ste baš Vi pravi kandidat za nas i odlučiće između ostalih kandidata (svaki dodatni rad na bonus zadacima uzeće se u razmatranje).



**Kriterijumi za prihvatanje:**


1. Postoji sql baza koja sadrži tabele: task_lists, users, labels, tasks i ostale tabele koje su vam potrebne za relacije.

2. Tasks (Entitet)

   1. Pripada uvek jednoj TaskList-i
   2. Poredjani su po poziciji u TaskList-i
   3. Moguće ga je zatvoriti (Complete).
   4. Sadrži svojstva id, name (obavezno), completed_on itd. Videti data.json za više detalja.
   5. Task može imati više zaduženih osoba (assignee).
   6. Task može imati početak i krajni rok (start_on, due_on).
   7. Taskovi se mogu premeštati iz liste u drugu listu.
   8. Takođe moguće je promeniti poziciju u listi ili njegovu listu.
   9. Moguće je dodati novi zadatak u listu.

3. TaskList (Entitet)

   1. Sadrži svoje taskove
   2. Mogće je zatvoriti listu (kompletirati listu).
      1. Prilikom zatvaranje, svi njeni taskovi su takođe markirani kao zatvoreni.
   3. Moguće je obrisati listu (Soft Delete).
   4. Moguće je dodati novu listu , gde je name obavezno polje.
4. Neophodno je napraviti REST API koji komunicira sa frontend delom aplikacije.
5. Podržati sve API endpoint-e u frontend aplikaciji i dohvatiti inicijalne podatke.
6. Svaka akcija u frontend delu aplikacije bi trebala da pozove odgovarajucu na backendu i da stanje frontend aplikacije očitava ono stanje sa backend aplikacije.
7. Postoji public git repozitorijum sa rešenjem ovog zadatka i uputstvom (dokumentacijom) kako se radi setup projekta.



**Bonus:**


1. Napraviti login stranicu za korisnika gde korisnik unosi email i lozinku za logovanje na aplikaciju.
   1. Kanban prikaz je samo dostupan za ulogovane korisnike.
2. Moguće je ažurirati zadatak i dodati zaduženu osobu ili promeniti sva njegova svojstva.
3. Napisani su phpunit testovi za REST api.


