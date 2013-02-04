class Minigoal < ActiveRecord::Base
	belongs_to :project
	has_many :statuses
end
