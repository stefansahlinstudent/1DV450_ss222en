class CreateProjects < ActiveRecord::Migration
  def change
    create_table :projects do |t|
		
	  t.string "name", :limit => 20	
	  t.text :description 
	  t.references :minigoal
      t.timestamps
    end
  end
end
