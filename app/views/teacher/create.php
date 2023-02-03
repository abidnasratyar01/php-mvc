<div class="container">
    <br>
    <div class="row justify-content-between">
        <div class="col-4">
            <div><h1>Add New Teacher</h1></div>
        </div>
        <div class="col-4">
            <div> <button class="btn btn-secondary" type="button" onclick="location.href='/controller=teacher'">Back</button></div>
        </div>
    </div>
    <br>
</div>
<div class="container">
    <form action="" method="post" >
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" >
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" >
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label>Father Name</label>
            <input type="text" name="father_name" class="form-control" >
        </div>
        <div class="mb-3">
            <label>Dept.:</label>
            <input type="text" name="dept" class="form-control" >
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" >
        </div>
        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="dob" class="form-control" >
        </div>
        <div class="mb-3">
            <label>Phone Number</label>
            <input type="tel" name="pnumber" class="form-control" >
        </div>  
        <button type="submit" class="btn btn-primary" onclick="location.href='/controller=teacher&action=add'">Submit</button>
    </form>
</div>
 
