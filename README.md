# Image Toolkit

Tek dosyalık, tamamen tarayıcıda çalışan görsel işleme aracı. JPEG, PNG ve WebP dosyalarını
yeniden boyutlandırır, kırpar, sıkıştırır ve birbirine dönüştürür. Hiçbir dosya sunucuya
gönderilmez.

- Dosya: `imgtoolkit.php` (tek dosya, ~71 KB)
- Çalıştığı yer: tarayıcı (istemci tarafı)
- Sunucu tarafı kod: yok (dosyada çalışan PHP etiketi bulunmaz)

## Amaç

Hızlı bir görsel hazırlama aracı: bir veya birden çok görseli seçip hedef biçim, boyut,
kalite ve kırpma ayarlarıyla yeniden kodlamak; sonucu tek tek veya toplu indirmek.
Kurulum, hesap, yükleme veya bulut servisi gerekmez.

## Özellikler

- JPEG, PNG ve WebP kaynak dosyaları; imza (magic bytes) ile doğrulama.
- Hedef biçim seçimi (`image/jpeg`, `image/png`, `image/webp`) ve otomatik hedef önerisi.
- Genişlik/yükseklik ile yeniden boyutlandırma; en-boy oranını koruma seçeneği.
- Piksel koordinatlarıyla kırpma (X, Y, genişlik, yükseklik).
- JPEG/WebP kalite ayarı ve gerçek zamanlı kalite ipucu.
- Tek tek önizleme, tek tek indirme ve "Tümünü indir".
- Liste temizleme ve dosya bazında durum/Hata mesajı.
- Açık/koyu tema; tercih `localStorage` yerine yalnızca sayfa oturumunda tutulur.

## Ekran görüntüsü

Bu depoda ekran görüntüsü **yoktur**; uydurma görsel eklenmemiştir. Kendi görüntünüzü
üretmek için aracı bir tarayıcıda açın ve 1440 px ile 390 px genişlikte ekran görüntüsü
alın. Depoya eklerken hangi tarayıcı/sürüm ve görünüm genişliğiyle alındığını yazın.

## Gereksinimler

- Güncel Chrome, Edge, Firefox veya Safari.
- `Canvas`, `Blob`, `File`, `createImageBitmap` ve `URL.createObjectURL` desteği.
  `createImageBitmap` başarısız olursa `<img>` yedeği kullanılır.
- JavaScript açık olmalıdır. Kapalıyken sayfa bunu bildirir ve işlem yapılamaz.
- İnternet bağlantısı gerekmez: CDN, harici font, uzak kütüphane veya `@import` yoktur.

## Çalıştırma

Herhangi bir statik sunucu yeterlidir; PHP gerekmez:

```powershell
# Bu klasörün içinde
python -m http.server 8000
# veya
php -S 127.0.0.1:8000
```

Ardından `http://127.0.0.1:8000/imgtoolkit.php` adresini açın. Dosyayı doğrudan çift
tıklayarak `file://` üzerinden de açabilirsiniz; tarayıcı `File`/`Canvas` API'leri için
ek izin istemez.

## Kullanım

1. "Dosya seç" ile bir veya birden çok görsel ekleyin (sürükle-bırak da desteklenir).
2. Hedef biçimi seçin; aynı biçim hedeflenirse araç uygun bir alternatif önerir.
3. Gerekirse genişlik/yükseklik, kırpma ve kalite alanlarını doldurun.
4. "Dönüştür" ile listeyi işleyin; her satırda sonuç boyutu ve indirme bağlantısı görünür.
5. "Tümünü indir" tek tek indirme bağlantılarını sırayla açar.

Sayfa yenilendiğinde seçili dosyalar ve üretilen blob adresleri kaybolur.

## Teknik ayrıntılar

- Tüm işlemler `Canvas` (`drawImage`, `toBlob`) ile yapılır; harici kod yoktur.
- Dosya türü uzantıya göre değil, ilk baytlardaki imzaya göre belirlenir:
  PNG `89 50 4E 47`, JPEG `FF D8 FF`, WebP `RIFF....WEBP`.
- Animasyonlu PNG (APNG `acTL`/`fcTL`) ve animasyonlu WebP (`ANIM`/`ANMF`) reddedilir;
  sessizce tek kareye indirgenmez.
