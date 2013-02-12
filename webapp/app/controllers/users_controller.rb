class UsersController < ApplicationController
	def index
		#if  session[:loggedIn] = true
		#	redirect_to client_app_path
		#else
		#	redirect_to ''
	    #end
		@users = User.all
	end
	
	def new
		@user = User.new
		#get the params from the different fields. 
	end
	
	def show 
		# How to ask the question if page is available
		user = User.find(params[:id])
		@userfname = user.first_name
		@userlname = user.last_name
		@email = user.email
		@uprojects = user.projects
	end
	
	
	def search
		#@searchPhrase = params[:search] 
		#@users = Users.where("project_name LIKE ?", %@searchPhrase%).select("first_name, last_name").all
		#Check the @searchPhrase with the database, to see if it exists. 
		
		
		
	end
	
	def create
	    
		@user = User.new(params[:user])
		if @user.save
			redirect_to users_path
			#redirect to the new user
		else
			render :action => "new"
			#Write error message
		end
		
	end
	
	def update
	#Check if this code is working
		@user = User.find(params[:id])	
		if @user.update_attributes(params[:user])
			redirect_to users_path
		else
			render :action => "edit"
		end
	end
	
	def edit
		@user = User.find(params[:id])	
		
		#<%= link_to "Edit member", edit_user_path %>
		#The link to Use in index view
	end
	
	def destroy
		@user = User.find(params[:id])
		@user.destroy
		redirect_to users_path
	end
	
end

