��          �   %   �      `  1   a  2   �  /   �     �          +     F     a     |  (   �     �  4   �  K     c   N     �  "   �  .   �  E     &   e  +   �     �     �     �     �     �     �  z    D   }  D   �  8        @     ^     x     �     �     �     �     �  6   	  ^   ;	  p   �	     
  $   $
  ,   I
  H   v
  *   �
  6   �
     !     @     X     j     }     �                     	                                                                                  
                     
Compare file sync methods using one %dkB write:
 
Compare file sync methods using two %dkB writes:
 
Compare open_sync with different write sizes:
 
Non-sync'ed %dkB writes:
  1 * 16kB open_sync write  2 *  8kB open_sync writes  4 *  4kB open_sync writes  8 *  2kB open_sync writes %13.3f ops/sec  %6.0f usecs/op
 %d second per test
 %d seconds per test
 %s: %s
 %s: too many command-line arguments (first is "%s")
 (in wal_sync_method preference order, except fdatasync is Linux's default)
 * This file system and its mount options do not support direct
  I/O, e.g. ext4 in journaled mode.
 16 *  1kB open_sync writes Could not create thread for alarm
 Direct I/O is not supported on this platform.
 O_DIRECT supported on this platform for open_datasync and open_sync.
 Try "%s --help" for more information.
 Usage: %s [-f FILENAME] [-s SECS-PER-TEST]
 could not open output file fsync failed n/a n/a* seek failed write failed Project-Id-Version: pg_test_fsync (PostgreSQL) 10
Report-Msgid-Bugs-To: pgsql-bugs@postgresql.org
POT-Creation-Date: 2017-12-15 02:46+0000
PO-Revision-Date: 2017-12-24 21:27+0300
Language: tr
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=1; plural=0;
Last-Translator: 
Language-Team: 
X-Generator: Poedit 2.0.4
 
Dosya sync yöntemlerini bir %dkB yazma kullanarak karşılaştır
 
Dosya sync yöntemlerini iki %dkB yazma kullanarak karşılaştır
 
open_sync ile farklı yazma boyutlarını kıyaslayın
 
sync edilmemiş %dkB yazma:
  1 * 16kB open_sync yazma  2 * 8kB open_sync yazma  4 * 4kB open_sync yazma  8 * 2kB open_sync yazma %13.3f ops/sec  %6.0f usecs/op
 test başına %d saniye
 %s: %s
 %s: Çok fazla komut satırı girdisi var (ilki "%s")
 (wal_sync_method tercih sırasında,  fdatadync'in Linux'un varsayılanı olması dışında)
 * Bu dosya sistemi ve bağlama (mount) seçenekleri doğrudan I/O
 desteklemiyor, örn: günlüklü modda ext4.
 16 * 1kB open_sync yazma Alarm için thread oluşturulamadı
 Doğrudan I/O bu platformda desteklenmiyor.
 Bu  platformda open_datasync ve open_sync için O_DIRECT destekleniyor.
 Daha fazla bilgi için "%s --help" yazın
 Kullanımı: %s [-f DOSYAADI] [-s TEST-BASINA-SANIYE]
 çıktı dosyası açılamadı fsync başarısız oldu n/a (uygulanamaz) n/a* (uygulanamaz) arama başarıız oldu yazma başarısız oldu 