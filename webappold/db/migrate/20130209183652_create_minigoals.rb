class CreateMinigoals < ActiveRecord::Migration
  def change
    create_table :minigoals do |t|
	  #Should there here be a field to status?
	  t.references :project
	  t.references :status
	  t.string :name
      t.timestamps
    end
  end
end