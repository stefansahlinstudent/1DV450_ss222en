class Project < ActiveRecord::Base
	belongs_to :user
	
	#för att man bland annat ska kunna hämta användare från ett projekt eller tvärtom. 
	has_many :minigoals
	#has_and_belongs_to_many :users
	#Den här är mest till för validering. 
	#Rails Console är motsvarande samma sak som man skriver i controllerklassen. 
end
