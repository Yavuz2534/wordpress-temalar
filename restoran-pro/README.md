# Restoran Pro — WordPress Teması

Restoran, kafe ve lokantalar için sıcak, iştah açıcı, rezervasyon odaklı tek sayfa tema. Derleme gerektirmez.

## Bölümler
Hero · tanıtım şeridi · hakkımızda · neden biz · menü (fiyatlı) · rezervasyon CTA · çalışma saatleri + harita · footer · mobil rezervasyon çubuğu.

## Kurulum
1. `restoran-pro` klasörünü zip'le (style.css kökte olmalı).
2. WordPress → Görünüm → Temalar → Yeni ekle → Tema yükle → zip → Etkinleştir.
3. Ayarlar → Okuma → Ana sayfa: Statik bir sayfa seç.

## İçerik düzenleme
- **Görünüm → Özelleştir → 1) İşletme Bilgileri / 2) Üst Bölüm** → ad, telefon, WhatsApp, adres, hero ve çağrı yazıları.
- Menü, özellikler, saatler: `functions.php` içindeki `rp_menu()`, `rp_features()`, `rp_hours()` dizileri.
