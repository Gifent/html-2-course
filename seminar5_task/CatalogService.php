<?php

require_once 'Lesson.php';

class CatalogService {
    public function hasDuplicate($lesson, $lessons) {
        $lesson1 = new Lesson($lesson1['group'], $lesson1['subject'], $lesson1['class']);

        foreach ($lessons as $lesson1) {
            if ($lesson->isDuplicate($lesson1)) {
                return true;
            }
        }
        return false;
    }
}