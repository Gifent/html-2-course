<?php

require_once 'Lesson.php';

class LessonService {
    public function hasDuplicate(Lesson $lesson, array $lessons) {
        foreach ($lessons as $lessonData) {
            $lesson1 = new Lesson($lessonData['group'], $lessonData['subject'],
             $lessonData['class']);
            if ($lesson->isDuplicate($lesson1)) {
                return true;
            }
        }
        return false;
    }

    public function addLesson(Lesson $lesson, array &$lessons) {
        $lessons[] = ['group'=>$lesson->getGroup(), 'subject'=>$lesson->getSubject(),
        'class'=>$lesson->getClass()];
    }

    public function clear(array &$lessons) {
        $lessons = [];
    }
}