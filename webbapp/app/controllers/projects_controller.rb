class ProjectsController < ApplicationController
	
	#Den går automatiskt till index först när /projects anropas (resources)
	def index
		@projects = Project.all
	end
	
	def show 
		project = Project.find(params[:id])
		@projectName = project.name
		@projectDescription = project.description
	end
	
	def delete
		#lite kod
	end
	
	def new
		@project = Project.new
	end
	
	def update
		#lite kod
	end
end
