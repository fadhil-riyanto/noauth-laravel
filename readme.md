## NoAuth Laravel

is a non-database authentication that keeps authentication as small as possible. good for single-user APP

## Setup


create your password list inside .env with comma-separated string

```env
NOAUTH_PASSWORD="abc123,foobar123,otherxyz"
```

first, use the namespace

```php
use FadhilRiyanto\NoAuthLaravel\NoAuth;
```

defining routes for guest which try access route with `NoAuthMiddleware` class, the route must be named as 'noauth-guest', example

```php
// guest will redireced here
Route::get('login', function() {
        return view('admin/login');
})->name("noauth-guest");
```

define admin route with middleware, example

```php
// protect admin page using middleware NoAuthMiddleware
Route::get('home', [Controllers\AdminController::class, 'handle_admin_homepage'])
                ->middleware(NoAuthMiddleware::class);
```

authentication example, `NoAuth::attemp` is automatically create a session if successful and return false otherwise

```php
class AdminController extends Controller
{
        public function handle_admin_login_ajax(Request $request)
        {
                $validator = Validator::make($request->all(), [
                        'password' => 'required',
                ]);

                $validated = $validator->validated();

                if (NoAuth::attemp($request)) {
                        return response()->json(["message" => "Welcome"], 200);
                } else {
                        return response()->json(["message" => "The provided credentials do not match our records"], 400);
                }
        }
}

```

### Maintainer: 
[Fadhil-Riyanto](https://github.com/fadhil-riyanto)
## License
GPL-2.0