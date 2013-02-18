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
			@userId = session[:userId]
			 project = Project.find(params[:id])		
			@prusers = project.users
			
			
			@project = project
			@prownerId = @project.owner_id
			@prowner = User.find(@prownerId )
			@pMinigoals = @project.minigoals
			@projectName = project.name
			@projectDescription = project.description
		else 
			flash[:notice] = "You are not logged in"
		end
	end
	
	def create
				
		@project = Project.new(params[:project])
		@userId = session[:userId]
		@user = User.find(@userId)
		@project.owner_id = @userId
			
		@project.users << @user	
		if @project.save
			redirect_to projects_path
		else 
			render :action => "new"
		end
	end
	
	def destroy
		@sessionId = session[:userId]
		@project = Project.find(params[:id])
		@projectUserId = @project.owner_id
		if @projectUserId == @sessionId 
			@crap = Project.find(params[:id])
			@crap.destroy
			redirect_to projects_url
		end
	end
	
	def new
		if session[:loggedIn] == true
		@users = User.all
		@nrusers = @users.size
		@userSize = @users.size
		@userId = session[:userId]
			@project = Project.new
		else 
				flash[:notice] = "You are not logged in"
		end
	end
	
	def edit
		if session[:loggedIn] == true	
			@sessionId = session[:userId]
			@validUser = false
			@project = Project.find(params[:id])
			@sessionId = session[:userId]
			@projectUserId = @project.owner_id
			@prowner = User.find(@project.owner_id)
			
			if @prowner.id == @sessionId
				@validUser = true
			end
			#@prusers = @project.users
			#@validUser = false
			#@prusers.each do |pruser|		
			#	if pruser.id == @sessionId
			#		@validUser = true
			#	end
			#end 
			
			#if @validUser == false
			#	flash[:notice] = "You do not have user authority"
			#end
	
			
		else 
			flash[:notice] = "You are not logged in"
		end
	end	
	
	def update
		
		@project = Project.find(params[:id])
		
		if @project.update_attributes(params[:project])
			redirect_to projects_path
		else
			render :action => "edit"
		end
	end
	
	def userchange
		#lite kod
		
		@project = Project.find(params[:id])
		
		if @project.update_attributes(params[:project])
			redirect_to projects_path
		else
			render :action => "edit"
		end
	end
end
