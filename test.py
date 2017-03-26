import urllib2
from BeautifulSoup import BeautifulSoup

page = urllib2.urlopen("https://www.crummy.com/software/BeautifulSoup/#Download")
soup = BeautifulSoup(page)

for incident in soup('td', width="90%"):
    where, linebreak, what = incident.contents[:3]
    print where.strip()
    print what.strip()
    print
