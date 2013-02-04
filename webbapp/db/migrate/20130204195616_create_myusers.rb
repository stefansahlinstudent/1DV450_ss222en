class CreateMyusers < ActiveRecord::Migration
  def change
    create_table :myusers do |t|

      t.timestamps
    end
  end
end
