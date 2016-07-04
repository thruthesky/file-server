# File Upload





# file-upload

This is a file upload server which support many different kinds of web site.

* When a site gets bigger, the file storage gets bigger.
* When a site gets bigger, the site is needed to be distributed.
 
 And this is where file server comes.
 

# Installation

By creating upload folder, the installation will be done.

the folder path should be "data/upload/domain" where 'domain' is the input of file upload. 





# Coding guide

## Input query variable

* uid - unique users id ( it can be combination of "user unqiue NO + user login ID + Registered Date" )
* domain - unique domain of the site. it is a realm or an ID of the site.. not a actual domain.
* $_FILES['userfile'] - file upload info.



first md5 = md5 ( filename + time() + IP )
second md5 = md5( secret_key + domain + uid )


To make it difficulty to guess, the uid must be difficult to guess.

actual file name will be in "first-md5.second-md5.extension"


* Hackers may delete any file if they know 'uid'. so it is important to make 'uid' is difficult to guess.
 
* uid should be unique value for each user and should not be changed.
  

## File Server Secret Key

* Without file server secret key, one can easily guess first-md5.

    * if there is no file server secret key, one can generate md5 with random string.
        * but if there is secret key, it is more difficult to guess it.





## To delete a file.


* The user must provide domain, uid, filename.

    * ?domain=xxxx&uid=xxxx&filename=xxxxx
    
    * the script will make 'first_md5' and compare it with the file name.
    
        * if match, delete it.
        
        * if not match, the file is not owned by the user.
         

# WARNING

The 'uid' should not be exposed any where in the site.

This is very important.

When a user deletes a file, the script must generate the 'uid' on the fly and pass it to file server.



