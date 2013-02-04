class ProjectsController < ApplicationController
	
	#Den går automatiskt till index först när /projects anropas (resources)
	def index
		@projects = Project.all
	end
	
	def show 
		project = Project.find(params[:id])
		@project = project
		@projectName = project.name
		@projectDescription = project.description
		@prusers = project.users
		@prminigoals = project.minigoals
		
		
		
	end
	
	def destroy
		@crap = Project.find(params[:id])
		@crap.destroy
		redirect_to projects_url
		#lite kod
	end
	
	def new
		@project = Project.new
	end
	
	def update
		#lite kod
	end
end
