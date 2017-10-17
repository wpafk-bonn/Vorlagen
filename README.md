# FK tools

Tools und HowTos für die FK

## Fachschaftenliste

Die Fachschaftenliste ist ein Anhang zur Geschäftsordnung der Fachschaftenkonferenz (FKGO). 
Sie regelt die Zuordnung von Fach-Abschluss-Kombinationen (FAKs) Fachschaften: Jede FAK der Uni Bonn
ist genau einer Fachschaft zugeordnet. Es ist nämlich so:

- Ein Studiengang besteht aus genau einem Abschluss (z.B. M.Sc.) und mindestens einem 
  Fach (z.B. English Studies und Romanistik)
- Eine Fach-Abschluss-Kombination besteht aus genau einem Abschluss und genau einem Fach, 
  die zusammen in einem Studiengang vorkommen (also beispielsweise um beim Beispiel zu 
  bleiben M.Sc. English Studies)

Die Universität kennt keine FAKs, die haben wir uns selbst ausgedacht. Die Fachschaftenliste listet nun 
zu jeder Fachschaft die es gibt alle FAKs auf, die ihr zugeordnet sind. Somit ergeben sich aus der 
Fachschaftenliste zwei Dinge:

- Die amtliche Liste aller existierenden Fachschaften
- Die Zuordnung von allen Studierenden zu ihrer Fachschaft

Bei der Zuordnung der Studierenden zu ihrer Fachschaft ist die FAK maßgeblich, hinter der sie auf ihrem 
Studierendenausweis das Sternchen bzw. den Vermerk "FS" haben.


## Fachschaftenliste aktualisieren

Die Universität modifiziert gelegentlich ihr Studienangebot, und so muss auch die Fachschaftenliste 
regelmäßig aktualisiert werden.

- FAKs können entfernt werden, wenn keine Person sie mehr studiert
- Alle neuen FAKs werden hinzugefügt und einer passenden Fachschaft zugeordnet

Die folgende Vorgehensweise hat sich bei der Aktualisierung bewährt.

### Benötigte Daten

- Studierendenstatistik - Personen - aktuelles Semester
- Studierendenstatistik - Fälle - aktuelles Semester
- Liste der Fachschaften der RFWU Bonn mit zugeordneten FAKs (Markdown)

Die Studierendenstatistik ist im Universitäts-Intranet erhältlich: 
[Link](https://www.intranet.uni-bonn.de/organisation/verwaltung/dez-9/abt-9.3/studierendenstatistik)

Die Liste der Fachschaften der RFWU Bonn mit zugeordneten FAKs im Markdown-Format kann im fstool 
heruntergeladen werden: [Link](https://gaia.asta.uni-bonn.de/fstool/fachschaften-md.php?fullnames)

### Daten vorbereiten

Die Excel-Dateien der Studierendenstatistik müssen in csv-Dateien umgewandelt werden. Dafür die Datei öffnen, 
das zweite Tabellenblatt (Quelldaten) öffnen und als csv-Datei speichern (Komma als Feldtrenner, Anführungszeichen 
als Texttrenner)

### Skriptmagie

Das Skript `analyze.py` im Ordner `fakupdate` wird mit den beiden csv-Dateien sowie der aktuellen 
Fachschaftenliste im Markdown-Format als Parameter aufgerufen. 

```
./analyze.py faelle.csv personen.csv fachschaftenliste.md
```

Es erzeugt daraufhin 5 neue Dateien im selben Ordner:

- `FAKDIFF.txt`, enthält alle zu entfernenden und hinzuzufügenden FAKs mit den Kommentaren "NEW" und "REMOVED"
- `FAKLISTE.txt`, enthält alle existierenden FAKs aus den csv-Dateien
- `FAKNEW.txt`, enthält alle neuen FAKs aus den csv-Dateien
- `FAKREMOVED.txt` enthält alle zu entfernenden FAKs aus den csv-Dateien
- `FS-Removed.md` enthält für jede betroffene Fachschaft die zu entfernenden FAKs

Neu hinzugekommene FAKs müssen manuell zugeordnet werden. Anhaltspunkt hierfür kann die zugehörige Fakultät 
sein, diese kann in den Excel-Dateien nachgeschlagen werden. Zu entfernende FAKs sollten nur entfernt werden, 
wenn wirklich sicher ist, dass sie nicht mehr benötigt werden.
