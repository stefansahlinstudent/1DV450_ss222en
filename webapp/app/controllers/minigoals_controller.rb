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
			@minigoalStatus = @minigoal.status_id #Here you should instead find the name of the status where the minigoalStatus is ...
			@status = Status.find_by_id(@minigoalStatus)
			
		else 
			flash[:notice] = "You are not logged in"
		end
	end
	
	def new
		if session[:loggedIn] == true	
			@minigoal = Minigoal.new
		else 
			flash[:notice] = "You are not logged in"
		end
	end
	
	def create
	    
		@minigoal = Minigoal.new(params[:minigoal])
		if @minigoal.save
			redirect_to minigoals_path			
		else
		render :action => "new"
		end
		
	end
	
	def destroy
		@minigoal = Minigoal.find(params[:id])
		@minigoal.destroy
		redirect_to minigoals_path
	end
	
	def edit
		if session[:loggedIn] == true	
			@minigoal = Minigoal.find(params[:id])	
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
