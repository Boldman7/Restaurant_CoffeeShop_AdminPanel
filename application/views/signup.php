<!-- <form action="<?= base_url();?>WebService/signUp" method="post">
	<input type="text" name="name">
	<input type="text" name="password">
	<input type="text" name="email">
	<input type="submit" name="submit" value="submit">
</form> -->

<form method="post" action="<?= base_url();?>Auction/addAuction" enctype="multipart/form-data">
    <div class="form-group">
        <label>Choose Files</label>
        <input type="file" name="files[]" multiple/>
    </div>
    <div class="form-group">
        <input type="submit" name="fileSubmit" value="UPLOAD"/>
    </div>
</form>