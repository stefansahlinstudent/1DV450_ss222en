class ProjectsController < ApplicationController
	
	#Den går automatiskt till index först när /projects anropas (resources)
	def index
		if session[:loggedIn] == true	
			@projects = Project.all
		else 
			flash[:notice] = "You are not logged in"
		end
	end
	
	def show 
		if session[:loggedIn] == true	
			project = Project.find(params[:id])		
			@prusers = project.users
			@project = project
			@pMinigoals = @project.minigoals
			@projectName = project.name
			@projectDescription = project.description
		else 
			flash[:notice] = "You are not logged in"
		end
	end
	
	def create
		@project = Project.new(params[:project])	
		if @project.save
		redirect_to projects_path
		else 
		render :action => "new"
		end
	end
	
	def destroy
		@crap = Project.find(params[:id])
		@crap.destroy
		redirect_to projects_url
	end
	
	def new
		if session[:loggedIn] == true	
			@project = Project.new
		else 
				flash[:notice] = "You are not logged in"
		end
	end
	
	def edit
		if session[:loggedIn] == true	
			@project = Project.find(params[:id])
		else 
			flash[:notice] = "You are not logged in"
		end
	end	
	
	def update
		#lite kod
		
		@project = Project.find(params[:id])	
		if @project.update_attributes(params[:project])
			redirect_to projects_path
		else
			render :action => "edit"
		end
	end
end
