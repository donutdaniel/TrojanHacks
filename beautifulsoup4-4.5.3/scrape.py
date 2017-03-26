import urllib2
from BeautifulSoup import BeautifulSoup

url = 'https://www.chiefdelphi.com/forums/portal.php'

page = urllib2.urlopen(url)
soup = BeautifulSoup(page)
print soup.prettify()