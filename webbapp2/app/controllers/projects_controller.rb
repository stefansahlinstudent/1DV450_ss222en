class ProjectsController < ApplicationController
	
	#Den g�r automatiskt till index f�rst n�r /projects anropas (resources)
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
	
	def create
		@project = Project.new(params[:project])
		
		if @project.save
		redirect_to users_path
		else 
		render :action => "new"
		end
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
