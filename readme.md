add given json in post with name "json"

<b>json sutructure for deffrient message but same subject</b> <br>

    "api_key" : ""
    "type" : "1"

    "from_email":""
    "from_pass":""

    "subject" : ""
    [n]:{
        "email":""
        "message":""
    }



<b>json sutructure for deffrient message and deffrient subject</b> <br>

    "api_key" : ""
    "type" : "2"

    "from_email":""
    "from_pass":""

    [n]:{
        "email":""
        "subject" : ""
        "message":""
    }


<b>json sutructure for same message and same subject</b> <br>

    "api_key" : ""
    "type" : "3"

    "from_email":""
    "from_pass":""

    "message":""
    "subject" : ""
    [n]:{
        "email":""
    }


1 = deffrient message but same subject
2 = deffrient message and same subject
3 = same message and same subject

from_email = from which email are you want to send email  
from_pass = password for that email