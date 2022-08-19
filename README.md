
# ichari Shops

**ichari Shops** is a stand-alone offshoot of the larger (to-be-released) **ichari**'s bundled "shops" module. Ideally, the database used by an **ichari Shops** installation will be able to be imported into a full **ichari** installation later, but I cannot guarantee that. To that point, I consider this a "beta", although it is fully functioning.

## Setup

### Prerequisites
1. PHP 7.4+
2. MySQL
3. Composer
4. node.js
5. Apache 2 (You can use Nginx, but I don't know Nginx, so my instructions will be for Apache)

### Installation
1. Clone repository
2. Setup your webserver
	- Set `/public` as document root
	- Set `AllowOverrides All`
	-  `chown www-data` (or whatever your web server's user is) the entire application directory
	- You may need to do other permission stuff depending on your server
3. Create a database and user
4. Copy `.env.example` to `.env`
5. In `.env` edit all applicable fields above the dashed line
	- When creating your Discord application, add "https://[yourdomainhere]/auth/callback" as a redirect URI (or "http://", whichever you've set as the `APP_URL`).
6. Run the following:
	i. `composer install`
	ii. `npm install`
	iii. `npm run prod`
	iv. `php artisan key:generate`
	v. `php artisan migrate`
7. Add your first shop area with `php artisan area:add` (e.g. `php artisan area:add "Shopping District"`)
	- You can remove areas with `php artisan area:remove "[target area]"`
	- If the area contains a space, be sure to wrap it in quotes.
8. Add the [ichari bot](https://discord.com/api/oauth2/authorize?client_id=937975934726848533&permissions=0&scope=bot) to your server.
	- The bot is used to determine if users are in your Discord server and if they have the required roles to access your ichari installation.
9. Log into your site. The first person to log in will automatically be made a site admin.

## Usage
For a tutorial on how to use the application, I'll have a video linked here as soon as I have another day off work.

## Server Plugin
**ichari Shops** has a companion Spigot plugin available here. Be sure to set `SPIGOT_PLUGIN_KEY` in your `.env` file. Instructions on how to use the plugin are available on the page linked above.

## To-Do
It should probably be reformatted for readability, but "If it ain't broke..."
If you feel the urge to fix my inconsistent indentations and tailwind class ordering, feel free to submit a PR.

## Contributing

As far as I'm concerned, this project is complete. As of now, it will not be receiving any further features. This may change later, but my focus will be shifting to the parent project for the foreseeable future. If you wish to submit a PR for a bug fix or security patch, please do. If you wish to extend functionality, hold on to that thought until the full **ichari** release.