<?php 
include "../database/db.php";

if($_SERVER["REQUEST_METHOD"] === "GET") {
    $student_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM students WHERE id = :student_id");

    $stmt->bindParam(":student_id",$student_id,PDO::PARAM_INT);

    $deleted = $stmt->execute();

    if($deleted) {
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
            "message" => "Student deleted successfully",
            "content" => $content
        ];

        echo json_encode($response);

        return;
    }else {
        $response = [
            'status' => 500,
            'message' => 'Student not deleted'
        ];

        echo json_encode($response);

        return;
    }

}