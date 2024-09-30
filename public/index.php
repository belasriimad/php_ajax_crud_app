<?php 
include "../layouts/header.php";

$stmt = $conn->prepare("SELECT * FROM students");

$stmt->execute();

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include "./modals/addStudentModal.php"; ?>
<?php include "./modals/editStudentModal.php"; ?>
<div class="container">
    <div class="row my-4">
        <div class="col-md-10 mx-auto">
            <div class="my-3 d-none" id="alert_message">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong id="message_content"></strong>
                    <button type="button" class="btn-close" id="btn_close"></button>
                </div>
            </div>
            <div class="my-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                    data-bs-target="#studentAddModal">
                    <i class="fas fa-plus"></i> Add
                </button>
            </div>
            <div class="card">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Registration Number</th>
                            <th>Average</th>
                            <th>Decision</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="bodyContent">
                        <?php foreach($students as $key => $student) :?>
                            <tr>
                                <td><?php echo $key += 1; ?></td>
                                <td><?php echo $student['name']; ?></td>
                                <td><?php echo $student['regist_number']; ?></td>
                                <td><?php echo $student['avg']; ?></td>
                                <td><?php echo $student['move_next']; ?></td>
                                <td>
                                    <button type="button" 
                                        value="<?php echo $student['id']; ?>"
                                        class="btn btn-sm btn-warning btn__update" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#studentEditModal">
                                            <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" 
                                        value="<?php echo $student['id']; ?>"
                                        class="btn btn-sm btn-danger btn__delete">
                                            <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include "../layouts/footer.php" ?>

<script>
    $(document).on('submit','#saveStudent',function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);

        $.ajax({
            type: "POST",
            url:"storeStudent.php",
            data:formData,
            processData:false,
            contentType:false,
            success: function(response) {
                const res = JSON.parse(response);
                if(res.status == 200) {
                    $("#studentAddModal").modal("hide");
                    $("#saveStudent")[0].reset();
                    $("#bodyContent").html(res.content);
                    $("#message_content").html(res.message);
                    $("#alert_message").removeClass("d-none");
                }else if(res.status == 500){
                    alert(res.message);
                }else {
                    alert("Something went wrong try later");
                }
            }
        })
    });
    $(document).on('click','.btn__update',function() {        
        const student_id = $(this).val();

        $.ajax({
            type: "GET",
            url:"updateStudent.php?id=" + student_id,
            success: function(response) {
                const res = JSON.parse(response);
                if(res.status == 200) {
                    $("#student_id").val(res.student.id);
                    $("#name").val(res.student.name);
                    $("#regist_number").val(res.student.regist_number);
                    $("#avg").val(res.student.avg);
                    $("#move_next").val(res.student.move_next);
                    $("#studentEditModal").modal("show");
                }else if(res.status == 404){
                    alert(res.message);
                }else {
                    alert("Something went wrong try later");
                }
            }
        })
    });
    $(document).on('submit','#updateStudent',function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);

        $.ajax({
            type: "POST",
            url:"updateStudent.php",
            data:formData,
            processData:false,
            contentType:false,
            success: function(response) {
                const res = JSON.parse(response);
                if(res.status == 200) {
                    $("#studentEditModal").modal("hide");
                    $('#updateStudent')[0].reset();
                    $("#bodyContent").html(res.content);
                    $("#message_content").html(res.message);
                    $("#alert_message").removeClass("d-none");
                }else if(res.status == 500){
                    alert(res.message);
                }else {
                    alert("Something went wrong try later");
                }
            }
        })
    });
    $(document).on('click','.btn__delete',function(e) {
        if(confirm("Are you sure ?")) {
            const student_id = $(this).val();

            $.ajax({
                type: "GET",
                url:"deleteStudent.php?id=" + student_id,
                success: function(response) {
                    const res = JSON.parse(response);
                    if(res.status == 200) {
                        $("#bodyContent").html(res.content);
                        $("#message_content").html(res.message);
                        $("#alert_message").removeClass("d-none");
                    }else if(res.status == 500){
                        alert(res.message);
                    }else {
                        alert("Something went wrong try later");
                    }
                }
            })
        }
    });

    $(document).on('click','#btn_close',function() {
        $("#alert_message").addClass("d-none");
    });
</script>