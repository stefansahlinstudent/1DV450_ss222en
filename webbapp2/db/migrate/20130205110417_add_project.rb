class AddProject < ActiveRecord::Migration
  def up
	add_project :name, :description
  end

  def down
  end
end
