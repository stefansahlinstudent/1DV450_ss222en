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
		flash.keep[:notice] = "Should show something here"
		@user = User.new
		#get the params from the different fields. 
	end
	
	def show 
	    if session[:loggedIn] == true
			# How to ask the question if page is available
			
			user = User.where("id = ?", params[:id])
			
			if !user.empty?
			@userfname = user.first.first_name
			@userlname = user.first.last_name
			@email = user.first.email
			@uprojects = user.first.projects
			else
			flash[:notice] = "ajajaj"
			end
		else 
			flash[:notice] = "You are not logged in"
			#redirect_to_root_url
		end
		
	end
	
	
	def search
		
		@searchPhrase =  params[:search]
		@users= User.find(:all, :conditions=> ["first_name like :eq", {:eq => "%" + @searchPhrase + "%"}])
		
		#@user = User.where("first_name LIKE = ? AND password = ?", @email, @password)
		#@user = User.where("email = ? AND password = ?", @email, @password)
		#WHERE supplier_name like 'Hew%';
		#@users = User.where("first_name LIKE ?", @searchPrase)
		#@users = User.find (:all, :conditions=> ["first_name like ?", @searchPhrase + "%"]
		
		
		@size = @users.size #something is weird here. 
		@first = @users.first.first_name
		#@first = @users.first
		
		#@firstUser = @user.first
		#@users = Users.where("project_name LIKE ?", %@searchPhrase%).select("first_name, last_name").all
				
		
	end
	
	def create
	    
		@user = User.new(params[:user])
		if @user.save
			#redirect_to users_path
			redirect_to root_url
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

