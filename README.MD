migration
seeeder
faker
controller
middleware
localiztion
authentication

0. composer install 3x
0. a. php artisan key:generate
0. b. npm install trus npm run dev (npm run dev harus terus terusan)
0. c. php artisan serve
1. bikin model
2. bikin migrations
3. php artisan migrate
3.a. cara rollback: php artisan migrate:rollback abis tu migrate lagi
4. composer require laravel/ui (buat scaffolding auth)
4.a.ganti register & / login sama inputnya yg diminta
4.b. return view auth.login di web.php ngeganti login doang
5. buat viewnya (notif buat payment) payment.blade
6. bikin routing post trus actionnya yg [] ke controller misal paymentControlle::class
7. php artisan make:controller paymentController
8. bikin random number generator
9. bikin register & login
10. pake ini php artisan ui bootstrap --auth
11. di model setting guarded jadi apapun yg gamau diisi, set fillable delet aja/ yg mo diisi
12. ganti validator dan user create pake yg divalidasi
13. klo login mo ganti ke longincontroller trus ctrl+click authencateuser
14. di web.php tambahin middleware auth
15. di home control get list of users trus kirim ke view home
16. bikin pagination users
17. Di view buat profile card
18. di view home panggil foreach users as user dengan input user
19. buat faker sama seeder
20. buat fungsi generate dari picsum.photos/200 trus save hasilnya ke link databse
21. buat seeder dengan php artisan make:seeder UserSeeder
22. ganti di DatabaseSeeder apapun itu fungsirandom dengan  $this->call(UserSeeder::class); (fungsinya hapus)
23. php artisan db:seed

24. make localization
25. php artisan lang:publish
26. klo mau nambah language, copy folder en rename id
27. tambahin di lang en di misal pagination
28. tambahin di home <p>{{__('pagination.test') }}</p>
29. routing ditambah Route::get('/locale/{lang}',[LocaleController::class,'setLocale']);
30. jalanin command php artisan make:Controller LocaleController
31. bikin function setLocale
32. bikin middleware php artisan make:Middleware LocaleMiddleware
33. di bootstrap app.php tambahin middleware $middleware->web(append:['web', \App\Http\Middleware\LocaleMiddleware::class]); di bagian withMiddleware
