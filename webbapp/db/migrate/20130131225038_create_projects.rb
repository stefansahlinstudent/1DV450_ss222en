class CreateProjects < ActiveRecord::Migration
  def change
  #Enda uppgift �r att skapa databastabellen.
  #
    create_table :projects do |t|
		#t.reference :users
		t.string :name
		t.string :description
      t.timestamps
    end
  end
end
