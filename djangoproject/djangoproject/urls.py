from django.conf.urls import patterns, include, url

# Uncomment the next two lines to enable the admin:
from django.contrib import admin
admin.autodiscover()

urlpatterns = patterns('',
    # Examples:
    # url(r'^$', 'djangoproject.views.home', name='home'),
    # url(r'^djangoproject/', include('djangoproject.foo.urls')),

    # Uncomment the admin/doc line below to enable admin documentation:
    # url(r'^admin/doc/', include('django.contrib.admindocs.urls')),

    # Uncomment the next line to enable the admin:
    url(r'^admin/', include(admin.site.urls)),
	
	url(r'^projects/$', 'myapp.views.project_list', name="project_list"),	 
	#url(r'^project/add$', 'myapp.views.snippet_add', name="project_add"),
	#url(r'^project/(?P<project_id>\d+)/delete/$', 'myapp.views.project_delete', name="project_delete"),
	#url(r'^project/(?P<project_id>\d+)/edit/$', 'myapp.views.project_edit', name="project_edit"),
)
