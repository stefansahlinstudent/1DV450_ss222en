class User < ActiveRecord::Base
	has_many :projects	
	
	validates_presence_of :first_name, :message => "First name seems to be missing";
	validates_presence_of :last_name, :message => "Last name seems to be missing";
	validates_presence_of :email, :message => "Last email seems to be missing";
	validates_presence_of :password, :message => "Last password seems to be missing";
	
	#validates_format_of (regular expression)
	#stolen from the ruby api
	#validates_format_of :email, :with => %r\A([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})\Z/, :on => :create
	#validates_length_of :first_name, :maximum => 20, :message => First name max characters is 20!
	#validates_length_of :last_name, :maximum => 40, :message => Last name max characters is 40!
	
end
