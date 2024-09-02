#! /bin/bash

git pull origin version/2024

nvm install 16.15.1
npm run prod

rm ../public_html/js/app.js
rm ../public_html/js/activities.js
rm ../public_html/js/registration.js
rm ../public_html/js/payment.js
rm ../public_html/js/attendance.js
rm ../public_html/js/booking.js

mv public/js/app.js ../public_html/js
mv public/js/attendance.js ../public_html/js
mv public/js/registration.js ../public_html/js
mv public/js/payment.js ../public_html/js
mv public/js/activities.js ../public_html/js
mv public/js/booking.js ../public_html/js

php artisan config:clear

php artisan cache:clear

php artisan config:cache
