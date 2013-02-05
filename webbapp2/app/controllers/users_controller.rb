class UsersController < ApplicationController
	def index
		@users = User.all
	end
	
	def new
		@user = User.new
		#get the params from the different fields. 
	end
	
	def show 
		user = User.find(params[:id])
		@userfname = user.first_name
		@userlname = user.last_name
		@email = user.email
		@uprojects = user.projects
		
		#@userDescription = user.description
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
		@user = User.find(params[:id])	
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

