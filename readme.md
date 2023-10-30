<b>Steps to obtain application password</b><hr><br>
step 1 : go to security in google accounts <br>
step 2 : locate application password and click on it<br>
stem 3 : select other in apps and put "-" in app name<br>
step 4 : copy generated password<br>

or<br>
refeare https://youtu.be/9tD8lA9foxw?t=88 this link for generating password

add given json in post with name "json"

<b>json sutructure for deffrient message but same subject</b><hr> <br>

    "api_key" : ""
    "type" : "1"

    "from_email":""
    "application_pass":""

    "subject" : ""
    [n]:{
        "email":""
        "message":""
    }

codes: 
    101 = mail sent<br>
    102 = wrong json<br>



<b>json sutructure for deffrient message and deffrient subject</b><hr> <br>

    "api_key" : ""
    "type" : "2"

    "from_email":""
    "application_pass":""

    [n]:{
        "email":""
        "subject" : ""
        "message":""
    }

codes: 
    201 = mail sent<br>
    202 = wrong json<br>


<b>json sutructure for same message and same subject</b><hr> <br> 

    "api_key" : ""
    "type" : "3"

    "from_email":""
    "application_pass":""

    "message":""
    "subject" : ""
    [n]:{
        "email":""
    }

codes: 
    301 = mail sent<br>
    302 = wrong json<br>

<b>json sutructure for otp on mail</b> <hr> <br>


    "api_key" : ""
    "type" : "otp"

    "from_email":""
    "application_pass":""

    "message":""
    "subject" : ""
    "email":""

codes: 
    401 = sent otp<br>
    402 = wrong json<br>


general error codes:<br>
    4004 = not a valid request<br>


abbriviations :<br>

1 = deffrient message but same subject<br>
2 = deffrient message and same subject<br>
3 = same message and same subject<br>

from_email = from which email are you want to send email  <br>
from_pass = password for that email<br>