class CreateStatuses < ActiveRecord::Migration
  def change
    create_table :statuses do |t|
		t.reference :minigoal
		t.string :name
        t.timestamps
    end
  end
end
