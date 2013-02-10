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
		@prminigoals = project.minigoalid				
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
	
	def edit
		@project = Project.find(params[:id])
		#code goes here
	end	
	
	def update
		#lite kod
		@project = Project.find(params[:id])	
		if @project.update_attributes(params[:user])
			redirect_to projects_path
		else
			render :action => "edit"
		end
	end
end