- Yeniden kodlama EXIF/GPS/ICC metadata'sını kaldırır. Bu davranış arayüzde yazılıdır.
- Kırpma ve boyut hesapları saf fonksiyonlardadır (`validateCrop`, `computeDimensions`)
  ve arayüzden bağımsız olarak test edilebilir.
- Tema yalnızca `data-theme` özniteliği ve CSS değişkenleriyle değişir; harici tema
  betiği yoktur.

## Sınırlar ve güvenlik

| Sınır | Değer |
| --- | --- |
| Dosya başına boyut | 20 MB |
| Tek seferde dosya | 12 |
| Kaynak/çıktı kenarı | 8192 px |
| Toplam çıktı pikseli | 24 MP |

- Sınır aşılırsa işlem yapılmaz ve neden bildirilir.
- Ağ isteği yoktur: `fetch`, `XMLHttpRequest`, `WebSocket` veya form gönderimi kullanılmaz.
- Kullanıcı verisi DOM'a `textContent` ile yazılır; `innerHTML` kullanılmaz.
- Üretilen dosyalar yalnızca `Blob` adresleriyle, sayfa ömrü boyunca yaşar.
- Büyük görsellerde tarayıcı belleği sınırlayıcı olabilir; araç bunu piksel sınırıyla
  engellemeye çalışır ama tarayıcı başına bellek davranışı farklıdır.

## Lisans

- Bu proje için **henüz bir lisans seçilmemiştir**; bu depoda `LICENSE` dosyası yoktur.
  Yayına almadan önce sahibinin bir lisans seçip eklemesi gerekir (ör. MIT, Apache-2.0).
  Bu README bir lisans vaadi değildir.
- Üçüncü taraf kod, kütüphane, font veya görsel yoktur. Dosya kendi CSS/JS'ini taşır.

## Test edilenler

2026-10-28, Edge/Chromium 156 (headless) ve PHP 8.3.36 ile:

- Dosya tek başına, portfolyo dizini dışındaki geçici bir klasörden servis edildi:
  `HTTP 200`, tek `<h1>`, harici `<script src>`/`<link>`/`<img src>` yok.
- Konsol hatası ve yakalanmamış istisna yok.
- İmza algılama: PNG/JPEG/WebP doğru, bilinmeyen baytlar reddedildi.
- APNG animasyon algılama doğru sonuç verdi.
- `computeDimensions` en-boy oranını korudu; kırpma doğrulaması sınır dışı değerleri reddetti.
- `extensionMatches` uyumlu/uyumsuz uzantıları doğru ayırdı.
- Gerçek akış: Canvas ile üretilen 64×48 PNG yüklendi, `image/webp` hedefiyle dönüştürüldü,
  listede `test.webp` indirme bağlantısı oluştu.
- 1440 px ve 390 px genişlikte yatay taşma yok.

## Test edilmeyenler ve bilinen sınırlar

- Firefox ve Safari'de gerçek tarayıcı testi yapılmadı; yalnızca Edge/Chromium kullanıldı.
- Gerçek mobil cihaz ve ekran okuyucu testi yapılmadı.
- Çok büyük (yaklaşık 20 MB / 24 MP) dosyalarda bellek davranışı ölçülmedi.
- AVIF, HEIC, TIFF ve GIF kaynak olarak **desteklenmez**; bu biçimler reddedilir.
- Renk profili dönüşümü yapılmaz; yeniden kodlama ICC profilini kaldırır.
- `file://` üzerinden bazı tarayıcılar `createImageBitmap` davranışını kısıtlayabilir.

## Ayrı GitHub deposu olarak yayınlama

1. Bu klasörü yeni depoya kopyalayın (`imgtoolkit.php`, `README.md`).
2. Tarayıcı aracı olduğu için GitHub Pages uygundur. Pages bilinmeyen uzantıları
   indirme olarak sunabildiğinden dosyayı **`index.html`** olarak yeniden adlandırın;
   içerik değişmez, işlevsellik etkilenmez.
3. Ayarlar → Pages → "Deploy from a branch" ile `main` / `root` seçin.
4. Yayın sonrası gerçek bir görselle dönüştürme, indirme ve mobil görünümü doğrulayın.
5. Depoya lisans seçtikten sonra `LICENSE` ekleyin; ekran görüntüsünü gerçek tarayıcıdan alın.
