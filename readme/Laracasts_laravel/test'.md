```php
    public function register(Request $request)
    {
        $validator = $request->validate([
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:10'
        ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'messages' => $validator->messages()
        //     ], 200);
        // }

        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'Successfully registered', 'data' => $user], 200);
    }
```

https://mingeun.com/2018-08-07/laravel-jwt/

https://dev-yakuza.github.io/ko/laravel/jwt-signup/

https://jwt-auth.readthedocs.io/en/develop/quick-start/#update-your-user-model

https://medium.com/@hdcompany123/laravel-5-7-and-json-web-tokens-tymon-jwt-auth-d5af05c0659a

https://dev.to/ndiecodes/build-a-jwt-authenticated-api-with-lumen-2afm



```php
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            // if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }
        return $this->respondWithToken($token);
    }
```

