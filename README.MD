## migration
## seeeder
## faker
## controller
## middleware
## localiztion
## authentication

0. composer install 3x
0. php artisan key:generate
0. npm install trus npm run dev (npm run dev harus terus terusan)
0. php artisan serve
0. composer dump-autoload buat refresh autoload
0. buat refresh seeder refresh seeder: php artisan migrate:refresh --seed

# model & migrate
1. bikin model
2. bikin migrations
3. php artisan migrate
4. cara rollback: php artisan migrate:rollback abis tu migrate lagi

# foreign key hobbies
1. php artisan make:migration create_hobbies_table --create=hobbies
2. ganti migrations yg dibuat dengan hobbies
3. migrate
4. buat model php artisan make:model Hobby
5. ganti hobby owned by user
6. ganti model user buat punya hasmany relation ke hobby
7. ubah seeder jadi ada hobby
8. ganti di register controller buat validator create jadi ada hobi
10. reseed

# laravel ui
1. composer require laravel/ui (buat scaffolding auth)
2. ganti register & / login sama inputnya yg diminta
3. return view auth.login di web.php ngeganti login doang
4. buat viewnya (notif buat payment) payment.blade
5. bikin routing post trus actionnya yg [] ke controller misal paymentControlle::class
6. php artisan make:controller paymentController
7. bikin random number generator
8. bikin register & login
9. pake ini php artisan ui bootstrap --auth
10. di model setting guarded jadi apapun yg gamau diisi, set fillable delet aja/ yg mo diisi
11. ganti validator dan user create pake yg divalidasi
12. klo login mo ganti ke longincontroller trus ctrl+click authencateuser
13. di web.php tambahin middleware auth
14. di home control get list of users trus kirim ke view home
15. bikin pagination users
16. Di view buat profile card
17. di view home panggil foreach users as user dengan input user
18. buat halaman profile masing masing

# faker & seeder
1. buat faker sama seeder
2. buat fungsi generate dari picsum.photos/200 trus save hasilnya ke link databse
3. buat seeder dengan php artisan make:seeder UserSeeder
4. ganti di DatabaseSeeder apapun itu fungsirandom dengan  $this->call(UserSeeder::class); (fungsinya hapus)
5. php artisan db:seed
6. refresh seeder: php artisan migrate:refresh --seed

# localization
1. make localization
2. php artisan lang:publish
3. klo mau nambah language, copy folder en rename id
4. tambahin di lang en di misal pagination
5. tambahin di home < p>{{__('paginati.test') }}</ p>
6. routing ditambah Route::get('/locale/{lang}',[ LocaleController::class,'setLocale']);
7. jalanin command php artisan make:Controller LocaleController
8. bikin function setLocale 
9. bikin middleware php artisan make:Middleware LocaleMiddleware
10. di bootstrap app.php tambahin middleware $middleware->web(append:['web', \App\Http\Middleware\LocaleMiddleware::class]); di bagian withMiddleware

# friends
1. buat table friends php artisan make:migration create_friends_table
2. ganti isi migration friends tablenya
3. tambahin ke user model belongs to many relation
4. bikin controller php artisan make:controller FriendController
