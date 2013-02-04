class CreateMinigoals < ActiveRecord::Migration
  def change
    create_table :minigoals do |t|
	  t.string :name
	  t.references :project
      t.timestamps
    end
  end
end
