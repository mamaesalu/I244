#Projekt aines I244 - Ülesannete haldamise rakendus ehk "Ülesannete kodu"

Rakenduses saab pidada arvestust ühe pere ülesannete üle.

Projekti kirjutamise jooksvad commitid on leitavad minu [I244 repost](https://github.com/mamaesalu/I244)

##Olemas
Vastavalt õigustele saab kas kõigi kasutajate või ainult enda ülesandeid lisada, muuta ja kustutada.
Admin ehk lapsevanem näeb ja saab lisada ning muuta või kustutada kõikide kasutajate üleandeid. Tavakasutajad ehk lapsed näevad ja saavad muuta ning lisada või kustutada ainult iseenda ülesandeid.

#####Tuleb edaspidi ehk mis lisaks võiks olla 
Lisaks kustutamisele võimalus ülesandeid täidetuks märkida, nii et nendest tekiks tehtud ülesannete arhiiv.
Täitmise tähtaeg ehk kuupäev paremas formaadis (hetkel input type = "date"), kasutades nt jquery datepickerit või AJAXit, sest olenevalt lehitsejast (vanemad lehitsejad ja Firefox) võib praegune lahendus mitte kõige paremini toimida.

##Tabelid andmebaasis
####Users
id, usern, passw, role
####Tasks
id, user_id, task, deadline

##Retsenseerimiseks/testimiseks:
admin/admin (roll admin), user1/user1 (roll user)


This work is licenced under [Creative Commons Non-Commercial 4.0] (https://creativecommons.org/licenses/by-nc/4.0/)

