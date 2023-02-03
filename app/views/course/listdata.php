<div class="container">
    <br>
    <div class="row justify-content-between">
        <div class="col-4">
            <div><h1>Courses Registered:</h1></div>
        </div>
        <div class="col-4">
            <div> <button class="btn btn-secondary" type="button" onclick="location.href='/controller=course'">Back</button></div>
        </div>
    </div>
    <br>
</div>
<div class="container">
    <br>
    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">CourseID</th>
                <th scope="col">Name</th>
                <th scope="col">Department</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($data as $count=>$record):
                $num++; ?>  
            <tr>
                <td scope='row'><?= $num ?></td>
                    <?php foreach($record as $key=>$value): ?>
                <td><?= $record[$key]?></td>
                    <?php endforeach; ?>
                <td>
                    <div class="d-flex justify-content-evenly">
                        <form method="post" action="/controller=course&action=delete">
                            <input type="hidden" name="id" class="form-control" value="<?= $record['id']?>">
                            <button type="submit" class="btn btn-danger">Delete</button>          
                        </form>
                        <form method="post" action="/controller=course&action=update">
                            <input type="hidden" name="id" class="form-control" value="<?= $record['id'] ?>">
                            <input type="hidden" name="name" class="form-control" value="<?= $record['name'] ?>">
                            <input type="hidden" name="dept" class="form-control" value="<?= $record['dept'] ?>">
                            <button type="submit" class="btn btn-primary">Update</button> 
                        </form>
                    </div>
                </td>
            </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>
