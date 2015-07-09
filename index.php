<?php
/**Our _todo app's GUI client.
*What we have done is just provide an interface that talks to  our boring _Todo controller methods.
*Notice how we try very hard to decouple php from the html so that we can plug in stuff like
*templates easily.
*/
    include_once __DIR__ . '/src/Todo.php';
    $items = Todo::batch_read();
?>

<?php
    //refresh page to reflect new changes
    function refresh(){
        header("Location: .");
    }

    //submit/update an item
    if(isset($_POST) && isset($_POST['title']) ){
        if($_POST['title']){

            $title  = strip_tags(stripslashes($_POST['title']));
             if(isset($_POST['id'])){
                Todo::update($_POST['id'],$title);
            }else{
            Todo::create($title);
             }
         }
        refresh();
    }
    
    //delete an item
    if(isset($_GET['delete']) && isset($_GET['id'])){
        if(filter_var($_GET['id'],FILTER_VALIDATE_INT)){
            Todo::delete($_GET['id']);

            refresh();
        }
    }
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

    //changes to update mode
    if(isset($_GET['update']) && isset($_GET['item_id'])){
        if(filter_var($_GET['item_id'],FILTER_VALIDATE_INT)){
            $update_mode = true;
        }
    }

    //mark item as complete
    if(isset($_GET['mark_complete']) && isset($_GET['id'])){
        if(filter_var($_GET['id'],FILTER_VALIDATE_INT)){
            Todo::mark_complete($_GET['id']);
            refresh();
        }
    }
?>

<!DOCTYPE html>
    <head>
        <title>Simple Todo</title>
        <link rel="stylesheet" href="static/styles.css">
    </head>
    <body>
        <?php if(isset($update_mode)){
            if($update_mode){
                $data = Todo::read($_GET['item_id']);
        ?>
            <center><h4>Update a todo item.</h4></center>
            <hr/>
            <form method="post" action="." name="update">
                <input type="hidden" name="id" value="<?php echo $_GET['item_id'];?>">
                <input type="text" name="title" value="<?php if($data) { echo $data['title'];} ?>">
            </form>
        <?php
            return;
            }
        }
        ?>
        <center><h4>What do you want to do?</h4></center>
        <hr/>
        <form method="post" action="." name="create">
            <input type="text" name="title" class="input" placeholder="Enter your new item and press enter key">
        </form>
        <div id="items">
            <?php if(isset($item)) { ?>
               <li><?php echo $item['title'];?>
                 <?php if($item['completed'] != true) { ?>
                        <a href="index.php?mark_complete&id=<?php echo $item['id'];?>">Mark as complete</a>
                 <?php } else { ?>
                            <span class="badge"><strong>Completed.</strong></span>
                 <?php } ?>
               </li>
            <?php return;} ?>

            <ol>
            <?php foreach($items as $item) { ?>
                <li> 
                    <?php echo $item['title']; ?>
                    <span class="actions">
                        <a href="index.php?update&item_id=<?php echo $item['id'];?>">Edit</a>
                        <a href="index.php?id=<?php echo $item['id'];?>">View</a>
                        <a href="index.php?delete&id=<?php echo $item['id'];?>">Delete</a>
                        <?php if($item['completed'] != true) { ?>
                        <a href="index.php?mark_complete&id=<?php echo $item['id'];?>">Mark as complete</a>
                        <?php } else { ?>
                            <strong>Completed.</strong>
                        <?php } ?>
                    </span>
                </li>
            <?php } ?>
            </ol>
        </div>
    </body>
</html>
