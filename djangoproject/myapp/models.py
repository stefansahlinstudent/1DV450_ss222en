from django.db import models

class User(models.Model):
	first_name = models.CharField(max_length=50)
	last_name = models.CharField(max_length=50)
	email = models.CharField(max_length=50)
	password = models.CharField(max_length=50)
		
	def __unicode__(self):
		return self.first_name

# Create your models here.

class Status(models.Model):
	name = models.CharField(max_length=50)
		
	def __unicode__(self):
		return self.name


class Minigoal(models.Model):
	name = models.CharField(max_length=50)
	minigoalStatus = models.ForeignKey(Status, related_name="minigoals")
		
	def __unicode__(self):
		return self.name

class Project(models.Model):
	name = models.CharField(max_length=50)
	description = models.CharField(max_length=50)
	start = models.DateField(max_length=50)
	end = models.DateField(max_length=50)
	projectsUsers = models.ManyToManyField(User, related_name="projects")
	projectMinigoals = models.ForeignKey(Minigoal, related_name="projects")
	
		
	def __unicode__(self):
		return self.name
		

		
