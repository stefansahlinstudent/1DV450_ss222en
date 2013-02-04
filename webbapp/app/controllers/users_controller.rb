class UsersController < ApplicationController
	def index
		@users = User.all
	end
	
	def new
		@user = User.new
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
		@user = User.find(params[:id])
		if @user.save
			#redirect to the new user
		else
			#Write error message
		end
		
	end
	
	def update
	
	end
	
	def destroy
		@user = User.find(params[:id])
		@user.destroy
		redirect_to users_path
	end
	
end
