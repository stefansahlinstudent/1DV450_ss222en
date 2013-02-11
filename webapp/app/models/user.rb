class User < ActiveRecord::Base
	has_and_belongs_to_many :projects
	
	validates :first_name, 
			  :presence => {:message => "First name seems to be missing"},
			  :length => {:maximum => 20, :message => "First name of the user can not be longer than 20 characters"}
			  
			  
	validates :last_name, 
			  :presence => {:message => "Last name seems to be missing"},
			  :length => {:maximum => 40, :message => "Last name of the user can not be longer than 20 characters"}
			  
	validates :email, 
			  :presence => {:message => "Email seems to be missing"}
			  #validates_format_of :email, :with => %r\A([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})\Z/, :on => :create, {:message =>"Invalid email"}
			  #Try to get the format right
	
	validates :password, 
			  :presence => {:message => "Password seems to be missing"},
			  :length => {:minimum => 5, :maximum => 30, :message => "Password must be at least 5 and maximum 30 characters"}
			  #Get a maximum length for password to!
			  
	
end
