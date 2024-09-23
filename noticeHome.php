<?php
include('header.php');
include('sidebar.php');
if(!isset($_SESSION["roll"])){
   header('Location: index.php'); 
}

?>

<?php
    include('database/config.php');
    if(isset($_POST['Add'])){ 

        $noticeId = $_POST['usertypeid'];
        $noticeTitle = $_POST['noticeTitle'];
        $noticemsg = $_POST['noticemsg'];
        $useridFk = 1;
        $userRole = 'Admin';
        $creationDate = date("Y-m-d");
       
        $noticeStatus="live";
        if($noticeId!=''){
            $query="UPDATE Notice SET noticeTitle = '". $noticeTitle ."', noticemsg = '". $noticemsg ."', useridFk = '". $useridFk ."', userRole = '". $userRole ."', creationDate = '". $creationDate ."', noticeStatus = '". $noticeStatus ."' WHERE noticeId ='". $noticeId ."'";
        }else{
            $query= "INSERT INTO Notice (noticeTitle, noticemsg,useridFk,userRole,creationDate,noticeStatus)VALUES('". $noticeTitle ."','". $noticemsg ."','". $useridFk ."','". $userRole ."','". $creationDate ."','". $noticeStatus ."')";
        }
        mysqli_query($con,$query);
            }
?>
<style type="text/css">
	.btn-round {
    color: #666;
    padding: 3px 9px;
    font-size: 13px;
    line-height: 1.5;
    background-color: #fff;
    border-color: #ccc;
    border-radius: 50px;
}
</style>
</div>
<br><br>
        <div class="row justify-content-center" style="padding: 12px 0px 0px 0px;">
        	<div class="col-lg-3">
            <button class="btn btn-primary" onclick="clear_fun()" data-toggle="modal" data-target="#myModal">
            	 Add Admin Notice</button>
            </div>
                
            
                
            </div>
        
<div class="container" style="padding: 65px 0px 0px 60px;">
	<div class="row">
		<?php
            $sql="SELECT * FROM Notice WHERE `noticeStatus`='live'";
			$res = mysqli_query($con,$sql);
            while($row=mysqli_fetch_assoc($res)){
         ?>
		<div class="col-sm-6 col-xs-6">
		    <div class="alert alert-danger">
		        <h4>Notice Title:- <?= $row['noticeTitle'] ?></h4><p>
		            Message:- <?= $row['noticemsg'] ?>.
		        </p>
		        <hr class="message-inner-separator">
		        
		        <button title="Edit User Types" class="editType btn btn-primary" data-id="<?= $row['noticeId'] ?>" data-name="<?= $row['noticeTitle'] ?>" data-noticemsg="<?= $row['noticemsg'] ?>"><i class="fa fa-edit"></i></button>  &nbsp;&nbsp;&nbsp;
                 <a href="delete.php?table=Notice&column=noticeId&datacolumn=noticeStatus&id=<?= $row['noticeId'] ?>" onclick="if(confirm('Do You Want To Delete ?')) return true; else return false;"><button title="Delete Notice" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                 <p style="display: inline-block;padding-left: 180px;">Created Date: <?= $row['creationDate'] ?></p>
		    </div>
		</div>
	<?php } ?>
	</div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Add/Edit Notice</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="usertypeid" value="" id="usertypeid">
          <input type="text" name="noticeTitle" id="noticeTitle" placeholder="Enter a Notice Title" class="form-control" required=""><br>
          <textarea name="noticemsg" id="noticemsg" class="form-control" required=""></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" name="Add" class="btn btn-primary" >Add Notice</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 <script>    
        //*
    $(document).ready(function(){
    
        $(".editType").on('click',function(){
            
            var typeId = $(this).attr("data-id");
            var typeName = $(this).attr("data-name");
            var noticemsg=$(this).attr("data-noticemsg");

            $("#usertypeid").val(typeId);
            $("#noticeTitle").val(typeName);
            $("#noticemsg").val(noticemsg);
            $("#myModal").modal("show");
        });
        
        $("#editCancel").on('click',function(){
            $("#usertypeid").val("");
        });
    });
    function clear_fun(){
        $("#noticeTitle").val("");
        $("#noticemsg").val("");
        $('#noticeTitle').attr('placeholder','Enter a Notice Title');
        $('#noticemsg').attr('placeholder','Enter a Notice Message');
    }
    //*
    </script>


<?php include('footer.php'); ?>