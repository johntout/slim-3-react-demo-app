# demo-app
A Slim 3 Micro framework demo app. Monsters module uses React to make api calls and render the results.

## Requirements
<ul>
<li>PHP >= 7</li>
<li>MariaDB or MySQL</li>
</ul>

## How to start
Step 1: Go to your desired directory: `cd projects`

Step 2: Clone the repository: `git clone https://github.com/johntout/slim-3-react-demo-app.git && cd slim-3-react-demo-app`

Step 3: Install dependencies: `composer install`

Step 4: Import `demo_app.sql` file to create the tables for your database.

Step 5: Make a copy of `.env.example`, rename it to `.env` and fill in database information. The app consumes its own API so APP_URL variable is necessary in order for the api calls to work. 

Step 6: Login with the following credentials.
Email: admin@test.com
Password: 12345

## API
If you want to test API follow the instructions below.

Step 1: Request Token<br />

Example Request: `curl -d "client_id=client_id&client_secret=client_secret&grant_type=client_credentials" -X POST http://app.test/oauth/token` <br /><br />
Example Response: `{"access_token":"token","expires_in":2592000,"token_type":"Bearer","scope":null}`


Step 2: Api call to endpoint `/api/monsters` to bring all records or `/api/monsters/{level}` if you want to fetch results for specific level. <br />

Example Request: `curl -H "Accept: application/json" -H "Authorization: Bearer {token}" http://app.test/api/monsters/5` <br /><br />
Example Response: `[{"id":2,"name":"Dragon Level 5","type":"dragon","level":5,"hp":2790,"matk":62,"patk":56,"mdef":32,"pdef":44,"gold":71},{"id":5,"name":"Dragon 2 Level 5","type":"dragon","level":5,"hp":2610,"matk":63,"patk":55,"mdef":30,"pdef":45,"gold":71}]`