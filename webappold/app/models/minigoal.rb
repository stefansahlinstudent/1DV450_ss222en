class Minigoal < ActiveRecord::Base
	belongs_to :project
	has_one :status
	belongs_to :status
	
	validates :name, 
			  :presence => {:message => ": Field seems to be missing"}
			  
end
