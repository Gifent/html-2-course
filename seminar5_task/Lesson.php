<?php 
class Lesson {
    private $group;
    private $subject;
    private $class;

    public function __construct($group123, $subject, $class) {
        $this->group = $group123;
        $this->subject = $subject;
        $this->class = $class;
    }
    
    public function getGroup() {
        return $this->group;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getClass() {
        return $this->class;
    }

    public function isDuplicate($lesson) {
        return $this->group === $lesson->getGroup() && $this->subject === 
        $lesson->getSubject() && $this->class === $lesson->getClass();
    }

}
