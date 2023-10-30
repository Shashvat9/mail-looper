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
    101 = mail sent
    102 = wrong json



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
    201 = mail sent
    202 = wrong json


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
    301 = mail sent
    302 = wrong json

<b>json sutructure for otp on mail</b> <hr> <br>
    "api_key" : ""
    "type" : "otp"

    "from_email":""
    "application_pass":""

    "message":""
    "subject" : ""
    "email":""
codes: 
    401 = sent otp
    402 = wrong json


general error codes:
    4004 = not a valid request


abbriviations :

1 = deffrient message but same subject
2 = deffrient message and same subject
3 = same message and same subject

from_email = from which email are you want to send email  
from_pass = password for that email