class CreateProjectMinigoalsTable < ActiveRecord::Migration
  def up
	create_table :project_minigoals, :id => false do |t|
		t.integer "project_id"
		t.integer "minigoal_id"
	end
  end

  def down
	drop_table :project_minigoals
  end
end
