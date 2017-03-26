from django.http import HttpResponse
from django.template import loader
from django.shortcuts import render
from .models import Review
import os
import re

#need to parse out

hackathonsList = {}

class Hackathon:
	def __init__(self, url, name, date, location):
		self.url = url
		self.name = name
		self.date = date
		self.location = location

def parse(data):
	count = 0
	for line in data:
		temp = re.search(' ', line)
		hackathonsList.append(Hackathon(temp.group(0), temp.group(1), temp.group(2), temp.group(3)))

#file = open('data.txt', 'r')
#parse(file)

def index(request):
    latest_review_list = Review.objects.order_by('-pub_date')[:5]
    context = {'latest_review_list': latest_review_list}
    #output = '<br> '.join([r.review_text for r in latest_review_list])
    return render(request, 'hackathons/index.html', context)

def detail(request, review_id):
	return HttpResponse("Review number: %s" % review_id)

def parse(str):
	return ''
