<!-- متود برای صفحه نمایش حاضری یک صنف است -->
 <?php

public function classAttendance($id)
{
    $db = new DataBase();
    $class = $db->select('SELECT * FROM classes WHERE `id` = ?', [$id])->fetch();
    $all_teachers = $db->select('SELECT id, employee_name FROM employees WHERE teacher = 1')->fetchAll();

    // get students in class
    $students = $db->select('SELECT students_sis.id AS student_id, students_sis.name, other_stu_infos.father_name FROM 
            students_class_infos
        INNER JOIN students_sis ON students_class_infos.student_id = students_sis.id
        INNER JOIN other_stu_infos ON students_sis.id = other_stu_infos.student_id
        WHERE 
            students_class_infos.classes_id = ?
    ', [$class['id']])->fetchAll();

    // terms infos
    $current_term_id = [];
    $date = date('Y-m-d');
    $terms = $db->select('SELECT id, name_term FROM terms WHERE classes_id = ?', [$class['id']])->fetchAll();
    foreach ($terms as $term) {
        $attendances = $db->select('SELECT * FROM students_attendance_time WHERE `term_id` = ?', [$term['id']])->fetchAll();
        foreach ($attendances as $attendance) {
            $attendanceDate = date('Y-m-d', strtotime($attendance['created_at']));
            if (strtotime($attendanceDate) == strtotime($date)) {
                $current_term_id[] = $attendance;
            }
        }
    }
    if (!empty($current_term_id)) {
        if (count($current_term_id) === 1) {
            $term_info = $current_term_id;
            $time_teacher = $db->select('SELECT id, employee_name FROM employees WHERE employee_name = ?', [$class['teacher_name_term2']])->fetch();
            $time_name = 'ساعت 2: ' . $class['time2'];
            $time = $class['time2'];
            $term_id = $term_info[0]['term_id'] + 1;
        } else {
            $this->redirect('select-class-attendance');
            exit();
        }
    } else {
        $term_info = $db->select('SELECT * FROM terms WHERE classes_id = ? AND name_term = 1', [$class['id']])->fetch();
        $time_teacher = $db->select('SELECT id, employee_name FROM employees WHERE employee_name = ?', [$class['teacher_name_term1']])->fetch();
        $time_name = 'ساعت 1: ' . $class['time1'];
        $time = $class['time1'];
        $term_id = $term_info['id'];
    }


    require_once(BASE_PATH . '/resources/views/app/class-attendance/class-attendance.php');
}
