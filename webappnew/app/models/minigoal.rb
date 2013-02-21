class Minigoal < ActiveRecord::Base
	belongs_to :project
	has_one :status
	belongs_to :status
	belongs_to :user
	
	validates :name, 
			  :presence => {:message => ": Field seems to be missing"}
			  
			  #The other fields should be here as well
			  
end
