
<!DOCTYPE html> 
<html> 
<head> 
    <title>Course </title> 
</head> 
<body style="background: #128184 "> 
<div align="center">
            <fieldset align="center">
   <legend>Course</legend>


    <form method="POST" action="internt.php"> 
        <label for="num_of_courses">number of course:</label> 
        <input type="number" name="num_of_courses" id="num_of_courses" required><br><br> 
        <?php if (isset($_POST['num_of_courses'])): ?> 
            <?php for ($i = 0; $i < $_POST['num_of_courses']; $i++): ?> 
                <label for="course_name_<?php echo $i + 1; ?>"> name of course <?php echo $i + 1; ?>:</label> 
                <input type="text" name="course_name_<?php echo $i + 1; ?>" required><br> 
                <label for="test1_<?php echo $i + 1; ?>">first test score:</label> 
                <input type="number" name="test1_<?php echo $i + 1; ?>" required><br> 
                <label for="test2_<?php echo $i + 1; ?>">second test score:</label> 
                <input type="number" name="test2_<?php echo $i + 1; ?>" required><br> 
                <label for="final_exam_<?php echo $i + 1; ?>"> final exam score:</label> 
                <input type="number" name="final_exam_<?php echo $i + 1; ?>" required><br><br> 
            <?php endfor; ?> 
            <input type="submit" value="Calculate Grades"> 
        <?php endif; ?> 
    </form> 
 
    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['num_of_courses'])) { 
        echo "<h2>Final</h2>"; 
        echo "<table>"; 
        echo "<tr><th>Course</th><th>Mark</th><th>Final</th></tr>"; 
 
        for ($i = 1; $i <= $_POST['num_of_courses']; $i++) { 
            $course_name = $_POST['course_name_' . $i]; 
            $test1 = $_POST['test1_' . $i]; 
            $test2 = $_POST['test2_' . $i]; 
            $final_exam = $_POST['final_exam_' . $i]; 
 
            $course = new Course($course_name, $test1, $test2, $final_exam); 
            $average = $course->calculateAverage(); 
            $grade = $course->calculateGrade(); 
 
            echo "<tr>"; 
            echo "<td>" . $course_name . "</td>"; 
            echo "<td>" . $average . "</td>"; 
            echo "<td>" . $grade . "</td>"; 
            echo "</tr>"; 
        } 
 
        echo "</table>"; 
    } 
    ?> 
 
    <?php 
    class Course 
    { 
        public $name; 
        public $test1; 
        public $test2; 
        public $finalExam; 
 
        public function __construct($name, $test1, $test2, $finalExam) 
        { 
            $this->name = $name; 
            $this->test1 = $test1; 
            $this->test2 = $test2; 
            $this->finalExam = $finalExam; 
        } 
 
        public function calculateAverage() 
        { 
            return ($this->test1 + $this->test2 + $this->finalExam) / 3; 
        } 
 
        public function calculateGrade() 
        { 
            $average = $this->calculateAverage(); 
            if ($average >= 90) { 
                return 'A'; 
            } else if ($average >= 80) { 
                return 'B'; 
            } else if ($average >= 70) { 
                return 'C'; 
            } else if ($average >= 60) { 
                return 'D'; 
            } else { 
                return 'F'; 
            } 
        } 
    } 
    ?> 
 
</body> 
</html>