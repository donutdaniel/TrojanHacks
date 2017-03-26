from django.http import HttpResponse
from django.template import loader
from django.shortcuts import render
from .models import Review

def index(request):
    latest_review_list = Review.objects.order_by('-pub_date')[:5]
    context = {'latest_review_list': latest_review_list}
    #output = '<br> '.join([r.review_text for r in latest_review_list])
    return render(request, 'hackathons/index.html', context)

def detail(request, review_id):
	return HttpResponse("Review number: %s" % review_id)

def parse(str):
	return ''

