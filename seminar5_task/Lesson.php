<?php 
class Lesson {
    private string $group;
    private string $subject;
    private string $class;

    public function __construct(string $group123, string $subject, string $class) {
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

    public function isDuplicate(Lesson $lesson) {
        return $this->group === $lesson->getGroup() && $this->subject === 
        $lesson->getSubject() && $this->class === $lesson->getClass();
    }

}
