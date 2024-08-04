
<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
<head>
 	<script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>MY API · Bootstrap v0.0.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/jumbotrons/">
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Favicons -->
	<link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
	<link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
	<link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
	<link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
	<link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
	<link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
	<meta name="theme-color" content="#712cf9">

    <style>
    	* {
    		font-family: monospace;
    	}
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="jumbotrons.css" rel="stylesheet">
  </head>
  <body>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
              id="bd-theme"
              type="button"
              aria-expanded="false"
              data-bs-toggle="dropdown"
              aria-label="Toggle theme (auto)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
      	</button>
      	<ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        	<li>
         	 	<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
            Light
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
            Dark
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#circle-half"></use></svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
      </ul>
    </div>

    
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="bootstrap" viewBox="0 0 118 94">
    <title>Bootstrap</title>
    <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
  </symbol>
  <symbol id="arrow-right-short" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
  </symbol>
  <symbol id="check2-circle" viewBox="0 0 16 16">
    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
  </symbol>
</svg>

	<div class="container-fluid">
  		<div class="text-center bg-body-tertiary p-1 rounded-3">
    		<img src="../assets/logo/truss-1.png" class="bi" width="100" height="100">
    		<h1 class="text-body-emphasis">Truss</h1>
		    <p class="col-lg-8 mx-auto fs-5 text-muted">
		      	Built with a <code>REST API in PHP</code>, this API is very simple, yet incredibly reliable and safe, with an authentication method that greatly improves data protection and user authentication.

		    </p>
		</div>
	</div>

	<div class="container border-bottom">
    	<header class="d-flex justify-content-center py-3">
	      	<ul class="nav nav-pills">
	       		<li class="nav-item"><a href="#" class="nav-link text-body-secondary">Home</a></li>
	        	<li class="nav-item"><a href="#api" class="nav-link text-body-secondary">API</a></li>
	        	<li class="nav-item"><a href="#requests" class="nav-link text-body-secondary">Requests</a></li>
	        	<li class="nav-item"><a href="#database" class="nav-link text-body-secondary">Database</a></li>
	        	<li class="nav-item"><a href="#token" class="nav-link text-body-secondary">JWTs</a></li>
	        	<li class="nav-item"><a href="#register" class="nav-link text-body-secondary">Register</a></li>
	        	<li class="nav-item"><a href="#login" class="nav-link text-body-secondary">Login</a></li>
	        	<li class="nav-item"><a href="#urls" class="nav-link text-body-secondary">URLS</a></li>
	        	<li class="nav-item"><a href="#" class="nav-link text-body-secondary">Pagination</a></li>
	        	<li class="nav-item"><a href="#security" class="nav-link text-body-secondary">Security</a></li>
	        	<li class="nav-item"><a href="#usage" class="nav-link text-body-secondary">Usage</a></li>
	      	</ul>
    	</header>
  	</div>

  	<div class="container py-5">

  		<a href="javascript:;" name="api"></a>
  		<h5 class="fw-bold">API</h5>
  		<p>
  			In contemporary web development, REST APIs are essential. These days, the majority of online applications are created as front-end single-page apps that are linked to back-end APIs that are built in other languages. You may easily create REST APIs with the aid of numerous excellent frameworks. Two of the most widely used examples in the PHP environment are Laravel/Lumen and the Symfony API platform. They offer excellent resources for handling requests and producing JSON responses that contain the appropriate HTTP status codes. Additionally, they simplify the management of typical problems such as request validation, data transformation, pagination, filters, rate throttling, complex endpoints with sub-resources, authentication/authorization, and API documentation.
  		</p>

  		<a href="javascript:;" name="requests"></a>
  		<h5 class="fw-bold">Requests</h5>
  		<p>
  			Normally, our project's URL would look something like this: http://localhost/rest-api-php/public. However, depending on the project name, this URL might alter. Nonetheless, http://localhost/rest-api-php/public, the root URL, remains unchanged.
			<br>
			We implement URL rewriting using a .htaccess file, which removes the requirement for unnecessary prefixes like index.php or.php when accessing our URLs.
			<br><br>
			Using the index.php file in the public folder will help to simplify the process of testing the API endpoints for our project. This file serves as our application's launchpad and includes any configurations that are required.
  		</p>

  		<a href="javascript:;" name="database"></a>
  		<h5 class="fw-bold">Database</h5>
  		<p>
  			We will use MySQL to power our simple API
  			<br>
  			We configure our database connection with database name "api.sample" to make sure that our API endpoints and the database communicate with each other. All of the necessary configurations are contained in the bootstrap.php file for ease of use. By importing this file into our index.php, it becomes easier to manage imports and configurations.
  			<br>
  			Provision of database details is to be kept in the <code>.env</code> file.
  		</p>

  		<a href="javascript;" name="token"></a>
  		<h5 class="fw-bold">JWTs</h5>
  		<p>
  			A string with three segments that are connected by a period (.) and base64url encoded makes up a JSON Web Token. 
  			<br>
  			All that is required to create a JSON Web Token is the concatenation of the header, payload, and signature, separated by periods ("."):
  			<br>
  			<br>
  			Header: <br>
  				Metadata concerning the token, including the type of token and the algorithm employed, are contained in a header.
  				<br>
  				<code>
  					$header = json_encode([
			            "alg" => "HS256",
			            "typ" => "JWT"
			        ]);
  				</code>
  			<br>
  			<br>
  			Payload: <br>
  				The payload contains base64-url-encoded user data compressed into particular indices called claims that are contained within the JWT structure. 
  				<br>
  				<code>
  					$payload = [
					    "id" => $user['id'],
					    "name" => $user["name"]
					];
  				</code>
  			<br>
  			<br>
			Signature: <br>
				This is generated by creating a hash of the header and payload, combined with a secret key typically generated as either 256 bits or 32 bytes. By convention, the secret key matches the size of the hash output.
			<br>
			You will have to use the link below to generate a secret key we need for this project:
			<br>https://generate-random.org/encryption-key-generator?source=post_page-----ebf5693b931a--------------------------------
			<br>
			<br>
			After secret key generation, direct to the .env file and paste the signature code in <code>SECRET_KEY</code>
			<br>
			The system's security may be jeopardised if the secret key used to sign the token is disclosed to the public. It should always be kept private.
  		</p>

  		<a href="javascript:;" name="register"></a>
  		<h5 class="fw-bold">Register</h5>
  		<p>
  			To register an api users, please navigate to our user interface. http://localhost/rest-api-php/register.php is the correct URL to use. if you do not change your  project's directory or register file name.
  			<br><br>
  			The API users will have to register into the database to be able to access the full functionality of the API regarding token authentication.
  			<br><br>
  			Create a connection to our database so that api users may be added to the "api_users" table in our "api.sample" database with ease. A confirmation message verifying the user's inclusion in the database will be sent after their successful registration.
  		</p>

  		<a href="javascript:;" name="login"></a>
  		<h5 class="fw-bold">Login</h5>
  		<p>
  			Send the created api user's username and password in JSON format, as shown below, to the login endpoint (http://localhost/rest-api-php/public/login.php), and initiate the request:
  			<br>
			<code>
				{
				   "username" : "apiusername",
				   "password" : "apiuserpassword"
				}
			</code>
  			<br><br>
  			The "public" folder acts as the request entry point for our project, lets proceed to test the system by logining in.
  			<br>
  			we’ll send a request containing the username and password of the user profiled or created in our frontend register.php UI. We’ll pass the required user details in JSON format:
  		</p>


  		<a href="javascript:;" name="urls"></a>
  		<h5 class="fw-bold">URL</h5>
  		<p>
  			Main project url : <code>http://localhost/rest-api-php/public/</code>
  			<br>
  			<br>
  			Register api user url : <code>http://localhost/rest-api-php/register.php</code> POST
  			<br>
  			<br>
  			Login api user url : <code>http://localhost/rest-api-php/login.php</code> POST
  			<br>
			<code>{"username" : "apiusername", "password" : "apiuserpassword"}</code>
  			<br>
  			<br>
  			All users : <code>http://localhost/rest-api-php/users</code> GET
  			<br>
  			<br>
  			Refresh api user login tokens: <code>http://localhost/rest-api-php/refresh.php</code> POST
  			<br>
  			<code>{"token" : "apiusername"}</code>
  			<br>
  			<br>
  			Create user : <code>http://localhost/rest-api-php/users/userid</code> POST
  			<br>
  			<code>{"user_fullname":"", "user_email": "", "user_password":""}</code> 
  			<br>
  			<br>
  			Get one user : <code>http://localhost/rest-api-php/users/userid</code> GET
  			<br>
  			Delete user : <code>http://localhost/rest-api-php/users/userid</code> DELETE
  			<br>
  			Update user : <code>http://localhost/rest-api-php/users/userid</code> PUT
  			<br>
  			<br>
  			Note : first item that comes after the "main project url" is always the table name.
  		</p>

  		<a href="javascript:;" name="security"></a>
  		<h5 class="fw-bold">Security</h5>
  		<p>
  			When a user logs in via the login endpoint, two crucial tokens are provided: an access token and a refresh token. The access token grants immediate access to resources, while the refresh token serves as a long-term authorization tool. If the access token expires, the refresh token is then passed to the refresh endpoint. This action triggers the generation of a new access token, which, in turn, creates a fresh refresh token. This process forms a robust and secure mechanism ensuring continuous access to resources while maintaining high levels of security and user convenience\
  			<br>
  			The implementation of access tokens and refresh tokens enhances security and user experience. Access tokens provide immediate access to resources and have a short lifespan(20 secs), promoting security by limiting their usability in case of unauthorized access. On the other hand, refresh tokens (5 days) have a longer lifespan and enable users to obtain new access tokens without repeated authentication
			<br>
			<br>
			Login with user api username and password to generate token key
			<br>
			<br>
			use refresh tokens as your Authorization Bearer Token
			<br>
			<br>
			Token, expires in every 5 days
  		</p>


  		<h5 class="fw-bold">Pagination</h5>
  		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
  		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
  		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
  		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
  		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
  		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

  		<a href="javascript:;" name="usage"></a>
  		<h5 class="fw-bold">Usage</h5>
  		<p>
  			The "public/" directory contains PHP files responsible for handling API requests and responses. It includes an .htaccess file for URL rewriting and an index.php file, along with other PHP files for specific functionalities.
  			<br><br>
			The "vendor/" directory contains Composer dependencies installed for the project. These dependencies are managed by Composer and should not be modified directly.
			<br><br>
			The <code>.env</code> file contains environment variables necessary for configuring the application environment, such as database credentials and API keys.
  		</p>
	</div>

	<div class="container">
  		<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    		<div class="col-md-4 d-flex align-items-center">
	      		<a href="home" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
	        		<img src="../assets/logo/truss-2.png" class="bi" width="30" height="24"><use xlink:href="#bootstrap"/>
	      		</a>
	      		<span class="mb-3 mb-md-0 text-body-secondary">&copy; 2024 Truss (API Development), Inc</span>
	    	</div>

		    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
		      	<li class="ms-3">
		      		<a class="text-body-secondary" href="#">
		      			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
						  <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
						</svg>
		      		</a>
		      	</li>
		      	<li class="ms-3">
		      		<a class="text-body-secondary" href="#">
		      			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
						  <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
						</svg>
		      		</a>
		      	</li>
		    </ul>
  </footer>
</div>


	<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
