class MinigoalsController < ApplicationController

	def index
		@minigoals = Minigoal.all
		#Get every minigoal from a specific user. 
	end
	
	def show
		@minigoal = Minigoal.find(params[:id])
		@minigoalProject = @minigoal.project_id
		@minigoalStatus = @minigoal.status_id #Here you should instead find the name of the status where the minigoalStatus is ...
	end
	
	def new
		@minigoal = Minigoal.new
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
		@minigoal = Minigoal.find(params[:id])	
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
