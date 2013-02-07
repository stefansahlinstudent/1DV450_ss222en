class MinigoalsController < ApplicationController

	def index
		@minigoals = Minigoal.all
		#Get every minigoal from a specific user. 
	end
	
	def show
		@minigoal = Minigoal.find(params[:id])	
	end
	
	def new
		@minigoal = Minigoal.new
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
	
	end

end