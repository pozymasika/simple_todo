<?php
    /**
    *The  _todo controller.
    *This class implements the basic CRUD operations that a _todo app should have.
    *@package simple_todo
    *@author pozy<masikapolycarp@gmail.com>
    */

    require_once __DIR__. '/../config.php';

    class Todo
    {
        /**Create a _todo item.
        *@param string $title - a set of the data to be created.
        *@param boolean $completed - have you completed the task.
        */
        public function create($title,$completed=false){
            global $db;
            $sql = "INSERT INTO todo_items(title,completed) VALUES(:title,:completed)";
            $conn = $db -> prepare($sql);
            $conn -> execute(array(
                        ':title' => $title,
                        ':completed' => $completed
                        ));
        }

        /**Reads a _todo item from the database
        *@param int $id - the id of the item
        */
        public function read($id){
            global $db;
            $sql = "SELECT id,title,completed FROM todo_items WHERE id=:id";
            $conn = $db -> prepare($sql);
            $conn -> execute(array(':id' => $id));
            return $conn -> fetchColumn();
        }
        /**Reads all _todo items.
        */
        public function batch_read(){
            global $db;
            $sql = "SELECT id,title,completed FROM todo_items";
            $conn = $db -> prepare($sql);
            $conn -> execute();
            return $conn -> fetchAll();
        }
        /**Update _todo item
        *@param int $id - the id of the item
        *@param string $title - the new title
        */
        public function update($id,$title){
            global $db;
            $sql = "UPDATE todo_items SET title=:title WHERE id=:id";
            $conn = $db -> prepare($sql);
            $conn -> execute(array(':title' => $title,
                                   ':id' => $id
                                ));
        }
        /**Delete a _todo item
        *@param int $id - the item to delete.
        */
        public function delete($id){
            global $db;
            $sql = "DELETE FROM todo_items WHERE id=:id";
            $conn  = $db -> prepare($sql);
            $conn -> execute(array(':id' => $id));
        }
    }
?>
