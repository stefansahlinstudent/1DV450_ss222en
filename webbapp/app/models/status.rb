class Status < ActiveRecord::Base
	belongs_to :project
	
	#Where to put the validation?
end
