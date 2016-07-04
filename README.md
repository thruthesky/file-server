# file-upload

This is a file upload server which support many different kinds of web site.







xforum puts file into a different server.

the setting var - xforum_url_file_server will have the url of the file server.

deliver user's ID or user's login ID, as secret key, and md5() with file-server/config.php's $secret_key.

and md5() with filename + time() + IP 

file name will be "first-md5.second-md5.extension"

so, unless the hacker knows the user's secret key, he would have difficulty to delete files.


git 




