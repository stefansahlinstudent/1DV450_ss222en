class FirstController < ApplicationController
	def index
		@sessionLogin = session[:loggedIn]
		@sessionId = session[:userId]
	end
	
	
	 
	
	def login
		
		@email = params[:email]
		@password = params[:password]
		@user = User.where("email = ? AND password = ?", @email, @password)
		
		
		
		
		if @user.size > 0 
			@something = @user.first.id
			@firstName = @user.first.first_name
			session[:userId] = @something
			session[:loggedIn] = true
			
			@sessionLogin = session[:loggedIn]
			@sessionId = session[:userId]	
		else 		
			#puts "login failed"
			redirect_to(:action => 'index')
			
		end
				
		
	end
	
	
	def logout
		#session id deleted here
		session[:userId] = nil
		session[:loggedIn] = false
		redirect_to(:action => 'index')
		
	end
	
	
	
end
