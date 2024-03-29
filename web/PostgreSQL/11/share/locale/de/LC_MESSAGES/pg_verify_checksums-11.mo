��            )         �  X   �  
   
       3   1  ?   e  H   �  1   �  (      >   I  f   �  $   �  2     &   G  !   n  8   �  !   �  .   �  ;     0   V      �  &   �  4   �               ,     E     `  ,   t  &   �     �  �  �  Y   ^	     �	  $   �	  <   �	  F   &
  J   m
  +   �
  .   �
  K     {   _  ,   �  D     0   M  *   ~  C   �  ;   �  9   )  ;   c  4   �  $   �  &   �  <         ]     z  '   �     �     �  5   �  8   2     k                                             
                            	                                                               
If no data directory (DATADIR) is specified, the environment variable PGDATA
is used.

 
Options:
   %s [OPTION]... [DATADIR]
   -?, --help             show this help, then exit
   -V, --version          output version information, then exit
   -r RELFILENODE         check only relation with specified relfilenode
   -v, --verbose          output verbose messages
  [-D, --pgdata=]DATADIR  data directory
 %s verifies data checksums in a PostgreSQL database cluster.

 %s: checksum verification failed in file "%s", block %u: calculated checksum %X but block contains %X
 %s: checksums verified in file "%s"
 %s: cluster must be shut down to verify checksums
 %s: could not open directory "%s": %s
 %s: could not open file "%s": %s
 %s: could not read block %u in file "%s": read %d of %d
 %s: could not stat file "%s": %s
 %s: data checksums are not enabled in cluster
 %s: invalid relfilenode specification, must be numeric: %s
 %s: invalid segment number %d in file name "%s"
 %s: no data directory specified
 %s: pg_control CRC value is incorrect
 %s: too many command-line arguments (first is "%s")
 Bad checksums:  %s
 Blocks scanned: %s
 Checksum scan completed
 Data checksum version: %d
 Files scanned:  %s
 Report bugs to <pgsql-bugs@postgresql.org>.
 Try "%s --help" for more information.
 Usage:
 Project-Id-Version: pg_verify_checksums (PostgreSQL) 11
Report-Msgid-Bugs-To: pgsql-bugs@postgresql.org
POT-Creation-Date: 2018-09-14 05:17+0000
PO-Revision-Date: 2018-09-14 08:21+0200
Last-Translator: Peter Eisentraut <peter_e@gmx.net>
Language-Team: German <pgsql-translators@postgresql.org>
Language: de
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
 
Wenn kein Datenverzeichnis angegeben ist, wird die Umgebungsvariable
PGDATA verwendet.

 
Optionen:
   %s [OPTION]... [DATENVERZEICHNIS]
   -?, --help             diese Hilfe anzeigen, dann beenden
   -V, --version          Versionsinformationen anzeigen, dann beenden
   -r RELFILENODE         nur Relation mit angegebenem Relfilenode prüfen
   -v, --verbose          »Verbose«-Modus
  [-D, --pgdata=]VERZ     Datenbankverzeichnis
 %s überprüft die Datenprüfsummen in einem PostgreSQL-Datenbankcluster.

 %s: Prüfsummenprüfung fehlgeschlagen in Datei »%s«, Block %u: berechnete Prüfsumme ist %X, aber der Block enthält %X
 %s: Prüfsummen überprüft in Datei »%s«
 %s: Cluster muss für die Prüfsummenprüfung heruntergefahren sein
 %s: konnte Verzeichnis »%s« nicht öffnen: %s
 %s: konnte Datei »%s« nicht öffnen: %s
 %s: konnte Block %u in Datei »%s« nicht lesen: %d von %d gelesen
 %s: konnte »stat« für Datei »%s« nicht ausführen: %s
 %s: Datenprüfsummen sind im Cluster nicht eingeschaltet
 %s: ungültige Relfilenode-Angabe, muss numerisch sein: %s
 %s: ungültige Segmentnummer %d in Dateiname »%s«
 %s: kein Datenverzeichnis angegeben
 %s: CRC-Wert in pg_control ist falsch
 %s: zu viele Kommandozeilenargumente (das erste ist »%s«)
 Falsche Prüfsummen:     %s
 Überprüfte Blöcke:      %s
 Prüfsummenüberprüfung abgeschlossen
 Datenprüfsummenversion: %d
 Überprüfte Dateien:     %s
 Berichten Sie Fehler an <pgsql-bugs@postgresql.org>.
 Versuchen Sie »%s --help« für weitere Informationen.
 Aufruf:
 