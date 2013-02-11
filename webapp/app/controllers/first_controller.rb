class FirstController < ApplicationController
	def index
		#@login = Project.all
		
	end
	
	def login
		#session id here
		#Go to this action from the form in index
		# if logged in is correct
		#session[:loggedIn] = true
		#session [:userName] = @username
		#session [:userId] = nil
		#Redirect to the users show page on UserController
		#http://orion.lnu.se/pub/education/course/1DV450/VT13/sessions/F05.html#13
		
		#else render the same page, FirstController#index
	end
	
	def logout
		#session id deleted here
		#session[:username] = nil
		#session[:loggedIn] = false
		#redirect_to(:action => 'index')
	end
	
end
