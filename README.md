# Telepítés dokumentáció

## Backend 
- cd Backend (be kell lépni a backend mappájába).
- Composer install: Evvel létrejön a vendor mappa, amely szükséges a projekt elindításához és működéséhez.
- Ha nincs elindítva, akkor el kell indítani a XAMPP-ot, hogy a következő lépések sikeren letudjanak futni, illetve élővé váljon a lokális szerverünk.
- php artisan migrate: Létrejött az adatbázis, illetve a táblázatok és azok oszlopai.
- php artisan db:seed: A seederek tartalmát az adott táblákba betölti, innentől kezdve lesz adat az adatbázisban, amivel lehet dolgozni.
- php artisan serve: Elindul a server, innentől kezdve már nem kell vele foglalkozni, következhet a frontend elindítása.

## Frontend
cd Frontend (be kell lépni a frontend mappájába).
- npm i: Létrehozza az npm mappát, amely szükséges a frontend helyes működéséhez.
- npm run dev : Elindítja a tényleges oldalt, ha ctrl+ bal clickkel rákattint a http://localhost:3000 vagy ezt bírja a böngésző url sávjába, és látni fogja az oldalt.
