class Project < ActiveRecord::Base
	belongs_to :user
	
	#f�r att man bland annat ska kunna h�mta anv�ndare fr�n ett projekt eller tv�rtom. 
	has_many :minigoals
	#has_and_belongs_to_many :users
	#Den h�r �r mest till f�r validering. 
	#Rails Console �r motsvarande samma sak som man skriver i controllerklassen. 
end
