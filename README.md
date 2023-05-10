<h1>Laravel 8 with MongoDB </h1>
<h2>Prerequisites</h2>
<p>Before getting started, make sure you have the following requirements installed on your system:</p>
<ol>
<li>PHP 8</li>
<li>Laravel 8</li>
<li>MongoDB 4.2</li>
</ol>
<h2>Installation</h2>
<p>Follow these steps to get the project up and running on your local machine:</p>
<ol>
<ol>
<li>Clone the repository to your local machine:</li>
</ol>
</ol>
<pre><code>git clone https://github.com/bimprakosoo/test-inosoft.git</code></pre>
<ol>
<ol>
<li>Navigate to the project directory:</li>
</ol>
</ol>
<pre><code>cd your-repository</code></pre>
<ol>
<ol>
<li>Install the project dependencies using Composer:</li>
</ol>
</ol>
<pre><code>composer install</code></pre>
<ol>
<ol>
<li>Install MongoDB on your system. Refer to the official MongoDB documentation for installation instructions specific to your operating system: <a href="https://docs.mongodb.com/manual/installation/">MongoDB Installation</a></li>
<li>Set up your database configuration by creating a <code>.env</code> file. You can use the <code>.env.example</code> file as a template:</li>
</ol>
</ol>
<pre><code>cp .env.example .env</code></pre>
<p>Update the following lines in the <code>.env</code> file with your MongoDB connection details:</p>
<pre><code>DB_CONNECTION=mongodb
DB_HOST=127.0.0.1
DB_PORT=27017
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password</code></pre>
<ol>
<ol>
<li>Generate an application key:</li>
</ol>
</ol>
<pre><code>php artisan key:generate</code></pre>
<ol>
<ol>
<li>
<ol>
<li>Install the <code>tymon/jwt-auth</code></li>
</ol>
package for JSON Web Token authentication:</li>
</ol>
</ol>
<pre><code>composer require tymon/jwt-auth</code></pre>
<ol>
<ol>
<li>Generate the JWT secret key:</li>
</ol>
</ol>
<pre><code>php artisan jwt:secret</code></pre>
<ol>
<ol>
<li>Run the database migrations to create the necessary tables:</li>
</ol>
</ol>
<pre><code>php artisan migrate</code></pre>
<ol>
<ol>
<li>(Optional) Run the database seeder to populate the database with dummy data:</li>
</ol>
</ol>
<pre><code>php artisan db:seed</code></pre>
<ol>
<ol>
<li>Run the unit tests to ensure everything is set up correctly:</li>
</ol>
</ol>
<pre><code>php artisan test</code></pre>
<ol>
<ol>
<li>Start the development server:</li>
</ol>
</ol>
<pre><code>php artisan serve</code></pre>
<p>The application will be available at <a href="http://localhost:8000">http://127.0.0.1:8000</a>.</p>

<h2>Usage</h2>

<p>Provide instructions and examples for users to understand and use your project. Include examples of API endpoints, how to make requests, and expected responses.</p>

<h2>Register and Login</h2>

<p>Before testing the API endpoints, you need to register and login to obtain an access token. Follow these steps:</p>

<ol>
  <li>Register a new user:</li>
  <p>Send a <code>POST</code> request to <code>http://127.0.0.1:8000/api/register</code> with the following parameters:</p>
  <pre><code>{
  "name": "Your Name",
  "email": "your-email@example.com",
  "password": "your-password"
}</code></pre>

  <li>Login with the registered user:</li>
  <p>Send a <code>POST</code> request to   <code>http://127.0.0.1:8000/api/login</code> with the following parameters:</p>
  <pre><code>{
  "email": "your-email@example.com",
  "password": "your-password"
}</code></pre>

  <p>The response will include an access token that you can use to authenticate subsequent requests.</p>

<h2>Testing the API</h2>

<p>Once you have obtained the access token, you can test the API endpoints using a tool like Postman. Set the "Authorization" header in your requests with the access token in the following format:</p>
<pre><code>Authorization: Bearer &lt;access_token&gt;</code></pre>

<p>Here are some example API endpoints you can test:</p>

<ul>
  <li><strong>Check Stock:</strong> Send a <code>POST</code> request to <code>http://127.0.0.1:8000/api/kendaraan/check-stock</code> to check the stock of a vehicle.</li>
  <li><strong>Create Kendaraan Transaction:</strong> Send a <code>POST</code> request to <code>http://127.0.0.1:8000/api/kendaraan-transactions</code> to create a new Kendaraan Transaction.</li>
  <li><strong>Get Sales Report:</strong> Send a <code>GET</code> request to <code>http://127.0.0.1:8000/api/sales-report</code> to retrieve the sales report.</li>
</ul>

<p>Make sure to include the required parameters and provide the necessary authentication headers for each request.</p>
