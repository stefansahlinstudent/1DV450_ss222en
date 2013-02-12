class FirstController < ApplicationController
	def index
		#@login = Project.all
		
	end
	
	def login
		flash[:notice] = "Invalid Username or Password"
		@email = params[:email]
		@password = params[:password]
		@user = User.where("email = ? AND password = ?", @email, @password)
		
		
		if @user.size > 0 
			@something = @user.first.id
			@firstName = @user.first.first_name
			session[:userId] = @something
			session[:loggedIn] = true
			# go to the users home page and put a logoutbutton there
			#redirect_to(:action => 'index')	
		else 
			#Stay at the same page
			redirect_to(:action => 'index')	
		end
		
	end
	
	def logout
		#session id deleted here
		session[:userId] = nil
		session[:loggedIn] = false
		redirect_to(:action => 'index')
	end
	
	def test
	
	end
	
end
