class Project < ActiveRecord::Base
	has_many :minigoals
	has_and_belongs_to_many :users
	
	validates :name, 
			  :presence => {:message => "Name seems to be missing"},
			  :length => {:minimum => 5, :message => "Name of the project must be longer than 4 characters"}
	
	
	validates :description, 
			  :presence => {:message => "Description seems to be missing"}
	
			  
end
