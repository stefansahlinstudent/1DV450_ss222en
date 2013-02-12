class Minigoal < ActiveRecord::Base
	belongs_to :project
	has_one :status
	belongs_to :status
end
