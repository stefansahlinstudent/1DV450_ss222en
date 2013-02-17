class MinigoalsController < ApplicationController

	def index
		if session[:loggedIn] == true	
			@minigoals = Minigoal.all		
		else 
			flash[:notice] = "You are not logged in"
		end
	end
	
	def show
		if session[:loggedIn] == true	
			@minigoal = Minigoal.find(params[:id])
			@minigoalProject = @minigoal.project_id
			@projectName = Project.find_by_id(@minigoalProject)
			@minigoalStatus = @minigoal.status_id 
			@status = Status.find_by_id(@minigoalStatus)
			@mgUserId = @minigoal.user_id
			@mgUser =  User.find_by_id(@mgUserId)
			
		else 
			flash[:notice] = "You are not logged in"
			end
	end
	
	def new
		#Here I want access to the project that should contain the minigoal.
			
		@project = Project.find(params[:project_id])
		if session[:loggedIn] == true	
			@minigoal = Minigoal.new
		else 
			flash[:notice] = "You are not logged in"
		end
	end
	
	def create
	    
		@minigoal = Minigoal.new(params[:minigoal])	
		@project = Project.find(params[:project_id])	
		
		@minigoal.project = @project
		# loop to check the users for the project. If the person is not among the users he can not create a minigoal
		@minigoal.user_id = session[:userId] 
		if @minigoal.save
			redirect_to minigoals_path			
		else
			render :action => "new"
		end
		
	end
	
	def destroy
		@sessionId = session[:userId]				
		@minigoal = Minigoal.find(params[:id])
		@minigoalUserId = @minigoal.user_id
		if @sessionId == @minigoalUserId
			@minigoal.destroy
		end
		redirect_to minigoals_path
	end
	
	def edit
		if session[:loggedIn] == true	
			@sessionId = session[:userId]			
			@minigoal = Minigoal.find(params[:id])	
			@minigoalUserId = @minigoal.user_id
			if @minigoalUserId != @sessionId
				flash[:notice] = "You do not have authority"
			end
		else 
			flash[:notice] = "You are not logged in"
		end
	end
	
	def update
		@minigoal = Minigoal.find(params[:id])	
		if @minigoal.update_attributes(params[:minigoal])
			redirect_to minigoals_path
		else
			render :action => "edit"
		end
	end

end
