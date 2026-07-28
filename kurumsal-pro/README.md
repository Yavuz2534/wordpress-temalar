# Kurumsal Pro — WordPress Teması

Avukat, mali müşavir, danışmanlık ve ajanslar için profesyonel, güven odaklı tek sayfa tema. Derleme gerektirmez.

## Bölümler
Hero + kart · istatistik şeridi · hizmetler · süreç (4 adım) · ekip · teklif CTA · iletişim + harita · footer · mobil arama çubuğu.

## Kurulum
1. `kurumsal-pro` klasörünü zip'le (style.css kökte olmalı).
2. WordPress → Görünüm → Temalar → Yeni ekle → Tema yükle → zip → Etkinleştir.
3. Ayarlar → Okuma → Ana sayfa: Statik bir sayfa seç.

## İçerik düzenleme
- **Görünüm → Özelleştir → 1) Firma Bilgileri / 2) Üst Bölüm** → ad, telefon, WhatsApp, e-posta, adres, hero ve CTA yazıları.
- Hizmetler, istatistik, süreç, ekip: `functions.php` içindeki `kp_services()`, `kp_stats()`, `kp_steps()`, `kp_team()` dizileri.
