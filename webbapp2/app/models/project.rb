class Project < ActiveRecord::Base
	has_many :minigoals
	has_and_belongs_to_many :users
end
