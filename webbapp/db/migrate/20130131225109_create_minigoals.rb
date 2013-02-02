class CreateMinigoals < ActiveRecord::Migration
  def change
    create_table :minigoals do |t|
		t.reference :project
		t.string :name
		t.timestamps
    end
  end
end
