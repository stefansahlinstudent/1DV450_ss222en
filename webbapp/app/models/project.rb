class Project < ActiveRecord::Base
	#check for validation in this class
	belongs_to :user
	has_many :minigoals 
	
	validates_presence_of :name, :message => "No name in field";
	
	#has_and_belongs_to_many :users
	#Den h�r �r mest till f�r validering. 
	#Rails Console �r motsvarande samma sak som man skriver i controllerklassen. 
end
