<?php 
include "../database/db.php";

if($_SERVER["REQUEST_METHOD"] === "GET") {
    $student_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM students WHERE id = :student_id");

    $stmt->bindParam(":student_id",$student_id,PDO::PARAM_INT);

    $stmt->execute();

    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if($student) {
        $res = [
            "status" => 200,
            "student" => $student
        ];

        echo json_encode($res);

        return;
    }else {
        $res = [
            "status" => 404,
            "message" => "Student not found"
        ];

        echo json_encode($res);

        return;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $regist_number = $_POST['regist_number'];
    $avg = $_POST['avg'];
    $move_next = $_POST['move_next'];

    $sql = "UPDATE students SET name=:name,regist_number=:regist_number,avg=:avg,
        move_next=:move_next WHERE id=:student_id";
    
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":student_id",$student_id,PDO::PARAM_INT);
    $stmt->bindParam(":name",$name);
    $stmt->bindParam(":regist_number",$regist_number);
    $stmt->bindParam(":avg",$avg);
    $stmt->bindParam(":move_next",$move_next);

    $updated = $stmt->execute();
    
    if($updated) {
        $stmt = $conn->prepare("SELECT * FROM students");

        $stmt->execute();

        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $content= "";

        foreach($students as $key => $student) {
            $content .= "<tr>";
            $content .= "<td>".++$key."</td>";
            $content .= "<td>".$student['name']."</td>";
            $content .= "<td>".$student['regist_number']."</td>";
            $content .= "<td>".$student['avg']."</td>";
            $content .= "<td>".$student['move_next']."</td>";
            $content .= '<td>
                    <button type="button" 
                        value="'.$student['id'].'"
                        class="btn btn-sm btn-warning btn__update" 
                        data-bs-toggle="modal" 
                        data-bs-target="#studentEditModal">
                            <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" 
                        value="'.$student['id'].'"
                        class="btn btn-sm btn-danger btn__delete">
                            <i class="fas fa-trash"></i>
                    </button>
                </td>
            ';
            $content .= "</tr>";
        }


        $response = [
            "status" => 200,
            "message" => "Student updated successfully",
            "content" => $content
        ];

        echo json_encode($response);

        return;
    }else {
        $response = [
            'status' => 500,
            'message' => 'Student not updated'
        ];

        echo json_encode($response);

        return;
    }

}