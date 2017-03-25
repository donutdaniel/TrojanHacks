import scrapy
import BeautifulSoup


class HackFinder(scrapy.Spider):
    name = "findhack"

    def start_requests(self):
        urls = [
            'https://mlh.io/seasons/na-2017/events'
        ]
        for url in urls:
            yield scrapy.Request(url=url, callback=self.parse)

    def parse(self, response):
        page = response.url.split("/")[-2]
        filename = 'hacks-%s.html' % page.prettify()
        with open(filename, 'wb') as f:
            f.write(response.body)
        self.log('Saved file %s' % filename)
