<?php

namespace Tests\Unit\Models;

use App\User;
use App\StudentClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentClassTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_student_class_has_name_link_attribute()
    {
        $studentClass = factory(StudentClass::class)->create();

        $title = __('app.show_detail_title', [
            'name' => $studentClass->name, 'type' => __('student_class.student_class'),
        ]);
        $link = '<a href="'.route('student_classes.show', $studentClass).'"';
        $link .= ' title="'.$title.'">';
        $link .= $studentClass->name;
        $link .= '</a>';

        $this->assertEquals($link, $studentClass->name_link);
    }

    /** @test */
    public function a_student_class_has_belongs_to_creator_relation()
    {
        $studentClass = factory(StudentClass::class)->make();

        $this->assertInstanceOf(User::class, $studentClass->creator);
        $this->assertEquals($studentClass->creator_id, $studentClass->creator->id);
    }
}
