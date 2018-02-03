<h1 class="page-title">Create category</h1>
<form class="form-horizontal" role="form">
    <div class="form-group">
   	    <label for="inputAmount" class="col-sm-2 control-label">Amount:</label>
   	    <div class="col-sm-10">
      		<input type="text" class="form-control" id="inputAmount" placeholder="Amount">
    	</div>
    </div>	
    <div class="form-group">
   	    <label for="inputCategory" class="col-sm-2 control-label">Category:</label>
   	    	<div class="col-sm-10">
				<select class="form-control" id="inputCategory">
	  			<option>Clothing</option>
	  			<option>Food</option>
	  			<option>Entertainment</option>
	 				<option>Other</option>
				</select>
			</div>
    </div>
    <div class="form-group">
   	    <label for="inputOtherCategory" class="col-sm-2 control-label"></label>
    	<div class="col-sm-10">
   			<input type="text" class="form-control" id="inputOtherCategory" placeholder="Other Category">
		  </div>
    </div>
  
    <div class="form-group">
   		 <div class="col-sm-offset-2 col-sm-10">    	
    	    <button class="btn btn-lg btn-success btn-block" type="submit">Create</button>
   		 </div>
    </div>
</form>
