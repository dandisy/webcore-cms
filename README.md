## Ready to Use Webcore as Website CMS

This is Webcore Sample already relayout pages and data sources form for better user experience, 

using https://github.com/dandisy/webcore-presentation


### Installation

Copy and paste in terminal line by line, just hit Enter key

* Using Git

        git clone https://github.com/dandisy/webcore-cms.git

        cd webcore-cms

        composer install

        cp .env.example .env

Make sure your server, create "webcore-cms" database, edit .env using your favorite editor, 
for example using nano editor copy and paste this in terminal, and hit Enter key

    sudo nano .env

import "webcore-cms.sql file included to your database

then

    php artisan key:generate

Now you can browse to

    http://localhost/webcore-cms/public
    or
    http://localhost/webcore-cms/public/admin

Default users are

    - superadminstrator@app.com
    - administrator@app.com
    - user@app.com

    with default password is password

### Screenshots

* Sample front page

![sample front page](https://github.com/dandisy/webcore-screenshots/blob/master/sample%20front%20page.png)

* Login page

![login page](https://github.com/dandisy/webcore-screenshots/blob/master/login%20page.png)

* Admin page

![Webcore Admin Dashboard](https://github.com/dandisy/webcore-screenshots/blob/master/webcore-admin-dashboard.jpg)

![Webcore Page Presentation](https://github.com/dandisy/webcore-screenshots/blob/master/webcore-admin-page-presentation.jpg)

![Webcore Datasource Elogui](https://github.com/dandisy/webcore-screenshots/blob/master/webcore-admin-datasource-elogui.jpg)

![admin page 2](https://github.com/dandisy/webcore-screenshots/blob/master/admin%20page%202.png)

![admin page 3](https://github.com/dandisy/webcore-screenshots/blob/master/admin%20page%203.png)

![admin page 4](https://github.com/dandisy/webcore-screenshots/blob/master/admin%20page%204.png)


#
by dandi@redbuzz.co.id
