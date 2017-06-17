**`The Users API`**

_Description: This is for loading users from the server_

**`Parameters`**

**type**: the type of the user which is either `lawyer` or `client` which are strings

**count**: the number of users to load which is an integer

a typical lawyer request will be as follows:

`hostname/app/api/users.php?type=lawyer&count=20` where the hostname is either the localhost 
or the domain name for example `luatsu.tech/app/api/users.php?type=lawyer&count=20`


**`Response`**

The api returns the following json string for example and can load any desired number 
of lawyers from the database:

>{
  "status":"success",
  "payload":[
    {
      "id":"7",
      "firstName":"bazil",
      "lastName":"Mupisiri",
      "sex":"male",
      "email":"bazil@bazil.com",
      "dateOfBirth":"1490911341",
      "dateJoined":"1490911341"
    }
  ],
  "message":"none"
}

The status field is either `success` or `failure` and the payload is a json array of 
lawyers or any desired user type

If the parameters are wrong, the we get the following response:

>{"status":"failure","payload":[],"message":"missing one or all of the get parameters"}

Notice that I changed the name of the type parameter and it gave me that particular response

The `message` field just gives a response message when the request is unsuccessful or the 
string none when the result is successful