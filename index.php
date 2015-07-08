<?php
    include_once __DIR__ . '/src/Todo.php';
    $items = Todo::batch_read();
?>

<?php
    //submit/update an item
    if(isset($_POST) && isset($_POST['title']) ){
        $title  = strip_tags(stripslashes($_POST['title']));
        if(isset($_POST['id'])){
            Todo::update($_POST['id'],$title);
        }else{
        Todo::create($title);
        }
        //refresh to reflect new item.
        header("Location: .");
    }

?>

<!DOCTYPE html>
    <head>
        <title>Simple Todo</title>
    </head>
    <body>

        <?php
            //view a single item
            if(isset($_GET['id']) ){
                $id = stripslashes(strip_tags($_GET['id']));
                if(filter_var($id,FILTER_VALIDATE_INT) ){
                    try{
                        $item = Todo::read($id);
                    }catch(Exception $e){
                    }
                }
            }
        ?>

        <?php
            //update an item
            if(isset($_GET['update']) && isset($_GET['item_id'])){
                if(filter_var($_GET['item_id'],FILTER_VALIDATE_INT)){
                    $update_mode = true;
                }
            }
        ?>

        <center>
        <?php if(isset($update_mode)){
            if($update_mode){
                $data = Todo::read($_GET['item_id']);
        ?>
            <h4>Update a todo item.</h4>
            <hr/>
            <form method="post" action="." name="update">
                <input type="hidden" name="id" value="<?php echo $_GET['item_id'];?>">
                <input type="text" name="title" value="<?php if($data) { echo $data['title'];} ?>"><button name="go">Update</button>
            </form>
        <?php
            return;
            }
        }
        ?>
        <h4>What do you want to do?</h4>
        <hr/>
        <form method="post" action="." name="create">
            <input type="text" name="title"><button name="go">Submit Item</button>
        </form>
        <div id="items">
            <?php if(isset($item)) { ?>
               <li><?php echo $item['title'];?>,( <i>completed:<?php echo $item['completed'];?></i> ).</li>
            <?php return;} ?>

            <?php foreach($items as $item) { ?>
                <li> 
                    <?php echo $item['title']; ?>,( <i>completed:<?php echo $item['completed'];?></i> ).
                    <a href="index.php?update&item_id=<?php echo $item['id'];?>">Change</a>
                    <a href="index.php?id=<?php echo $item['id'];?>">View</a>
                </li>
            <?php } ?>
        </div>
        </center>
    </body>
</html>
