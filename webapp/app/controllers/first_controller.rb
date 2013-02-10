class FirstController < ApplicationController
	def index
		#@login = Project.all
		
	end
	
	def login
		#session id here
		#Go to this action from the form in index
		#http://orion.lnu.se/pub/education/course/1DV450/VT13/sessions/F05.html#13
	end
	
	def logout
		#session id deleted here
		session[:user_id] = nil
		redirect_to(:action => 'index')
	end
	
end
