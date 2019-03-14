<?php

namespace Tests\Unit\Policies;

use App\StudentClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentClassPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_student_class()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new StudentClass));
    }

    /** @test */
    public function user_can_view_student_class()
    {
        $user = $this->createUser();
        $studentClass = factory(StudentClass::class)->create();
        $this->assertTrue($user->can('view', $studentClass));
    }

    /** @test */
    public function user_can_update_student_class()
    {
        $user = $this->createUser();
        $studentClass = factory(StudentClass::class)->create();
        $this->assertTrue($user->can('update', $studentClass));
    }

    /** @test */
    public function user_can_delete_student_class()
    {
        $user = $this->createUser();
        $studentClass = factory(StudentClass::class)->create();
        $this->assertTrue($user->can('delete', $studentClass));
    }
}
