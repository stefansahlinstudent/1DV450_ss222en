class CreateProjectsUsersTable < ActiveRecord::Migration
  def up
  #felet kan ev. bero pa att den är ihopsatt med reference fran andra sidan. 
	create_table :projects_users, :id => false do |t|
	t.integer "project_id"
	t.integer "user_id"

  end


  def down
	drop_table :projects_users
  end
end
