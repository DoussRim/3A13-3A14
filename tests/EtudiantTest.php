<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Etudiant;
use App\Entity\Note;

class EtudiantTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }
    public function testIsTrue(){
        $student=new Etudiant();
        $student->setUsername("Foulen");
        $this->assertTrue($student->getUsername()==="Foulen");
    }
    function testAverage(){
        $student=new Etudiant();
        $student->setUsername("Foulen");
        $note1=new Note();
        $note1->setNote(10);

        $note2=new Note();
        $note2->setNote(20);
        $student->addNote($note1);
        $student->addNote($note2);
        $student->calculAverage();
        $this->assertEquals(15,$student->getMoyenne());
        
    }
}
