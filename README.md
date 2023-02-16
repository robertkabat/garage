**GENERAL INFO:**

Each and every component, controller and any other custom piece of code is designed and written by me, and only me. Some of the components 
I borrowed from my other private, pet projects, nevertheless, all of them are created within last ~14 days and are created in 100% by me. That just a few things anyway.

Of course, you are more than welcome to ask me about every single line of code I've created. But I do have to warn you - I talk a lot. You've been warned.

**ASSUMPTIONS:**

Project assumes the following:

* only garage owner has access to the restricted area of the website
* no accounts for customers
* no account required to make a booking
* hardcoded credentials for simplicity

**FEATURES:**

- BOOKING SYSTEM
- VALIDATION
- AUTH SYSTEM
- ROUTING ON VUE
- BOOKINGS MANAGEMENT
- BLOCKING SLOTS AND DAYS
- EMAILS
- PROBABLY MORE BUT I JUST DON'T REMEMBER

**THINGS USED IN THE PROJECT THAT ARE WORTH MENTIONING:**

* LARAVEL 10
* VUE3
* VUE-ROUTER
* TAILWIND
* SANCTUM
* FORTIFY
* PINIA

**SETUP:**

1. Clone the project from github.
2. Get sail up and running - `./vendor/bin/sail up -d` in the root directory
3. `composer install` and `npm install` in the root directory
4. Use provided `.env` file
5. Update `.env` with your own mailtrap credentials
6. Run database migrations `/vendor/bin/sail artisan migrate:fresh --seed`

Feel free to set up a call with me or fire over some questions if there are any issues with that.
You should be able to access it now via `http://www.garage.test/`.

**AVAILABLE ROUTES:**

* http://www.garage.test/login
* http://www.garage.test/bookings
* http://www.garage.test/account/dashboard


