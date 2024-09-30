<?php 
include "../database/db.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $regist_number = $_POST["regist_number"];
    $avg = $_POST["avg"];
    $move_next = $_POST["move_next"];

    $stmt = $conn->prepare("INSERT INTO students
        (name,regist_number,avg,move_next)
        VALUES(:name,:regist_number,:avg,:move_next)");
    
    $added = $stmt->execute([
        ":name" => $name,
        ":regist_number" => $regist_number,
        ":avg" => $avg,
        ":move_next" => $move_next,
    ]);

    if($added) {
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
            "message" => "Student created successfully",
            "content" => $content
        ];

        echo json_encode($response);

        return;
    }else {
        $response = [
            "status" => 500,
            "message" => "Student not created"
        ];

        echo json_encode($response);

        return;
    }

}

?>