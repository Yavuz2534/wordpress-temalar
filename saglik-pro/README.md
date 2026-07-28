# Saglik Pro — WordPress Teması

Doktor, diş kliniği, estetik ve fizyoterapi merkezleri için temiz, güven veren, randevu odaklı tek sayfa tema. Derleme gerektirmez.

## Bölümler
Hero + hızlı randevu kartı · istatistik şeridi · hizmetler · doktorlar · süreç (4 adım) · randevu CTA · S.S.S. · iletişim + harita · footer · mobil randevu çubuğu.

## Kurulum
1. `saglik-pro` klasörünü zip'le (style.css kökte olmalı).
2. WordPress → Görünüm → Temalar → Yeni ekle → Tema yükle → zip → Etkinleştir.
3. Ayarlar → Okuma → Ana sayfa: Statik bir sayfa seç.

## İçerik düzenleme
- **Görünüm → Özelleştir → 1) Klinik Bilgileri / 2) Üst Bölüm** → ad, telefon, WhatsApp, e-posta, adres, saatler, hero ve CTA yazıları.
- Hizmetler, doktorlar, süreç, SSS: `functions.php` içindeki `sp_services()`, `sp_docs()`, `sp_steps()`, `sp_faq()` dizileri.
