import requests
from BeautifulSoup import BeautifulSoup

url = 'https://www.chiefdelphi.com/forums/portal.php'

response = requests.get(url)
html = response.content

soup = BeautifulSoup(html)
print soup.prettify()