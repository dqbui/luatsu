**`API Documentation for logging in a user`**

> domain/app/update/login.php

**`Parameters`** _(all of them are required)_

**email**: A string for the email of the user

**password**: A string for the password of the user

**`Response`** 

There is no response, the user is then logged in once the account verification is successful

If the account verification is not successful, the user will be returned to the login page with an 
error message embedded in the url

If there is an internal server error, you will get nothing but the server will silently fail and 
you could possibly get a file 500 error in the javascript console