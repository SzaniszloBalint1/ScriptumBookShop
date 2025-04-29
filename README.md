# Telepítés dokumentáció

## Készítők
- Görtler Zsolt
- Szaniszló Bálint

## Tesztelő belépés a weboldalon
- Email: vizsgaremek13@outlook.hu
- Jelszó: vizsga123
### Tesztelő belépése az outlook fiókba
- Email:vizsgaremek13@outlook.hu
- Jelszó: vizsga123 vagy Vizsga123
  
## Projekt felépítése
- `Backend/` - A szerveroldali alkalmazás (Laravel alapú).
- `Frontend/` - A kliensoldali alkalmazás (Vue alapú).
- `bookshop.sql` - Az adatbázis dump fájl (MySQL).
- `Dokumentumok/` - Tartalmazza az alkalmazás dokumentációját docx és pdf formátumban

## Telepítési útmutató

### Backend

1. `cd Backend`
2. `composer install`
3. XAMPP indítása (Apache és MySQL).
4. `php artisan migrate`
5. `php artisan db:seed`
6. `php artisan serve`

### Frontend

1. `cd Frontend`
2. `npm install`
3. `npm run dev`
4. A projekt a http://localhost:3000 címen érhető el.
