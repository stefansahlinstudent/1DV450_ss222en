class Project < ActiveRecord::Base
	#check for validation in this class
	belongs_to :user
	has_many :minigoals 
	
	validates_presence_of :name, :message => "No name in field";
	
	#has_and_belongs_to_many :users
	#A file for validation and for helping the migration classes
	#Rails Console är motsvarande samma sak som man skriver i controllerklassen. 
end
